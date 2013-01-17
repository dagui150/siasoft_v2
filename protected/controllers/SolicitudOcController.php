<?php

class SolicitudOcController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        public $modulo='Compras';
        public $submodulo='Solicitud de Compra';
	public $layout='//layouts/column2';
        public $solicitud;
	/**
	 * @return array action filters
	 */
	public function filters(){
      return array(
				array('CrugeAccessControlFilter'),
			);
    }

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
		$model = new SolicitudOc;
                $linea = new SolicitudOcLinea;
                $articulo = new Articulo;
                $config = ConfCo::model()->find();
                $i = 1;
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['SolicitudOc']))
		{
			$model->attributes=$_POST['SolicitudOc'];
                        
			if($model->save()){
                            if(isset($_POST['Nuevo'])){
                                $trans = array('.' => '');
                                $trans2 = array(',' => '.');
                                
                                foreach ($_POST['Nuevo'] as $datos){
                                    
                                    $cantidad=strtr(strtr($datos['CANTIDAD'], $trans), $trans2);
                                    
                                    $linea=new SolicitudOcLinea;
                                    $linea->SOLICITUD_OC = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $linea->ARTICULO = $datos['ARTICULO'];
                                    $linea->DESCRIPCION = $datos['DESCRIPCION'];
                                    $linea->UNIDAD = $datos['UNIDAD'];
                                    $linea->CANTIDAD = $cantidad;
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
				//$this->redirect(array('admin'));
                                $this->redirect(array('admin&men=S003'));
                        }
                }
		$this->render('create',array(
			'model'=>$model,
                        'linea'=>$linea,
                        'articulo'=>$articulo,
                        'config' => $config,
                        'ruta'=>$ruta,
                        'ruta2'=>$ruta2
                        
		));
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
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';
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
                        
			if($model->save()){
                            if(isset($_POST['SolicitudOcLinea'])){
                                foreach ($_POST['SolicitudOcLinea'] as $datos){                                    
                                    $linea=SolicitudOcLinea::model()->findByPk($datos['SOLICITUD_OC_LINEA']);
                                    $linea->SOLICITUD_OC = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $linea->ARTICULO = $datos['ARTICULO'];
                                    $linea->DESCRIPCION = $datos['DESCRIPCION'];
                                    $linea->UNIDAD = $datos['UNIDAD'];
                                    $linea->CANTIDAD = Controller::unformat($datos['CANTIDAD']);
                                    $linea->FECHA_REQUERIDA = $datos['FECHA_REQUERIDA'];
                                    $linea->COMENTARIO = $datos ['COMENTARIO'];
                                    $linea->SALDO = Controller::unformat($datos ['SALDO']);
                                    $linea->LINEA_NUM = $i;
                                    //$linea->ESTADO = $datos ['ESTADO'];
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
				//$this->redirect(array('admin'));
                                $this->redirect(array('admin&men=S002'));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
                        'linea'=>$linea,
                        'articulo'=>$articulo,
                        'config'=>$config,
                        'items'=>$items,
                        'ruta'=>$ruta,
                        'ruta2'=>$ruta2,
		));
	}

        
        public function actionformatoPDF() {

            $id = $_GET['id'];
            
            $this->solicitud = SolicitudOc::model()->findByPk($id);
            $lineas = new SolicitudOcLinea;
            $this->layout = ConfCo::model()->find()->fORMATOSOLICITUD->pLANTILLA->RUTA;
            
            $footer = '<table width="100%">
                    <tr><td align="center" valign="middle"><span class="piePagina"><b>Generado por:</b> ' . Yii::app()->user->name . '</span></td>
                        <td align="center" valign="middle"><span class="piePagina"><b>Generado el:</b> ' . date('Y/m/d') . '</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" valign="middle">Desarrollado por Tramasoft Soluciones TIC - <a href="http://www.tramasoft.com">www.tramasoft.com</a></td>
                    </tr>
                    </table>';
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $mPDF1->WriteHTML($this->render('pdf', array('model' => $this->solicitud,'model2'=>$lineas), true));
            $mPDF1->SetHTMLFooter($footer);

            $mPDF1->Output();
            Yii::app()->end();
        }
                
        public function actionCargarArticulo(){
            
            $item_id = $_GET['buscar'];
            $bus = Articulo::model()->findByPk($item_id,  'ACTIVO = "S"');
            $res = array(
                 'DESCRIPCION'=>$bus->NOMBRE,
                 'UNIDAD' => $bus->UNIDAD_ALMACEN,
                 'UNIDAD_NOMBRE' => $bus->uNIDADALMACEN->NOMBRE,
                 'UNIDADES' => CHtml::listData(UnidadMedida::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>$bus->uNIDADALMACEN->TIPO)),'ID','NOMBRE'),
                 'ID'=>$bus->ARTICULO,
                );
             echo CJSON::encode($res);
            
            
        }
        
        public function actionAgregarlinea(){
            $linea = new SolicitudOcLinea;
            $linea->attributes = $_POST['SolicitudOcLinea'];
            $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';            
            
            if($linea->validate()){
                     echo '<div id="alert" class="alert alert-success" data-dismiss="modal">
                            <h2 align="center">Operacion Satisfactoria</h2>
                            </div>
                     <span id="form-cargado" style="display:none">';
                          $this->renderPartial('modal', 
                            array(
                                'linea'=>$linea,
                                'ruta'=>$ruta,
                                'Pactualiza'=>isset($_POST['ACTUALIZA']) ? $_POST['ACTUALIZA'] : 0,
                            )
                        );
                     echo '</span>
                         
                         <div id="boton-cargado" class="modal-footer">';
                            $this->widget('bootstrap.widgets.TbButton', array(
                                 'buttonType'=>'button',
                                 'type'=>'normal',
                                 'label'=>'Aceptar',
                                 'icon'=>'ok',
                                 'htmlOptions'=>array('id'=>'nuevo','onclick'=>'agregar("'.$_POST['SPAN'].'")')
                              ));
                     echo '</div>';
                     Yii::app()->end();
                    }else{
                    $this->renderPartial('modal', 
                        array(
                            'linea'=>$linea,
                            'ruta'=>$ruta,                            
                        )
                    );
                    Yii::app()->end();
                }
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
            
           $this->widget('bootstrap.widgets.TbAlert');
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
            
           $this->widget('bootstrap.widgets.TbAlert');
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
            
           $this->widget('bootstrap.widgets.TbAlert');
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
			$this->loadModel($id)->updateByPk($id,array('ACTIVO'=>'N'));

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