<?php

class RegimenTributarioController extends Controller
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
		$model=new RegimenTributario('search');
                
		if(isset($_GET['RegimenTributario']))
			$model->attributes=$_GET['RegimenTributario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionCargarregimen(){
               $item_id = $_GET['id'];
               $bus = RegimenTributario::model()->findByPk($item_id);

               $res = array(
                   'REGIMEN'=>$bus->REGIMEN,
                   'DESCRIPCION'=>$bus->DESCRIPCION,
               );

              echo CJSON::encode($res);
        }
        
        public function actionExcel(){
            $model=new RegimenTributario('search');
            $model->unsetAttributes();
            $this->render('excel',array(
                'model' => $model,
            ));
        }

        public function actionPdf(){
            $dataProvider=new RegimenTributario;
            $this->render('pdf',array(
                'dataProvider'=>$dataProvider,
            ));
        }

}
