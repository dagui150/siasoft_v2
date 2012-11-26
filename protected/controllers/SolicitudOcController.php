<?php

class SolicitudOcController extends SBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $breadcrumbs=array();
	public $menu=array();
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'cargarArticulo', 'cancelar', 'autorizar', 'reversar'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new SolicitudOc;
                $linea=new SolicitudOcLinea;
                $articulo = new Articulo;
                $config = ConfCo::model()->find();
                $i = 1;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['SolicitudOc']))
		{
			$model->attributes=$_POST['SolicitudOc'];
                        
			if($model->save())
                            if(isset($_POST['Nuevo'])){
                                foreach ($_POST['Nuevo'] as $datos){
                                    $linea=new SolicitudOcLinea;
                                    $linea->SOLICITUD_OC = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $linea->ARTICULO = $datos['ARTICULO'];
                                    $linea->DESCRIPCION = $datos['DESCRIPCION'];
                                    $linea->UNIDAD = $datos['UNIDAD'];
                                    $linea->CANTIDAD = $datos['CANTIDAD'];
                                    $linea->FECHA_REQUERIDA = $datos['FECHA_REQUERIDA'];
                                    $linea->COMENTARIO = $datos ['COMENTARIO'];
                                    $linea->SALDO = $datos ['SALDO'];
                                    $linea->LINEA_NUM = $i;
                                    $linea->ESTADO = $datos ['ESTADO'];
                                    $linea->save();
                                    $config->ULT_SOLICITUD = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $config->save();
                                    $i++;
                                }
                            }
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
                        'linea'=>$linea,
                        'articulo'=>$articulo,
                        'config' => $config,
                        
		));
	}
        
        public function actionPdf(){
            $id = $_GET['id'];
            $conf = ConfCo::model()->find();
            $compania = Compania::model()->find(); 
            $solicitud = SolicitudOc::model()->findByPk($id);
            $lineas = SolicitudOcLinea::model()->findAll('SOLICITUD_OC = "'.$id.'"');        
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $mPDF1->WriteHTML($this->renderPartial('pdf', array('solicitud' => $solicitud, 'lineas' => $lineas, 'compania' => $compania, 'conf'=>$conf), true));
            $mPDF1->Output();            
            Yii::app()->end();
        }
                
        public function actionCargarArticulo(){
            
            $item_id = $_GET['buscar'];
            $bus = Articulo::model()->findByPk($item_id);
            if($bus){
            $bus2 = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD_ALMACEN.'"');
            $bus3 = UnidadMedida::model()->findAll('TIPO = "'.$bus2->TIPO.'"');
            
            $res = array(
                 'DESCRIPCION'=>$bus->NOMBRE,
                 'UNIDAD'=>$bus3,
                 'ID'=>$bus->ARTICULO,
                  
            );
           
             $bus2= '';
             $bus3= '';
            
            }
            else{
                $res = array(
                 'DESCRIPCION'=>'Ninguno',
                 'UNIDAD'=>'',
                );
            }
             echo CJSON::encode($res);
            
            
        }
        
        public function actionCancelar(){
            $id = explode(",", $_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($id as $cancela){
                 $cancelar = SolicitudOc::model()->findByPk($cancela);
                 
                 switch ($cancelar->ESTADO){
                     case 'C' :
                        $contError+=1;
                        $error.= $cancela.',';
                        break;
                 
                     case 'P' :
                        $cancelar->ESTADO = 'C';
                        $cancelar->CANCELADA_POR = Yii::app()->user->name;
                        $cancelar->FECHA_CANCELADA = date("Y-m-d H:i:s");
                        $cancelar->save();
                        $contSucces+=1;
                        $succes .= $cancela.',';
                        break;
                
                    case 'N' :
                        $contWarning+=1;
                        $warning.= $cancela.',';
                        break;
                    
                    case 'A' :
                        $contWarning+=1;
                        $warning.= $cancela.',';
                        break;
                 }
                 
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            }
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Solicitud(es) Cancelada(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Solicitud(es) no Cancelada(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Solicitud(es) ya Cancelada(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.BootAlert');
        }
        
       public function actionAutorizar(){
           
            $id = explode(",", $_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($id as $autoriza){
                 $autorizar = SolicitudOc::model()->findByPk($autoriza);
                 
                 switch ($autorizar->ESTADO){
                     case 'C' :
                        $contError+=1;
                        $error.= $autoriza.',';
                        break;
                 
                     case 'P' :
                        $autorizar->ESTADO = 'N';
                        $autorizar->AUTORIZADA_POR = Yii::app()->user->name;
                        $autorizar->FECHA_AUTORIZADA = date("Y-m-d H:i:s");
                        if($autorizar->save()){
                            $actLinea = SolicitudOcLinea::model()->findAll('SOLICITUD_OC = "'.$autoriza.'"');
                            foreach ($actLinea as $datos){
                                $datos->ESTADO = 'N';
                                $datos->save();
                            }
                        }
                        else{
                            $contError+=1;
                            $error.= $autoriza.',';
                            break;
                        }
                        $contSucces+=1;
                        $succes .= $autoriza.',';
                        break;
                
                    case 'N' :
                        $contWarning+=1;
                        $warning.= $autoriza.',';
                        break;
                    
                    case 'A' :
                        $contWarning+=1;
                        $warning.= $autoriza.',';
                        break;
                 }
                 
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            }
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Solicitud(es) Autorizada(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Solicitud(es) no Autorizada(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Solicitud(es) ya Autorizada(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.BootAlert');
        }
        
        public function actionReversar(){
            
            $id = explode(",", $_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($id as $reversa){
                $reversar = SolicitudOc::model()->findByPk($reversa);
                 
                 switch ($reversar->ESTADO){
                     case 'C' :
                        $contError+=1;
                        $error.= $autoriza.',';
                        break;
                 
                     case 'N' :
                         $contar = SolicitudOcLinea::model()->countByAttributes(array('SOLICITUD_OC' => $reversa, 'ESTADO' => 'A'));   
                         if($contar == 0){
                            $reversar->ESTADO = 'P';
                            $reversar->AUTORIZADA_POR = "";
                            $reversar->FECHA_AUTORIZADA = "";
                            if($reversar->save()){
                                $actLinea = SolicitudOcLinea::model()->findAll('SOLICITUD_OC = "'.$reversa.'"');
                                foreach ($actLinea as $datos){
                                    $datos->ESTADO = 'P';
                                    $datos->save();
                                }
                            }
                            else{
                                $contError+=1;
                                $error.= $reversa.',';
                                break;
                            }
                            $contSucces+=1;
                            $succes .= $reversa.',';
                        }
                        else{
                            $contError+=1;
                            $error.= $reversa.',';
                        }
                        break;
                
                    case 'A' :
                        $contWarning+=1;
                        $warning.= $reversar.',';
                        break;
                    
                    case 'P' :
                        $contWarning+=1;
                        $warning.= $reversar.',';
                        break;
                 }
                 
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            }
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Solicitud(es) Reversada(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Solicitud(es) no Reversada(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Solicitud(es) ya Reversada(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.BootAlert');
        }
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $model = $this->loadModel($id);
                $linea= new SolicitudOcLinea;
                $articulo = new Articulo;
                $config = new ConfCo;
                $linea2 = new SolicitudOcLinea2;
                $i = 1;
                // retrieve items to be updated in a batch mode
                // assuming each item is of model class 'Item'
                $items = $linea->model()->findAll('SOLICITUD_OC = "'.$id.'"');
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($model));

		if(isset($_POST['SolicitudOc']))
		{
			$model->attributes=$_POST['SolicitudOc'];
                         if($_POST['eliminar'] != ''){
                            $eliminar = explode(",", $_POST['eliminar']);
                            foreach($eliminar as $elimina){
                                if($elimina != -1){
                                    $borra = SolicitudOcLinea::model()->deleteByPk($elimina);
                                }
                            }
                        }
                        
			if($model->save())
                            if(isset($_POST['SolicitudOcLinea'])){
                                foreach ($_POST['SolicitudOcLinea'] as $datos){
                                    $linea=SolicitudOcLinea::model()->findByPk($datos['SOLICITUD_OC_LINEA']);
                                    $linea->SOLICITUD_OC = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $linea->ARTICULO = $datos['ARTICULO'];
                                    $linea->DESCRIPCION = $datos['DESCRIPCION'];
                                    $linea->UNIDAD = $datos['UNIDAD'];
                                    $linea->CANTIDAD = $datos['CANTIDAD'];
                                    $linea->FECHA_REQUERIDA = $datos['FECHA_REQUERIDA'];
                                    $linea->COMENTARIO = $datos ['COMENTARIO'];
                                    $linea->SALDO = $datos ['SALDO'];
                                    $linea->LINEA_NUM = $i;
                                    $linea->ESTADO = $datos ['ESTADO'];
                                    $linea->save();
                                    $i++;
                                }
                            }
                            
                            if(isset($_POST['Nuevo'])){
                                foreach ($_POST['Nuevo'] as $datos2){
                                    $linea2=new SolicitudOcLinea;
                                    $linea2->SOLICITUD_OC = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $linea2->ARTICULO = $datos2['ARTICULO'];
                                    $linea2->DESCRIPCION = $datos2['DESCRIPCION'];
                                    $linea2->UNIDAD = $datos2['UNIDAD'];
                                    $linea2->CANTIDAD = $datos2['CANTIDAD'];
                                    $linea2->FECHA_REQUERIDA = $datos2['FECHA_REQUERIDA'];
                                    $linea2->COMENTARIO = $datos2 ['COMENTARIO'];
                                    $linea2->SALDO = $datos2 ['SALDO'];
                                    $linea2->LINEA_NUM = $i;
                                    $linea2->ESTADO = $datos2 ['ESTADO'];
                                    $linea2->save();
                                    $i++;
                                }
                            }
                            
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
                        'linea'=>$linea,
                        'articulo'=>$articulo,
                        'config'=>$config,
                        'items'=>$items,
                        'linea2'=>$linea2,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('SolicitudOc');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new SolicitudOc('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['SolicitudOc']))
			$model->attributes=$_GET['SolicitudOc'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=SolicitudOc::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La pagina solicitada no existe.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='solicitud-oc-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}