<?php

class ConsecutivoCiController extends SBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $breadcrumbs=array();
        
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
		$model2=new ConsecutivoCi;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model2);

		if(isset($_POST['ConsecutivoCi']))
		{
			$model2->attributes=$_POST['ConsecutivoCi'];
			if($model2->save())
				$this->redirect(array('admin',));
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
                $tipos = ConsecCiTipoTrans::model()->findAll('CONSECUTIVO_CI = "'.$id.'"');
                $usuarios = ConsecCiUsuario::model()->findAll('CONSECUTIVO_CI = "'.$id.'"');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['ConsecutivoCi']))
		{
			$model2->attributes=$_POST['ConsecutivoCi'];
			if($model2->save())
                            //ACTUALIZAR REGISTROS
                            if(isset($_POST['ConsecCiTipoTrans'])){
                                foreach ($_POST['ConsecCiTipoTrans'] as $datos){
                                     $conTipo = ConsecCiTipoTrans::model()->findByPk($datos['ID']);
                                     $conTipo->CONSECUTIVO_CI = $model2->ID;
                                     $conTipo->TIPO_TRANSACCION = $datos['TIPO_TRANSACCION'];
                                     $conTipo->ACTIVO = 'S';
                                     $conTipo->save();
                                }
                            }
                            if(isset($_POST['ConsecCiUsuario'])){
                                    foreach ($_POST['ConsecCiUsuario'] as $datos){
                                         $conUsuario = ConsecCiUsuario::model()->findByPk($datos['ID']);
                                         $conUsuario->CONSECUTIVO_CI = $model2->ID;
                                         $conUsuario->USUARIO = $datos['USUARIO'];
                                         $conUsuario->ACTIVO = 'S';
                                         $conUsuario->save();
                                    }
                            }
                            //ELIMINAR REGISTROS
                            if(isset($_POST['eliminar'])){
                                $arEliminar = explode(',',$_POST['eliminar']);
                                foreach($arEliminar as $elimina){
                                    $borrar = ConsecCiTipoTrans::model()->deleteByPk($elimina);
                                    
                                }
                                
                            }
                            $arEliminar = '';
                            if(isset($_POST['eliminarUsuario'])){
                                $arEliminar = explode(',',$_POST['eliminarUsuario']);
                                foreach($arEliminar as $elimina){
                                    $borrar = ConsecCiUsuario::model()->deleteByPk($elimina);
                                    
                                }
                                
                            }
                            //NUEVOS REGISTROS
                            if(isset($_POST['ConsecCiTipoTransNuevo'])){
                                foreach ($_POST['ConsecCiTipoTransNuevo'] as $datos){
                                     $conTipo = new ConsecCiTipoTrans;
                                     $conTipo->CONSECUTIVO_CI = $model2->ID;
                                     $conTipo->TIPO_TRANSACCION = $datos['TIPO_TRANSACCION'];
                                     $conTipo->ACTIVO = 'S';
                                     $conTipo->save();
                                }
                            }
                            
                            if(isset($_POST['UsuariosNuevo'])){
                                    foreach ($_POST['UsuariosNuevo'] as $datos){
                                         $conUsuario = new ConsecCiUsuario;
                                         $conUsuario->CONSECUTIVO_CI = $model2->ID;
                                         $conUsuario->USUARIO = $datos['USERNAME'];
                                         $conUsuario->ACTIVO = 'S';
                                         $conUsuario->save();
                                    }
                            }
                            
                            $this->redirect(array('view','id'=>$model2->ID));
		}

		$this->render('update',array(
			'model2'=>$model2,
			'tipos'=>$tipos,
			'usuarios'=>$usuarios,
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
		$dataProvider=new CActiveDataProvider('ConsecutivoCi');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ConsecutivoCi('search');
		$model->unsetAttributes();  // clear any default values
                
                $model2=new ConsecutivoCi;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model2);

		if(isset($_POST['ConsecutivoCi']))
		{
			$model2->attributes=$_POST['ConsecutivoCi'];
			if($model2->save())
                            
                            if(isset($_POST['ConsecCiTipoTransNuevo'])){
                                foreach ($_POST['ConsecCiTipoTransNuevo'] as $datos){
                                     $conTipo = new ConsecCiTipoTrans;
                                     $conTipo->CONSECUTIVO_CI = $_POST['ConsecutivoCi']['ID'];
                                     $conTipo->TIPO_TRANSACCION = $datos['TIPO_TRANSACCION'];
                                     $conTipo->ACTIVO = 'S';
                                     $conTipo->save();
                                }
                            }
                            
                            if($model2->TODOS_USUARIOS == 'N'){
                                if(isset($_POST['Usuarios'])){
                                    foreach ($_POST['Usuarios'] as $datos){
                                         $conUsuario = new ConsecCiUsuario;
                                         $conUsuario->CONSECUTIVO_CI = $_POST['ConsecutivoCi']['ID'];
                                         $conUsuario->USUARIO = $datos['USERNAME'];
                                         $conUsuario->ACTIVO = 'S';
                                         $conUsuario->save();
                                    }
                               }
                            }
                           $this->redirect(array('admin',));
		}
                
		if(isset($_GET['ConsecutivoCi']))
			$model->attributes=$_GET['ConsecutivoCi'];

		$this->render('admin',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ConsecutivoCi::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='consecutivo-ci-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionCargartransaccion(){
            
               $var = $_POST['Base'];
               $data= TipoTransaccion::model()->findAll('TRANSACCION_BASE = "'.$var.'"');
               
               $data=CHtml::listData($data,'TIPO_TRANSACCION','NOMBRE');
               echo "<option value=''>Seleccione</option>";
               foreach($data as $value=>$name)
               {
                       echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
               }
            
        }
}
