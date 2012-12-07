<?php

class NitController extends SBaseController
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
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	/*public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

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
		$model = new Nit;
                $transaction = $model->dbConnection->beginTransaction();
                // Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

                if (isset($_POST['LineaNueva'])) {
                    /*echo '<pre>';
                    print_r($_POST['LineaNueva']);
                    echo '</pre>';
                    Yii::app()->end();*/
                    try {
                        foreach ($_POST['LineaNueva'] as $datos) {
                                $model = new Nit;
                                $model->ID = $datos['ID'];
                                $model->TIIPO_DOCUMENTO = $datos['TIIPO_DOCUMENTO'];
                                $model->RAZON_SOCIAL = $datos['RAZON_SOCIAL'];
                                $model->ALIAS = $datos['ALIAS'];
                                $model->OBSERVACIONES = $datos['OBSERVACIONES'];
                                $model->ACTIVO = 'S';
                                
                                $model->save();
                               // $model->unsetAttributes();
                        }
                        
                        $transaction->commit();
                        $this->redirect(array('admin'));
                        Yii::app()->end();
                    }catch (Exception $e) {
                        echo $e;
                        $transaction->rollback();
                    }
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
		$model2=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['Nit']))
		{
			$model2->attributes=$_POST['Nit'];
			if($model2->save())
				$this->redirect(array('admin'));
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

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Nit');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionExcel()
	{
		$model=new Nit('search');
                $model->unsetAttributes();
                $this->render('excel',array(
			'model' => $model,
		));
	}

        public function actionPdf(){
            
            $dataProvider=new Nit;
		$this->render('pdf',array(
			'dataProvider'=>$dataProvider,
		));
            
            
        }
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Nit('search');
                $model->unsetAttributes();  // clear any default values
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		
		if(isset($_GET['Nit']))
			$model->attributes=$_GET['Nit'];

		$this->render('admin',array(
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
		$model=Nit::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='nit-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}


	public function actionMascara() {
                $id = $_GET['id'];                
		$bus=TipoDocumento::model()->find('ID= "'.$id.'"');
                $res = array('MASCARA' => $bus->MASCARA);
                echo CJSON::encode($res);
	}
}