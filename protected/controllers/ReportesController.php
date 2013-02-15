<?php

class ReportesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2'; 
	/**
	 * @return array action filters
	 */
	public function filters(){
            return array(
                                      array('CrugeAccessControlFilter'),
                              );
          }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ventas' page.
	 */
	public function actionVentas()
	{
                $model=new Reportes;
		$this->render('ventas',array(
			'model'=>$model,
		));
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ventas' page.
	 */
	public function actionInventario()
	{
                $model=new Reportes;
		$this->render('inventario',array(
			'model'=>$model,
		));
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ordenCompra' page.
	 */
	public function actionOrdenCompra()
	{
                $model=new Reportes;
		$this->render('ordenCompra',array(
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
		$model=ConfAs::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='reportes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
