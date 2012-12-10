<?php

class ConfCiController extends SBaseController
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ConfCi;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ConfCi']))
		{
			$model->attributes=$_POST['ConfCi'];
                        
                        $model->EXIST_DISPONIBLE=$_POST['ConfCi']['EXIST_DISPONIBLE'];
                        $model->EXIST_REMITIDA=$_POST['ConfCi']['EXIST_REMITIDA'];
                        $model->EXIST_RESERVADA=$_POST['ConfCi']['EXIST_RESERVADA'];
                        
                        if($model->USA_CODIGO_BARRAS){
                            $model->EAN13_REGLA_LOCAL=$_POST['ConfCi']['EAN13_REGLA_LOCAL'].''.$_POST['PRODUCTO_EAN13'];
                            $model->UCC12_REGLA_LOCAL=$_POST['ConfCi']['UCC12_REGLA_LOCAL'].''.$_POST['PRODUCTO_UCC12'];
                        }

			if($model->save())
				$this->redirect(Yii::app()->user->returnUrl);
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
                
                $regla1=  substr($model->EAN13_REGLA_LOCAL, 0,3);
                $regla2=  substr($model->EAN13_REGLA_LOCAL, 3,5);
                $regla3=  substr($model->UCC12_REGLA_LOCAL, 0,1);
                $regla4=  substr($model->UCC12_REGLA_LOCAL, 1,5);
                
                /*echo $regla1.' - '.$regla2;
                echo $regla3.' - '.$regla4;
                
                exit();*/

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
		if(isset($_POST['ConfCi']))
		{
			$model->attributes=$_POST['ConfCi'];
                        
			$model->EXIST_DISPONIBLE=$_POST['ConfCi']['EXIST_DISPONIBLE'];
                        $model->EXIST_REMITIDA=$_POST['ConfCi']['EXIST_REMITIDA'];
                        $model->EXIST_RESERVADA=$_POST['ConfCi']['EXIST_RESERVADA'];
                        
                        if($model->ASISTENCIA_AUTOMAT == true){
                                $model->EAN13_REGLA_LOCAL=$_POST['ConfCi']['EAN13_REGLA_LOCAL'].''.$_POST['PRODUCTO_EAN13'];
                                $model->UCC12_REGLA_LOCAL=$_POST['ConfCi']['UCC12_REGLA_LOCAL'].''.$_POST['PRODUCTO_UCC12'];
                        }
                        
			if($model->save())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		$this->render('update',array(
			'model'=>$model,
                        'regla1'=>$regla1,
                        'regla2'=>$regla2,
                        'regla3'=>$regla3,
                        'regla4'=>$regla4,
		));
	}

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ConfCi::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'La pagina solicitada no existe.');
		return $model;
	}

	/**
        
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='conf-ci-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
