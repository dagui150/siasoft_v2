<?php

class UbicacionGeografica1Controller extends Controller
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
            return array(array('CrugeAccessControlFilter'));
          }
        
           public function actionExcel()
	{
		$model = new UbicacionGeografica1('search');
                $model->unsetAttributes();
                $this->render('excel',array(
			'model' => $model,
		));
	}
        
        
        public function actionPdf(){
            
            $dataProvider=new UbicacionGeografica1;
		$this->render('pdf',array(
			'dataProvider'=>$dataProvider,
		));
            
            
        }

        /**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UbicacionGeografica1('search');
		$model->unsetAttributes();  // clear any default values
				$model2=new UbicacionGeografica1;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['UbicacionGeografica1']))
		{
			$model2->attributes=$_POST['UbicacionGeografica1'];
			if($model2->save())
				$this->redirect(array('admin'));
		}
		if(isset($_GET['UbicacionGeografica1']))
			$model->attributes=$_GET['UbicacionGeografica1'];

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
		$model=UbicacionGeografica1::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ubicacion-geografica1-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
