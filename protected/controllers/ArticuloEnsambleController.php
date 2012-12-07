<?php

class ArticuloEnsambleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'CargaArticulo', 'iniciar', 'detalle'),
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
                
		//$model=$this->loadModel($id);
		$guardadas= ArticuloEnsamble::model()->findAll('ARTICULO_PADRE = "'.$id.'" AND ACTIVO = "S"');
                $model = new ArticuloEnsamble;
                $articulo = new Articulo;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);             
		
                if(isset($_POST['ARTICULO_PADRE'])){                   
                    $transaction=$model->dbConnection->beginTransaction();
                        try{
                        if(isset($_POST['eliminar'])){
                            $eliminar = explode(",", $_POST['eliminar']);
                            foreach($eliminar as $elimina){
                                if($elimina != -1){
                                    $borra = ArticuloEnsamble::model()->updateByPk($elimina, array('ACTIVO' => 'N'));
                                }
                            }
                        }                        
                        
                        if(isset($_POST['ArticuloEnsamble'])){
                            foreach ($_POST['ArticuloEnsamble'] as $act){
                                $linea = ArticuloEnsamble::model()->findByPk($act['ID']);
                                $linea->ARTICULO_HIJO = $act['ARTICULO_HIJO'];                                
                                $linea->CANTIDAD = $act['CANTIDAD'];
                                $linea->save();
                            }
                        }
                        
                        if(isset($_POST['Nuevo'])){
                            foreach ($_POST['Nuevo'] as $datos){
                                $linea = new ArticuloEnsamble;
                                $linea->ARTICULO_HIJO = $datos['ARTICULO_HIJO'];
                                $linea->ARTICULO_PADRE = $_POST['ARTICULO_PADRE'];
                                $linea->CANTIDAD = $datos['CANTIDAD'];
                                $linea->ACTIVO = "S";
                                $linea->save();
                            }
                        }
                        $transaction->commit();
                        }catch(Exception $e){
                            echo $e;
                            $transaction->rollBack();
                        }
			$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
                        'articulo'=>$articulo,
                        'guardadas'=>$guardadas
		));
	}
        
        public function actionDetalle(){
            if($_POST['check'] != ''){
                $id = $_POST['check'];
                $consulta = ArticuloEnsamble::model()->findAll('ACTIVO = "S" AND ARTICULO_PADRE = "'.$id.'"');
                if(!$consulta){
                    echo '<div id="alert" class="alert alert-warning" data-dismiss="modal">
                            <h2 align="center">Este articulo no tiene componentes asociados</h2>
                            </div>';
                }
                else{
                    echo '<table align="center" class="table table-bordered" >
                        <tr>
                            <td><b>Articulo</b></td>
                            <td><b>Cantidad</b></td>
                        </tr>';
                    foreach($consulta as $con){                    
                        echo '<tr><td>'.$con->aRTICULOHIJO->NOMBRE.'</td>';
                        echo '<td>'.$con->CANTIDAD.'</td></tr>';
                    }
                    echo '</table>';
                }
                
                
            }
            else{
                echo '<div id="alert" class="alert alert-warning" data-dismiss="modal">
                            <h2 align="center">Seleccione un articulo para ver su detalle</h2>
                            </div>';
            }
        }

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('ArticuloEnsamble');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ArticuloEnsamble('search');
                $articulo = new Articulo;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ArticuloEnsamble']))
			$model->attributes=$_GET['ArticuloEnsamble'];

		$this->render('admin',array(
			'model'=>$model,
                        'articulo'=>$articulo,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ArticuloEnsamble::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function actionCargaArticulo() {
            
            $item_id = $_GET['id'];
            $bus = Articulo::model()->findByPk($item_id, 'ACTIVO = "S"');
            if($bus){
                $bus2 = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD_ALMACEN.'"');
                $res = array(
                     'DESCRIPCION'=>$bus->NOMBRE,
                     'UNIDAD'=>$bus2->NOMBRE,
                     'ID'=>$bus->ARTICULO,                     
                );           
             $bus2= '';          
            }
            else{
                $res = array(
                 'DESCRIPCION'=>'Ninguno',
                 'UNIDAD'=>'',
                );
            }            
            echo CJSON::encode($res);
        }
        
        public function actionIniciar(){
            $item_id = $_GET['id'];
            $bus = Articulo::model()->findByPk($item_id, 'ACTIVO = "S"');
            $res = array(
                     'DESCRIPCION'=>$bus->NOMBRE,                                         
                ); 
            echo CJSON::encode($res);
        }

        /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='articulo-ensamble-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
