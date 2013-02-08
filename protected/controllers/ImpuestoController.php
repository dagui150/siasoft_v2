<?php

class ImpuestoController extends Controller
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
            public function actionExcel()
	{
		$model=new Impuesto('search');
                $model->unsetAttributes();
                $this->render('excel',array(
			'model' => $model,
		));
	}
        
        public function actionPdf(){
            
            $dataProvider=new Impuesto;
		$this->render('pdf',array(
			'dataProvider'=>$dataProvider,
		));
            
            
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Impuesto('search');
		$model->unsetAttributes();  // clear any default values
		$model2=new Impuesto; 

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['Impuesto']))
		{
			$model2->attributes=$_POST['Impuesto'];
			if($model2->save()){
				//$this->redirect(array('admin'));
                            $this->redirect(array('admin&men=S003'));
                        } else {
                            $this->redirect(array('admin&men=E003'));
                        }
		}
		if(isset($_GET['Impuesto']))
			$model->attributes=$_GET['Impuesto'];

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
		$model=Impuesto::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='impuesto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        public function actionCargarimpuesto(){
            
               $item_id = $_GET['id'];
               $bus = Impuesto::model()->findByPk($item_id);

               $res = array(
                   'ID'=>$bus->ID,
                   'NOMBRE'=>$bus->NOMBRE,
               );

              echo CJSON::encode($res);
             
        }
}
