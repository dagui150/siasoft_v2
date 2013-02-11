<?php

class MetodoValuacionInvController extends Controller
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new MetodoValuacionInv('search');
		$model->unsetAttributes();  // clear any default values
				
		if(isset($_GET['MetodoValuacionInv']))
			$model->attributes=$_GET['MetodoValuacionInv'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
