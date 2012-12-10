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
            $id = explode(",", $_GET['buscar']);
            $error = 0;
            $info = 0;
            $exito = 0;
            
            foreach($id as $cancela){
                $cancelar = SolicitudOc::model()->findByPk($cancela);
                if($cancelar->ESTADO == 'C'){
                    $info++; // ya esta en cancelar
                }
                else{
                    $cancelar->ESTADO = 'C';
                    $cancelar->CANCELADA_POR = Yii::app()->user->name;
                    $cancelar->FECHA_CANCELADA = date("Y-m-d H:i:s");
                    if($cancelar->save()){
                        $exito++; // exito
                    }
                    else{
                        $error++; // error
                    }
                
            }}
            $variable = array('error'=>$error, 'info'=>$info, 'exito'=>$exito);
            echo CJSON::encode($variable);
        }
        
       public function actionAutorizar(){
            $id = explode(",", $_GET['buscar']);
            $error = 0;
            $info = 0;
            $exito = 0;
            $advertencia = 0;
            
            foreach($id as $autoriza){
                $autorizar = SolicitudOc::model()->findByPk($autoriza);
                if($autorizar->ESTADO == 'C'){
                    $advertencia++; //error 2 esta en cancelar
                }
                else{
                    if ($autorizar->ESTADO == 'N' || $autorizar->ESTADO == 'A'){
                        $info++; //error 3 ya esta en autorizar
                    }
                    else{
                        $autorizar->ESTADO = 'N';
                        $autorizar->AUTORIZADA_POR = Yii::app()->user->name;
                        $autorizar->FECHA_AUTORIZADA = date("Y-m-d H:i:s");
                        if($autorizar->save()){
                            $actLinea = SolicitudOcLinea::model()->findAll('SOLICITUD_OC = "'.$autoriza.'"');
                            foreach ($actLinea as $datos){
                                $datos->ESTADO = 'N';
                                $datos->save();
                            }
                            $exito++; // Se autorizo correctamente
                        }
                        else{
                            $error++; // error 4 no se pudo autorizar
                        }
                
                    }
                }            
                }
            $variable = array('error'=>$error, 'info'=>$info, 'exito'=>$exito, 'advertencia'=>$advertencia);
            echo CJSON::encode($variable);
        }
        
        public function actionReversar(){
            $id = explode(",", $_GET['buscar']);
            $error = 0;
            $info = 0;
            $exito = 0;
            $advertencia = 0;
            
            foreach($id as $reversa){
                $reversar = SolicitudOc::model()->findByPk($reversa);
                if($reversar->ESTADO == 'C'){
                    $advertencia++; //error 2 esta en cancelar
                }
                 else{
                     if ($reversar->ESTADO == 'A'){
                        $advertencia++; //error 3 ya esta en autorizar
                    }
                    else{
                        if($reversar->ESTADO == 'P'){
                            $info++; //error 4 esta aun en planeada
                        }
                        else{
                            $reversar->ESTADO = 'P';
                            $reversar->AUTORIZADA_POR = "";
                            $reversar->FECHA_AUTORIZADA = "";
                            if($reversar->save()){
                                $actLinea = SolicitudOcLinea::model()->findAll('SOLICITUD_OC = "'.$reversa.'"');
                                foreach ($actLinea as $datos){
                                    $datos->ESTADO = 'P';
                                    $datos->save();
                                }
                            $exito; // Se reverso correctamente
                            }
                            else{
                                $error++; // error 5 no se pudo reversar
                            }
                        }
                    }
                 }
            }
            $variable = array('error'=>$error, 'info'=>$info, 'exito'=>$exito, 'advertencia'=>$advertencia);
            echo CJSON::encode($variable);
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


