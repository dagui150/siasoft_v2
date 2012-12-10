<?php

class ExistenciaBodegaController extends SBaseController
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
		$model=new ExistenciaBodega;
		$model2=new ExistenciaBodega('search');
		$bodega=new Bodega;
                $articulo =$_GET['id'];
                $barticulo = Articulo::model()->findByPk($articulo);
                
		$this->performAjaxValidation($model);
                
		if(isset($_POST['ExistenciaBodega']))
		{
			$model->attributes=$_POST['ExistenciaBodega'];
			if($model->save())
				$this->redirect(array('create','id'=>$articulo));
		}
                
                if(isset($_GET['ExistenciaBodega']))
			$model2->attributes=$_GET['ExistenciaBodega'];
                
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
            
              $bus = Bodega::model()->findByPk($_POST['ExistenciaBodega']['BODEGA']);
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
		$model=$this->loadModel($id);
                $model2=new ExistenciaBodega('search');
		$bodega=new Bodega;
                $articulo = $model->ARTICULO;
                $barticulo = Articulo::model()->findByPk($articulo);
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ExistenciaBodega']))
		{
			$model->attributes=$_POST['ExistenciaBodega'];
			if($model->save())
				$this->redirect(array('create','id'=>$articulo));
		}
                
                 if(isset($_GET['ExistenciaBodega']))
			$model2->attributes=$_GET['ExistenciaBodega'];
                
                if(isset($_GET['Bodega']))
			$bodega->attributes=$_GET['Bodega'];
                
		$this->render('update',array(
			'model'=>$model,
                        'model2'=>$model2,
                        'articulo'=>$articulo,
                        'barticulo'=>$barticulo,
			'bodega'=>$bodega,
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
			$this->loadModel($id)->delete();

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
		$dataProvider=new CActiveDataProvider('ExistenciaBodega');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ExistenciaBodega('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ExistenciaBodega']))
			$model->attributes=$_GET['ExistenciaBodega'];

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
		$model=ExistenciaBodega::model()->findByPk($id);
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
