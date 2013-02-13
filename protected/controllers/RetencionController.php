<?php

class RetencionController extends Controller
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
		$model=new Retencion('search');
                $model->unsetAttributes();
                $this->render('excel',array(
			'model' => $model,
		));
	}
        
        public function actionPdf(){
            
            $dataProvider=new Retencion;
		$this->render('pdf',array(
			'dataProvider'=>$dataProvider,
		));
            
            
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Retencion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Retencion']))
			$model->attributes=$_GET['Retencion'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionCargarretencion(){
            
               $item_id = (int)$_GET['id'];
               $bus = Retencion::model()->findByPk($item_id);

               $res = array(
                   'ID'=>$bus->ID,
                   'NOMBRE'=>$bus->NOMBRE,
               );

              echo CJSON::encode($res);
             
        }
}
