<?php

class PaisController extends Controller
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
            return array(array('CrugeAccessControlFilter'), );
        }
        
        public function actionExcel()
	{
		$model = new Pais('search');
                $model->unsetAttributes();
                $this->render('excel',array(
			'model' => $model,
		));
	}
        
        
        public function actionPdf(){
            
            $dataProvider=new Pais;
		$this->render('pdf',array(
			'dataProvider'=>$dataProvider,
		));
            
            
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pais('search');
		$model->unsetAttributes();  // clear any default values
		
		
		if(isset($_GET['Pais']))
			$model->attributes=$_GET['Pais'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
