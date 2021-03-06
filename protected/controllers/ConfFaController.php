<?php

class ConfFaController extends Controller
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ConfFa;
                $condicion = new CodicionPago;
                $bodega = new Bodega;
                $categoria = new Categoria;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ConfFa']))
		{
			$model->attributes=$_POST['ConfFa'];
                        if($_POST['ConfFa']['NIVEL_PRECIO'] == '')
                            $model->NIVEL_PRECIO = NULL;    
                        
                        if($model->save())
				$this->redirect(Yii::app()->user->returnUrl);
		}

		$this->render('create',array(
			'model'=>$model,
                        'condicion'=>$condicion,
                        'categoria'=>$categoria,
                        'bodega'=>$bodega,
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
                $condicion = new CodicionPago;
                $bodega = new Bodega;
                $categoria = new Categoria;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['ConfFa']))
		{
			$model->attributes=$_POST['ConfFa'];
			if($model->save()) {
				//$this->redirect(Yii::app()->user->returnUrl);
				$this->redirect(array('update&id=1&men=S002'));
                        } else {
                            $this->redirect(array('update&id=1&men=E002'));
                        }
		}

		$this->render('update',array(
			'model'=>$model,
                        'condicion'=>$condicion,
                        'categoria'=>$categoria,
                        'bodega'=>$bodega,
		));
	}
        
        public function actionAgregarlinea(){
             if(isset($_GET['idBodega']))
                $this->cargarBodega($_GET['idBodega']);
             
             if(isset($_GET['idCategoria']))
                $this->cargarCategoria($_GET['idCategoria']);
             
             if(isset($_GET['idCondicion']))
                $this->cargarCondicion($_GET['idCondicion']);
        }
        
        protected function cargarBodega($idBodega){
            $bus = Bodega::model()->findByPk($idBodega);
            $res = array('NOMBRE' => $bus->DESCRIPCION);
            echo CJSON::encode($res);
            Yii::app()->end();
        }
        
        protected function cargarCategoria($idCategoria){
            $bus = Categoria::model()->findByPk($idCategoria);
            $res = array('NOMBRE' => $bus->DESCRIPCION);
            echo CJSON::encode($res);
            Yii::app()->end();
        }
        
        protected function cargarCondicion($idCondicion){
            $bus = CodicionPago::model()->findByPk($idCondicion);
            $res = array('NOMBRE' => $bus->DESCRIPCION);
            echo CJSON::encode($res);
            Yii::app()->end();
        }
        
        public function actionCargarCond(){
            
            $item_id = $_GET['buscar'];
            $bus = CodicionPago::model()->findByPk($item_id);
            $res = array(
                'ID' => $bus->ID,
                'NOMBRE' => $bus->DESCRIPCION,
            );
            
            echo CJSON::encode($res);
        }
        
        public function actionCargarBod(){
            
            $item_id = $_GET['buscar'];
            $bus = Bodega::model()->findByPk($item_id);
            $res = array(
                'ID' => $bus->ID,
                'NOMBRE' => $bus->DESCRIPCION,
            );
            
            echo CJSON::encode($res);
        }
        
        public function actionCargarCat(){
            
            $item_id = $_GET['buscar'];
            $bus = Categoria::model()->findByPk($item_id);
            $res = array(
                'ID' => $bus->ID,
                'NOMBRE' => $bus->DESCRIPCION,
            );
            
            echo CJSON::encode($res);
        }
        
        public function actionAutocompletar(){
            if (isset($_GET['term'])) {		
                switch ($_GET['parametro']){
                    case "CON" :
                        $qtxt ="SELECT ID FROM codicion_pago WHERE ID LIKE :ID AND ACTIVO = 'S'";
                        break;
                    
                    case "BOD" :
                        $qtxt ="SELECT ID FROM bodega WHERE ID LIKE :ID AND ACTIVO = 'S'";
                        break;
                    
                    case "CAT" :
                        $qtxt ="SELECT ID FROM nivel_precio WHERE ID LIKE :ID AND ACTIVO = 'S'";
                        break;
                }                    
                    $command =Yii::app()->db->createCommand($qtxt);
                    $command->bindValue(":ID", '%'.$_GET['term'].'%', PDO::PARAM_STR);
                    $res =$command->queryColumn();
            }
            echo CJSON::encode($res);
	    Yii::app()->end();
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ConfFa::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='conf-fa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
