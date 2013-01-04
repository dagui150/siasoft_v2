<?php

class ExistenciaBodegasController extends SBaseController
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
		$model=new ExistenciaBodegas;
		$model2=new ExistenciaBodegas('search');
		$bodega=new Bodega;
                $articulo =$_GET['id'];
                $barticulo = Articulo::model()->findByPk($articulo);
                
		$this->performAjaxValidation($model);
                
		if(isset($_POST['ExistenciaBodegas']))
		{
			$model->attributes=$_POST['ExistenciaBodegas'];
			if($model->save())
				$this->redirect(array('create','id'=>$articulo));
		}
                
                if(isset($_GET['ExistenciaBodegas']))
			$model2->attributes=$_GET['ExistenciaBodegas'];
                
                if(isset($_GET['Bodega']))
			$bodega->attributes=$_GET['Bodega'];
                
		$this->render('create',array(
			'model'=>$model,
			'model2'=>$model2,
			'bodega'=>$bodega,
			'articulo'=>$articulo,
			'barticulo'=>$barticulo,
		));
	}
        
        public function actionCargarAjax(){
            
              $bus = Bodega::model()->findByPk($_POST['ExistenciaBodegas']['BODEGA']);
              if($bus)
                   echo CHtml::tag('input',array('size'=>15,'disabled'=>true,'id'=>'BODEGA2','name'=>'BODEGA2','value'=>$bus->DESCRIPCION));  
               else
                  echo CHtml::tag('input',array('size'=>15,'disabled'=>true,'id'=>'BODEGA2','name'=>'BODEGA2','value'=>'Ninguno'));

           
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            /*                
		$model=$this->loadModel($id);
                $model2=new ExistenciaBodegas('search');
		$bodega=new Bodega;
                $articulo = $model->ARTICULO;
                $barticulo = Articulo::model()->findByPk($articulo);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ExistenciaBodegas']))
		{
			$model->attributes=$_POST['ExistenciaBodegas'];
			if($model->save())
				$this->redirect(array('create','id'=>$articulo));
		}
                
                 if(isset($_GET['ExistenciaBodegas']))
			$model2->attributes=$_GET['ExistenciaBodegas'];
                
                if(isset($_GET['Articulo']))
			$articulo->attributes=$_GET['Articulo'];
                
		$this->render('update',array(
			'model'=>$model,
                        'model2'=>$model2,
                        'articulo'=>$articulo,
                        'barticulo'=>$barticulo,
			'bodega'=>$bodega,
		));
             * 
             */
                
                $linea= new ExistenciaBodegas;
                $i = 1;
                // retrieve items to be updated in a batch mode
                // assuming each item is of model class 'Item'
                $items = $linea->model()->findAll('BODEGA = '.$id);
                
                
                //$model=$this->loadModel($id);
                $model = ExistenciaBodegas::model()->findAll('BODEGA = '.$id);
                $i = 1;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($model));
                
                if(isset($_POST['ExistenciaBodegas']))
		{
			$model->attributes=$_POST['ExistenciaBodegas'];
                         if($_POST['eliminar'] != ''){
                            $eliminar = explode(",", $_POST['eliminar']);
                            foreach($eliminar as $elimina){
                                if($elimina != -1){
                                    $borra = ExistenciaBodegas::model()->deleteByPk($elimina);
                                }
                            }
                        }
                        
			if($model->save()){
                            if(isset($_POST['ExistenciaBodegas'])){
                                foreach ($_POST['ExistenciaBodegas'] as $datos){                                    
                                    $linea=ExistenciaBodegas::model()->findByPk($datos['SOLICITUD_OC_LINEA']);
                                    $linea->SOLICITUD_OC = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $linea->ARTICULO = $datos['ARTICULO'];
                                    $linea->DESCRIPCION = $datos['DESCRIPCION'];
                                    $linea->UNIDAD = $datos['UNIDAD'];
                                    $linea->CANTIDAD = SBaseController::unformat($datos['CANTIDAD']);
                                    $linea->FECHA_REQUERIDA = $datos['FECHA_REQUERIDA'];
                                    $linea->COMENTARIO = $datos ['COMENTARIO'];
                                    $linea->SALDO = SBaseController::unformat($datos ['SALDO']);
                                    $linea->LINEA_NUM = $i;
                                    $linea->ESTADO = $datos ['ESTADO'];
                                    $linea->save();
                                    $i++;
                                }
                            }
                            
                            if(isset($_POST['Nuevo'])){
                                foreach ($_POST['Nuevo'] as $datos2){
                                    $linea2=new SolicitudOcLinea;
                                    $linea2->SOLICITUD_OC = $_POST['SolicitudOc']['SOLICITUD_OC'];
                                    $linea2->ARTICULO = $datos2['ARTICULO'];
                                    $linea2->DESCRIPCION = $datos2['DESCRIPCION'];
                                    $linea2->UNIDAD = $datos2['UNIDAD'];
                                    $linea2->CANTIDAD = $datos2['CANTIDAD'];
                                    $linea2->FECHA_REQUERIDA = $datos2['FECHA_REQUERIDA'];
                                    $linea2->COMENTARIO = $datos2 ['COMENTARIO'];
                                    $linea2->SALDO = $datos2 ['SALDO'];
                                    $linea2->LINEA_NUM = $i;
                                    $linea2->ESTADO = $datos2 ['ESTADO'];
                                    $linea2->save();
                                    $i++;
                                }
                            }
				//$this->redirect(array('admin'));
                                $this->redirect(array('admin&men=S002'));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
                        'id'=>$id,
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
			throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ExistenciaBodegas');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
                $model=new ExistenciaBodegas;
		$model2=new ExistenciaBodegas('search');
		$articulo=new articulo;
                $bodega =$_GET['id'];
                $bbodega = Bodega::model()->findByPk($bodega);
                
		$this->performAjaxValidation($model);
                
		if(isset($_POST['ExistenciaBodegas']))
		{
			$model->attributes=$_POST['ExistenciaBodegas'];
			if($model->save())
				$this->redirect(array('create','id'=>$bodega));
		}
                
                if(isset($_GET['ExistenciaBodegas']))
			$model2->attributes=$_GET['ExistenciaBodegas'];
                
                if(isset($_GET['Bodega']))
			$bodega->attributes=$_GET['Bodega'];
                
		$this->render('admin',array(
			'model'=>$model,
			'model2'=>$model2,
			'articulo'=>$articulo,
			'bodega'=>$bodega,
			'bbodega'=>$bbodega,
		));
                
                ///////////////////////////////////////////////////////////////////////////
                /*
		$model=new ExistenciaBodegas('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ExistenciaBodegas']))
			$model->attributes=$_GET['ExistenciaBodegas'];

		$this->render('admin',array(
			'model'=>$model,
		));
                */
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ExistenciaBodegas::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='existencia-bodega-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
