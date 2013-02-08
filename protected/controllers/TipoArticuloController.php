<?php

class TipoArticuloController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	/**
	/**
	 * @return array action filters
	 */
	 public function filters(){
            return array(
                                      array('CrugeAccessControlFilter'),
                              );
          }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TipoArticulo('search');
		$model->unsetAttributes();  // clear any default values
                
                $model2=new TipoArticulo;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['TipoArticulo']))
		{
			$model2->attributes=$_POST['TipoArticulo'];
			if($model2->save())
				$this->redirect(array('admin'));
		}
                
		if(isset($_GET['TipoArticulo']))
			$model->attributes=$_GET['TipoArticulo'];

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
		$model=TipoArticulo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='tipo-articulo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
