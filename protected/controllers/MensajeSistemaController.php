<?php

class MensajeSistemaController extends Controller
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
		$model2=new MensajeSistema;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['MensajeSistema']))
		{
			$model2->attributes=$_POST['MensajeSistema'];
			if($model->save()){
				//$this->redirect(array('view','id'=>$model->CODIGO));
                                $this->redirect(array('admin&men=S003'));
                        } else {
                            $this->redirect(array('admin&men=E003'));
                        }
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

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['MensajeSistema']))
		{
			$model2->attributes=$_POST['MensajeSistema'];
			if($model2->save()){
				//$this->redirect(array('view','id'=>$model->CODIGO));
                            $this->redirect(array('admin&men=S002'));
                        } else {
                            $this->redirect(array('admin&men=E002'));
                        }
		}

		$this->render('update',array(
			'model2'=>$model2,
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
			$this->loadModel($id)->updateByPk($id,array('ACTIVO'=>'N'));

                        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                        if(!isset($_GET['ajax']))
                                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
                }
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MensajeSistema('search');
		$model->unsetAttributes();  // clear any default values
                
                $model2=new MensajeSistema;
                
                // Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);
                
                if(isset($_POST['MensajeSistema']))
		{
			$model2->attributes=$_POST['MensajeSistema'];
			if($model2->save()){
				//$this->redirect(array('admin'));
                                $this->redirect(array('admin&men=S003'));
                        } else {
                            $this->redirect(array('admin&men=E003'));
                        }
		}
		if(isset($_GET['MensajeSistema']))
			$model->attributes=$_GET['MensajeSistema'];

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
		$model=MensajeSistema::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mensaje-sistema-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionCargarmensajeSistema(){
            echo CJSON::encode(CHtml::listData(MensajeSistema::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>$_GET['tipo'])),'CODIGO','MENSAJE'));
        }
}
