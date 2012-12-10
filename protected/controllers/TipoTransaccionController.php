<?php

class TipoTransaccionController extends SBaseController
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
		$model2=new TipoTransaccion;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['TipoTransaccion']))
		{
			$model2->attributes=$_POST['TipoTransaccion'];
			if($model2->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model2'=>$model2,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model2=$this->loadModel($id);
                $subTipo = SubtipoTransaccion::model()->findAll('TIPO_TRANSACCION = "'.$id.'"');
                $cantidad = TipoTransaccionCantidad::model()->findAll('TIPO_TRANSACCION = "'.$id.'"');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['TipoTransaccion']))
		{
			$model2->attributes=$_POST['TipoTransaccion'];
			if($model2->save())
                            //  ACTUALIZAR REGISTROS
                            if(isset($_POST['SubtipoTransaccion'])){
                                foreach ($_POST['SubtipoTransaccion'] as $datos){
                                     $subTipo = SubtipoTransaccion::model()->findByPk($datos['ID']);
                                     $subTipo->NOMBRE = $datos['NOMBRE'];
                                     $subTipo->TIPO_TRANSACCION = $model2->TIPO_TRANSACCION;
                                     $subTipo->ACTIVO = 'S';
                                     $subTipo->save();
                                }
                            }
                            if(isset($_POST['TipoTransaccionCantidad'])){
                                foreach ($_POST['TipoTransaccionCantidad'] as $datos){
                                     $cantidad= TipoTransaccionCantidad::model()->findByPk($datos['ID']);
                                     $cantidad->TIPO_TRANSACCION = $model2->TIPO_TRANSACCION;
                                     if(isset($datos['CANTIDAD']))
                                        $cantidad->CANTIDAD = $datos['CANTIDAD'];
                                     $cantidad->ACTIVO = 'S';
                                     $cantidad->save();
                                }
                            }
                            //ELIMINAR REGISTROS
                            if(isset($_POST['eliminar'])){
                                $arEliminar = explode(',',$_POST['eliminar']);
                                foreach($arEliminar as $elimina){
                                    $borrar = SubtipoTransaccion::model()->deleteByPk($elimina);
                                    
                                }
                                
                            }
                            if(isset($_POST['eliminarCantidad'])){
                                $arEliminar = explode(',',$_POST['eliminarCantidad']);
                                foreach($arEliminar as $elimina){
                                    $borrar = TipoTransaccionCantidad::model()->deleteByPk($elimina);
                                    
                                }
                                
                            }
                            //NUEVOS REGISTROS
                            if(isset($_POST['SubtipoTransaccionNuevo'])){
                                foreach ($_POST['SubtipoTransaccionNuevo'] as $datos){
                                     $subTipo=new SubtipoTransaccion;
                                     $subTipo->NOMBRE = $datos['NOMBRE'];
                                     $subTipo->TIPO_TRANSACCION = $model2->TIPO_TRANSACCION;
                                     $subTipo->ACTIVO = 'S';
                                     $subTipo->save();
                                }
                            }
                            if(isset($_POST['CantidadNuevo'])){
                                foreach ($_POST['CantidadNuevo'] as $datos){
                                     $cantidad=new TipoTransaccionCantidad;
                                     $cantidad->TIPO_TRANSACCION = $model2->TIPO_TRANSACCION;
                                     $cantidad->CANTIDAD = $datos['CANTIDAD'];
                                     $cantidad->ACTIVO = 'S';
                                     $cantidad->save();
                                }
                            }
                            $this->redirect(array('admin',));
		}

		$this->render('update',array(
			'model2'=>$model2,
			'subTipo'=>$subTipo,
			'cantidad'=>$cantidad,
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
                        if($id != 0){
                            // we only allow deletion via POST request
                            $this->loadModel($id)->delete();
                            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                            if(!isset($_GET['ajax']))
                                    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'),array('msj'=>$msj));
                        }else
                            throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
		}
		else
			throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TipoTransaccion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TipoTransaccion('search');
		$model->unsetAttributes();  // clear any default values
                
                $model2=new TipoTransaccion;
                $subTipo=new SubtipoTransaccion;
                $cantidad =new TipoTransaccionCantidad;
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['TipoTransaccion']))
		{
			$model2->attributes=$_POST['TipoTransaccion'];
                        
			if($model2->save()){
                            //NUEVOS SUBTIPOS
                            if(isset($_POST['SubtipoTransaccionNuevo'])){
                                foreach ($_POST['SubtipoTransaccionNuevo'] as $datos){
                                     $subTipo=new SubtipoTransaccion;
                                     $subTipo->NOMBRE = $datos['NOMBRE'];
                                     $subTipo->TIPO_TRANSACCION = $_POST['TipoTransaccion']['TIPO_TRANSACCION'];
                                     $subTipo->ACTIVO = 'S';
                                     $subTipo->save();
                                }
                            }
                            //NUEVAS CANTIDADES
                            if(isset($_POST['CantidadNuevo'])){
                                foreach ($_POST['CantidadNuevo'] as $datos){
                                     $cantidad=new TipoTransaccionCantidad;
                                     $cantidad->TIPO_TRANSACCION = $_POST['TipoTransaccion']['TIPO_TRANSACCION'];
                                     $cantidad->CANTIDAD = $datos['CANTIDAD'];
                                     $cantidad->ACTIVO = 'S';
                                     $cantidad->save();
                                }
                            }
                            $this->redirect(array('admin'));
                        }
		}
                
		if(isset($_GET['TipoTransaccion']))
			$model->attributes=$_GET['TipoTransaccion'];
                
		$this->render('admin',array(
			'model'=>$model,
			'model2'=>$model2,
			'subTipo'=>$subTipo,
			'cantidad'=>$cantidad,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=TipoTransaccion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tipo-transaccion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionCargarcantidad(){
            if(isset($_GET['id'])){
                $id= $_GET['id'];
                $res = TipoTransaccionCantidad::model()->findAll('TIPO_TRANSACCION = "'.$id.'"');
            }elseif(isset($_GET['cantidad'])){
                $bus = TipoCantidadArticulo::model()->findByPk($_GET['cantidad']);
                $res = array(
                    'NOMBRE'=>$bus->NOMBRE
                );
            }

            echo CJSON::encode($res);
        }
}
