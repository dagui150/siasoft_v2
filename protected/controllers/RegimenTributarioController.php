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

<<<<<<< HEAD
=======
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
		$model2=new RegimenTributario;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['RegimenTributario']))
		{
			$model2->attributes=$_POST['RegimenTributario'];
			if($model2->save()){
				//$this->redirect(array('admin'));
                            $this->redirect(array('admin&men=S003'));
                        } else {
                            $this->redirect(array('admin&men=E003'));
                        }
		}

		$this->render('create',array(
			'model2'=>$model2,
		));
	}
        
             public function actionExcel()
	{
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

		if(isset($_POST['RegimenTributario']))
		{
			$model2->attributes=$_POST['RegimenTributario'];
			if($model2->save()){
				//$this->redirect(array('admin'));
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
        
        public function actionRestaurar($id)
	{
            $this->loadModel($id)->updateByPk($id,array('ACTIVO'=>'S'));
		
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('RegimenTributario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
>>>>>>> 9ca759032cd2997cd88c7d79561f8a1f3e9d2ec8

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
}
