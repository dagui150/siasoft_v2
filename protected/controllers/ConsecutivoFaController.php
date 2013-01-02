<?php

class ConsecutivoFaController extends SBaseController
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
        /*
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
		$model=new ConsecutivoFa;

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['ConsecutivoFa']))
		{
			$model->attributes=$_POST['ConsecutivoFa'];
                        if(isset($_POST['ConsecutivoFa']['CLASIFICACION'])){
                            $model->CLASIFICACION = $_POST['ConsecutivoFa']['CLASIFICACION'];
                        }
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ConsecutivoFa']))
		{
			$model->attributes=$_POST['ConsecutivoFa'];
                        if(isset($_POST['ConsecutivoFa']['CLASIFICACION'])){
                            $model->CLASIFICACION = $_POST['ConsecutivoFa']['CLASIFICACION'];
                        }
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
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
			ConsecutivoFa::model()->updateByPk($id,array('ACTIVO'=>'N'));

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
	}
        
        public function actionRestaurar($id)
	{
            $this->loadModel($id)->updateByPk($id,array('ACTIVO'=>'S'));
		
	}


	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ConsecutivoFa');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ConsecutivoFa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ConsecutivoFa']))
			$model->attributes=$_GET['ConsecutivoFa'];

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
		$model=ConsecutivoFa::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='consecutivo-fa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
