<?php

class ClienteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2'; 
        /**
         *
         * @var array tendra la configuracion de facturacion
         */
	public $conf=array(); 

	/**
	 * @return array action filters
	 */
	public function filters(){
      return array(
				array('CrugeAccessControlFilter'),
			);
    }

        public function actionAutocompletar(){
            if (isset($_GET['term']) && isset($_GET['impuesto'])) {
		
                    $qtxt ="SELECT ID FROM impuesto WHERE ID LIKE :ID";
                    $command =Yii::app()->db->createCommand($qtxt);
                    $command->bindValue(":ID", '%'.$_GET['term'].'%', PDO::PARAM_STR);
                    $res =$command->queryColumn();
            }
            if (isset($_GET['term']) && isset($_GET['regimen'])) {
		
                    $qtxt ="SELECT REGIMEN FROM regimen_tributario WHERE REGIMEN LIKE :ID";
                    $command =Yii::app()->db->createCommand($qtxt);
                    $command->bindValue(":ID", '%'.$_GET['term'].'%', PDO::PARAM_STR);
                    $res =$command->queryColumn();
            }
            echo CJSON::encode($res);
	    Yii::app()->end();
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
		$model= new Cliente('insert');
		$nit= new Nit('search');
		$impuesto= new Impuesto('search');
		$regimen= new RegimenTributario('search');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Cliente']))
		{
			$model->attributes=$_POST['Cliente'];
                        $model->ZONA = ($_POST['Cliente']['ZONA'] != '') ? $_POST['Cliente']['ZONA'] : NULL;
                        $model->CONDICION_PAGO = ($_POST['Cliente']['CONDICION_PAGO'] != '') ? $_POST['Cliente']['CONDICION_PAGO'] : NULL;
                        $model->TIPO_PRECIO = ($_POST['Cliente']['TIPO_PRECIO'] != '') ? $_POST['Cliente']['TIPO_PRECIO'] : NULL;
                        $model->PAIS = ($_POST['Cliente']['PAIS'] != '') ? $_POST['Cliente']['PAIS'] : NULL;
                        $model->ZONA = ($_POST['Cliente']['ZONA'] != '') ? $_POST['Cliente']['ZONA'] : NULL;
                        $model->NIT = ($_POST['Cliente']['NIT'] != '') ? $_POST['Cliente']['NIT'] : NULL;
                        $model->REGIMEN = ($_POST['Cliente']['REGIMEN'] != '') ? $_POST['Cliente']['REGIMEN'] : NULL;
                        $model->IMPUESTO = ($_POST['Cliente']['IMPUESTO'] != '') ? $_POST['Cliente']['IMPUESTO'] : NULL;
                        $model->UBICACION_GEOGRAFICA1 = ($_POST['Cliente']['UBICACION_GEOGRAFICA1'] != '') ? $_POST['Cliente']['UBICACION_GEOGRAFICA1'] : NULL;
                        $model->UBICACION_GEOGRAFICA2 = ($_POST['Cliente']['UBICACION_GEOGRAFICA2'] != '') ? $_POST['Cliente']['UBICACION_GEOGRAFICA2'] : NULL;
                        $model->ACTIVO = 'S';
                        
                        $model->INTERES_CORRIENTE = $_POST['Cliente']['INTERES_CORRIENTE'];
                        $model->INTERES_MORA = $_POST['Cliente']['INTERES_MORA'];
                        $model->DESCUENTO = $_POST['Cliente']['DESCUENTO'];
                        $model->LIMITE_CREDITO = $_POST['Cliente']['LIMITE_CREDITO'];
                        
			if($model->save()){
                            $this->redirect(array('admin'));                            
                        }
		}

                if(isset($_GET['Nit']))
			$nit->attributes=$_GET['Nit'];
                
                if(isset($_GET['Impuesto']))
			$impuesto->attributes=$_GET['Impuesto'];
                
                if(isset($_GET['RegimenTributario']))
			$regimen->attributes=$_GET['RegimenTributario'];
                
		$this->render('create',array(
			'model'=>$model,
			'nit'=>$nit,
			'impuesto'=>$impuesto,
			'regimen'=>$regimen,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $nit= new Nit('search');
		$impuesto= new Impuesto('search');
		$regimen= new RegimenTributario('search');

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Cliente']))
		{
			$model->attributes=$_POST['Cliente'];
                        $model->CONDICION_PAGO = ($_POST['Cliente']['CONDICION_PAGO'] != '') ? $_POST['Cliente']['CONDICION_PAGO'] : NULL;
                        $model->TIPO_PRECIO = ($_POST['Cliente']['TIPO_PRECIO'] != '') ? $_POST['Cliente']['TIPO_PRECIO'] : NULL;
                        $model->PAIS = ($_POST['Cliente']['PAIS'] != '') ? $_POST['Cliente']['PAIS'] : NULL;
                        $model->ZONA = ($_POST['Cliente']['ZONA'] != '') ? $_POST['Cliente']['ZONA'] : NULL;
                        $model->NIT = ($_POST['Cliente']['NIT'] != '') ? $_POST['Cliente']['NIT'] : NULL;
                        $model->REGIMEN = ($_POST['Cliente']['NIT'] != '') ? $_POST['Cliente']['REGIMEN'] : NULL;
                        $model->IMPUESTO = ($_POST['Cliente']['NIT'] != '') ? $_POST['Cliente']['IMPUESTO'] : NULL;
                        $model->UBICACION_GEOGRAFICA1 = ($_POST['Cliente']['UBICACION_GEOGRAFICA1'] != '') ? $_POST['Cliente']['UBICACION_GEOGRAFICA1'] : NULL;
                        $model->UBICACION_GEOGRAFICA2 = ($_POST['Cliente']['UBICACION_GEOGRAFICA2'] != '') ? $_POST['Cliente']['UBICACION_GEOGRAFICA2'] : NULL;

			if($model->save())
				$this->redirect(array('admin'));
		}
                
                 if(isset($_GET['Nit']))
			$nit->attributes=$_GET['Nit'];
                
                if(isset($_GET['Impuesto']))
			$impuesto->attributes=$_GET['Impuesto'];
                
                if(isset($_GET['RegimenTributario']))
			$regimen->attributes=$_GET['RegimenTributario'];
                
		$this->render('update',array(
			'model'=>$model,
			'nit'=>$nit,
			'impuesto'=>$impuesto,
			'regimen'=>$regimen,
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
			Cliente::model()->updateByPk($id, array('ACTIVO'=>'N'));

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
	}

        public function actionRestaurar($id)
	{
			$this->loadModel($id)->updateByPk($id,array('ACTIVO'=>'S'));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cliente('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cliente']))
			$model->attributes=$_GET['Cliente'];

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
		$model=Cliente::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='cliente-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
}
