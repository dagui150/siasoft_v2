<?php

class PedidoController extends Controller
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
        
        public function actionAgregarlinea(){
            $linea = new PedidoLinea;
            $linea->attributes = $_POST['PedidoLinea'];
            $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
            
            if($linea->validate()){
                     echo '<div id="alert" class="alert alert-success" data-dismiss="modal">
                            <h2 align="center">Operacion Satisfactoria</h2>
                            </div>
                     <span id="form-cargado" style="display:none">';
                          $this->renderPartial('form_lineas', 
                            array(
                                'linea'=>$linea,
                                'ruta'=>$ruta,
                                'Pactualiza'=>isset($_POST['ACTUALIZA']) ? $_POST['ACTUALIZA'] : 0,
                            )
                        );
                     echo '</span>
                         
                         <div id="boton-cargado" class="modal-footer">';
                            $this->widget('bootstrap.widgets.BootButton', array(
                                 'buttonType'=>'button',
                                 'type'=>'normal',
                                 'label'=>'Aceptar',
                                 'icon'=>'ok',
                                 'htmlOptions'=>array('id'=>'nuevo','onclick'=>'agregar("'.$_POST['SPAN'].'")')
                              ));
                     echo '</div>';
                     Yii::app()->end();
                    }else{
                    $this->renderPartial('form_lineas', 
                        array(
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    );
                    Yii::app()->end();
                }
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
		$model=new Pedido;
                $bodega = new Bodega;
                $cliente = new Cliente;
                $condicion = new CodicionPago;
                $linea = new PedidoLinea;
                $articulo = new Articulo;
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Pedido']))
		{
			$model->attributes=$_POST['Pedido'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->PEDIDO));
		}

		$this->render('create',array(
			'model'=>$model,
                        'bodega'=>$bodega,
                        'condicion'=>$condicion,
                        'linea'=>$linea,
                        'cliente'=>$cliente,
                        'articulo'=>$articulo,
                        'ruta'=>$ruta,
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

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Pedido']))
		{
			$model->attributes=$_POST['Pedido'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->PEDIDO));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
        
        public function actionDirigir(){
            switch($_GET['FU']){
                case 'CL':
                    $this->CargarCliente($_GET['ID']);
                break;
                case 'AR':
                    $this->CargarArticulo($_GET['ID']);
                break;
                case 'BO':
                    $this->CargarBodega($_GET['ID']);
                break;
                case 'CO':
                    $this->CargarCondicion($_GET['ID']);
                break;
            }
        }
        
        
        //Inicio funciones que cargan info por JSON
              
        protected function CargarCliente($item_id){            
            $bus = Cliente::model()->findByPk($item_id);
            $res = array(
                'ID' => $bus->CLIENTE,
                'NOMBRE' => $bus->NOMBRE,
            );
            
            echo CJSON::encode($res);
        }
        
        protected function CargarArticulo($item_id){            
            $bus = Articulo::model()->findByPk($item_id);
            $res = array(
                'ID' => $bus->ARTICULO,
                'NOMBRE' => $bus->NOMBRE,
                'IMPUESTO' => $bus->iMPUESTOVENTA->PROCENTAJE,
                'UNIDAD' => $bus->UNIDAD_ALMACEN,
                'UNIDAD_NOMBRE' => $bus->uNIDADALMACEN->NOMBRE,
                'UNIDADES' => CHtml::listData(UnidadMedida::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>$bus->uNIDADALMACEN->TIPO)),'ID','NOMBRE'),
            );            
            echo CJSON::encode($res);
        }
        
        
        //Fin funciones que cargan info por JSON
        
        
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
		$dataProvider=new CActiveDataProvider('Pedido');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Pedido('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pedido']))
			$model->attributes=$_GET['Pedido'];

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
		$model=Pedido::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pedido-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionCargarTipoPrecio(){
            if(isset($_GET['art'])){
                $bus = ArticuloPrecio::model()->findByAttributes(array('ARTICULO'=>$_GET['art'],'NIVEL_PRECIO'=>$_GET['tipo']));
                $res = array(
                    'NOMBRE'=>$bus->nIVELPRECIO->DESCRIPCION,
                    'PRECIO'=>$bus->PRECIO,
                    'SELECCION'=>$bus->ID,
                    'COMBO'=>CHtml::ListData(ArticuloPrecio::model()->with()->findAll('ARTICULO = "'.$_GET['art'].'" AND ACTIVO = "S"'),'ID','nIVELPRECIO.DESCRIPCION')
                );
                echo CJSON::encode($res);            
            } 
            elseif(isset($_GET['tipo'])){
                $bus = NivelPrecio::model()->findByPk($_GET['tipo']);
                $res = array(
                    'NOMBRE'=>$bus->DESCRIPCION
                );
                echo CJSON::encode($res);
            }
        }
        
        public function actionCargarUnidad($id){
            $bus = UnidadMedida::model()->findByPk($id);
            $res = array(
                'NOMBRE'=>$bus->NOMBRE
            );
            echo CJSON::encode($res);            
        }
}
