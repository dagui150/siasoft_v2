<?php

class ProveedorController extends Controller
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
		$model=new Proveedor;
                $cuenta = new TipoCuenta;
                $nit = new Nit;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
                        ($_POST['Proveedor']['CONDICION_PAGO'] == '') ? $model->CONDICION_PAGO = NULL : $model->CONDICION_PAGO = $_POST['Proveedor']['CONDICION_PAGO'];
                        if($model->PAIS == 'COL'){
                            $model->CIUDAD = '';
                            $model->UBICACION_GEOGRAFICA1 = $_POST['Proveedor']['UBICACION_GEOGRAFICA1'];
                        }
                        else{
                            $model->UBICACION_GEOGRAFICA2 = NULL;
                            $model->UBICACION_GEOGRAFICA1 = NULL;
                        }
			if($model->save())
				$this->redirect(array('admin'));
		}
                if(isset($_GET['Nit']))
			$nit->attributes=$_GET['Nit'];
                
		$this->render('create',array(
			'model'=>$model,
                        'cuenta'=>$cuenta,
                        'nit'=>$nit,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                $cuenta = new TipoCuenta;
                $nit = new Nit;
                
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Proveedor']))
		{
			$model->attributes=$_POST['Proveedor'];
                        if($model->PAIS == 'COL'){
                            $model->CIUDAD = '';
                            $model->UBICACION_GEOGRAFICA1 = $_POST['Proveedor']['UBICACION_GEOGRAFICA1'];
                        }
                        else{
                            $model->UBICACION_GEOGRAFICA2 = NULL;
                            $model->UBICACION_GEOGRAFICA1 = NULL;
                        }
			if($model->save())
				$this->redirect(array('admin'));
		}
                
                if(isset($_GET['Nit']))
			$nit->attributes=$_GET['Nit'];

		$this->render('update',array(
			'model'=>$model,
                        'cuenta'=>$cuenta,
                        'nit'=>$nit,
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
		$dataProvider=new CActiveDataProvider('Proveedor');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Proveedor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedor']))
			$model->attributes=$_GET['Proveedor'];

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
		$model=Proveedor::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='proveedor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionCargarubicacion(){            
            echo CJSON::encode(CHtml::ListData(UbicacionGeografica2::model()->findAll('UBICACION_GEOGRAFICA1 = "'.$_GET['ubicacion'].'" AND ACTIVO = "S"'),'ID','NOMBRE'));            
        }
        
        public function actionCargarNit() {
            
            $item_id = $_GET['buscar'];
            $bus = Nit::model()->findByPk($item_id);
            $res = array(
                'ID' => $bus->ID,
                'NOMBRE' => $bus->RAZON_SOCIAL,
            );
            
            echo CJSON::encode($res);
        }
        
        public function actionAutocompletar(){
            if (isset($_GET['term'])) {
		
                    $qtxt ="SELECT ID FROM nit WHERE ID LIKE :ID";
                    $command =Yii::app()->db->createCommand($qtxt);
                    $command->bindValue(":ID", '%'.$_GET['term'].'%', PDO::PARAM_STR);
                    $res =$command->queryColumn();
            }
            echo CJSON::encode($res);
	    Yii::app()->end();
        }
        
        public function actionCargarproveedor(){
            $item_id = (int)$_GET['id'];
            $bus = Proveedor::model()->findByPk($item_id);

            $res = array(
                 'PROVEEDOR'=>$bus->PROVEEDOR,
                 'NOMBRE'=>$bus->NOMBRE,
            );

            echo CJSON::encode($res);
        }
        
}
