<?php

class ExistenciaBodegasController extends Controller
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
        /*
        public function actionCargarAjax(){
            
              $bus = Bodega::model()->findByPk($_POST['ExistenciaBodegas']['BODEGA']);
              if($bus)
                   echo CHtml::tag('input',array('size'=>15,'disabled'=>true,'id'=>'BODEGA2','name'=>'BODEGA2','value'=>$bus->DESCRIPCION));  
               else
                  echo CHtml::tag('input',array('size'=>15,'disabled'=>true,'id'=>'BODEGA2','name'=>'BODEGA2','value'=>'Ninguno'));

        }
         * 
         */
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            $bodega = new Bodega;
            $linea = new PedidoLinea;
            $articulo = new Articulo;
            $modelLinea = PedidoLinea::model()->findAll('PEDIDO ="'.$model->PEDIDO.'"');
            $countLineas = PedidoLinea::model()->count('PEDIDO ="'.$model->PEDIDO.'"');
            $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
            $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';
            $i = 1;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
/*
		if(isset($_POST['Pedido']))
		{
			$model->attributes=$_POST['Pedido'];
                        if($_POST['eliminar'] != ''){
                            $eliminar = explode(",", $_POST['eliminar']);
                            foreach($eliminar as $elimina){                                
                                    $borra = PedidoLinea::model()->deleteByPk($elimina);                                
                            }
                        }
			if($model->save()){
				if(isset($_POST['PedidoLinea'])){
                                foreach ($_POST['PedidoLinea'] as $datos2){
                                    
                                    $salvar2 = PedidoLinea::model()->findByPk($datos2['ID']);
                                    $salvar2->PEDIDO = $model->PEDIDO;
                                    $salvar2->ARTICULO = $datos2['ARTICULO'];
                                    $salvar2->LINEA = $i;
                                    $salvar2->UNIDAD = $datos2['UNIDAD'];
                                    $salvar2->CANTIDAD = $datos2['CANTIDAD'];
                                    $salvar2->PRECIO_UNITARIO = $datos2['PRECIO_UNITARIO'];
                                    $salvar2->PORC_DESCUENTO = $datos2['PORC_DESCUENTO'];
                                    $salvar2->MONTO_DESCUENTO = $datos2['MONTO_DESCUENTO'];
                                    $salvar2->PORC_IMPUESTO = $datos2['PORC_IMPUESTO'];
                                    $salvar2->VALOR_IMPUESTO = $datos2['VALOR_IMPUESTO'];
                                    $salvar2->TIPO_PRECIO = $datos2['TIPO_PRECIO'];
                                    $salvar2->COMENTARIO = $datos2['COMENTARIO'];
                                    $salvar2->TOTAL = $datos2['TOTAL'];
                                    $salvar2->ESTADO = 'N';
                                    $salvar2->ACTIVO = 'S';
                                    $salvar2->save();
                                    $i++;
                                }
                            }
                            
                            if(isset($_POST['LineaNuevo'])){                                  
                                  foreach ($_POST['LineaNuevo'] as $datos){
                                        $salvar = new PedidoLinea;
                                        $salvar->PEDIDO = $model->PEDIDO;
                                        $salvar->ARTICULO = $datos['ARTICULO'];
                                        $salvar->LINEA = $i;
                                        $salvar->UNIDAD = $datos['UNIDAD'];
                                        $salvar->CANTIDAD = $datos['CANTIDAD'];
                                        $salvar->PRECIO_UNITARIO = $datos['PRECIO_UNITARIO'];
                                        $salvar->PORC_DESCUENTO = $datos['PORC_DESCUENTO'];
                                        $salvar->MONTO_DESCUENTO = $datos['MONTO_DESCUENTO'];
                                        $salvar->PORC_IMPUESTO = $datos['PORC_IMPUESTO'];
                                        $salvar->VALOR_IMPUESTO = $datos['VALOR_IMPUESTO'];
                                        $salvar->TIPO_PRECIO = $datos['TIPO_PRECIO'];
                                        $salvar->COMENTARIO = $datos['COMENTARIO'];
                                        $salvar->TOTAL = $datos['TOTAL'];
                                        $salvar->ESTADO = 'N';
                                        $salvar->ACTIVO = 'S';
                                        $salvar->save();
                                        $i++;
                                 }
                             }
                                $this->redirect(array('admin&men=S002'));
                        } else {
                            $this->redirect(array('admin&men=E002'));
                        }
		}
*/
		$this->render('update',array(
			'model'=>$model,
			'bodega'=>$bodega,
			'cliente'=>$cliente,
			'condicion'=>$condicion,
			'linea'=>$linea,
			'articulo'=>$articulo,
			'modelLinea'=>$modelLinea,
			'countLineas'=>$countLineas,
			'ruta'=>$ruta,
                        'ruta2'=>$ruta2,
		));
	}
        
        public function actionDetalle(){
            if($_POST['check'] != ''){
                $id = $_POST['check'];
                $consulta = ArticuloEnsamble::model()->findAll('ACTIVO = "S" AND ARTICULO_PADRE = "'.$id.'"');
                $padre = Articulo::model()->findByPk($id, 'ACTIVO = "S"');
                if(!$consulta){
                    echo '<div id="alert" class="alert alert-warning" data-dismiss="modal">
                            <h2 align="center">Este articulo no tiene componentes asociados</h2>
                            </div>';
                }
                else{
                    echo '
                        <h2>Detalle para el articulo: '.$padre->NOMBRE.'</h2>
                        <table align="center" class="table table-bordered" >
                        <tr>
                            <td><b>Articulo</b></td>
                            <td><b>Unidad</b></td>
                            <td><b>Cantidad</b></td>
                        </tr>';
                    foreach($consulta as $con){                    
                        echo '<tr><td>'.$con->aRTICULOHIJO->NOMBRE.'</td>';
                        echo '<td>'.$con->uNIDADALMACEN->NOMBRE.'</td>';
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

        
        public function actionCargaArticulo() {
            
            $item_id = $_GET['id'];
            $bus = Articulo::model()->findByPk($item_id, 'ACTIVO = "S"');           
            $res = array(
                     'DESCRIPCION'=>$bus->NOMBRE,
                     'UNIDAD' => $bus->UNIDAD_ALMACEN,
                     'UNIDAD_NOMBRE' => $bus->uNIDADALMACEN->NOMBRE,
                     'UNIDADES' => CHtml::listData(UnidadMedida::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>$bus->uNIDADALMACEN->TIPO)),'ID','NOMBRE'),
           
                     'ID'=>$bus->ARTICULO,                     
            );           
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
