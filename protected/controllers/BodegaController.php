<?php

class BodegaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $modulo='Sistema';
        public $submodulo='Bodegas';
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
                $mensajeSucces = MensajeSistema::model()->findByPk('S001');
                $mensajeError = MensajeSistema::model()->findByPk('E001');
		$model2=new Bodega;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['Bodega']))
		{
			$model2->attributes=$_POST['Bodega'];
			if($model2->save()){
                            //$mensaje = "sdfhnsdkjfhjds1111";
                            //$this->render('admin', array('alerta'=>$mensaje));
			    //$this->redirect(array('admin'));
                            $this->redirect(array('admin&men=S003'));
                        }else{
                            //$mensaje = "sdfjhsdjkfhsd22222";
                            //$this->render('admin', array('alerta'=>$mensaje));
                            //$this->redirect(array('admin'));
                            $this->redirect(array('admin&men=E003'));
                        }
		}

		$this->render('create',array(
			'model2'=>$model2,
		));
                }	
                
                
             public function actionPrueba() {
                $model = new Bodega('search');
                $model->unsetAttributes();  // clear any default values
                $model2 = new Bodega;
                $mensaje = "sdfjhsdjkfhsd22222";
                $this->render('admin', array(
                    'alerta' => $mensaje, 
                    'model' => $model,
                    'model2' => $model2,
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

		if(isset($_POST['Bodega']))
		{
			$model2->attributes=$_POST['Bodega'];
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
        
        
        public function actionArticulos($id)
	{
            $model=$this->loadModel($id);
            $bodega = new Bodega;
            //$linea = new PedidoLinea;
            $linea = new ExistenciaBodegas;
            $articulo = new Articulo;
            //$modelLinea = PedidoLinea::model()->findAll('PEDIDO ="'.$model->PEDIDO.'"');
            $modelLinea = ExistenciaBodegas::model()->findAll('BODEGA ="'.$id.'"');
            //$countLineas = PedidoLinea::model()->count('PEDIDO ="'.$model->PEDIDO.'"');
            $countLineas = ExistenciaBodegas::model()->count('BODEGA ="'.$id.'"');
            $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
            $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';
            $i = 1;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Pedido']))
		{
			$model->attributes=$_POST['Pedido'];
                        if($_POST['eliminar'] != ''){
                            $eliminar = explode(",", $_POST['eliminar']);
                            foreach($eliminar as $elimina){                                
                                    $borra = PedidoLinea::model()->deleteByPk($elimina);                                
                            }
                        }
			if($model->save()){/*
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
                            $this->redirect(array('admin&men=E002'));*/
                        }
		}

		$this->render('articulos',array(
			'model'=>$model,
			'bodega'=>$bodega,
			'linea'=>$linea,
			'articulo'=>$articulo,
			'modelLinea'=>$modelLinea,
			'countLineas'=>$countLineas,
			'ruta'=>$ruta,
                        'ruta2'=>$ruta2,
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
            }
        }
        
        protected function CargarArticulo($item_id){            
            $bus = Articulo::model()->findByPk($item_id, 'ACTIVO = "S"');
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
		$dataProvider=new CActiveDataProvider('Bodega');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
              public function actionExcel()
	{
                $model = new Bodega('search');
                $model->unsetAttributes();
                $this->render('excel',array(
			'model' => $model,
		));
	}
        
        
        public function actionformatoPDF(){
            $id = $_GET['id'];
            $conf = ConfAs::model()->find();
            
            $model =  Bodega::model()->findByPk($id);  
            
            $this->layout = $conf->fORMATOIMPRESION->RUTA;
            
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $mPDF1->WriteHTML($this->render('pdf2', array( 'model'=>$model), true));
            
            //$this->render('pdf2', array( 'model'=>$model));
            
            $mPDF1->Output();
            Yii::app()->end();
        }
        
        
        
         public function actionPdf(){
            
            $dataProvider=new Bodega;
		$this->render('pdf',array(
			'dataProvider'=>$dataProvider,
		));
            
            
        }

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Bodega('search');
		$model->unsetAttributes();  // clear any default values
		$model2=new Bodega;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model2);

		if(isset($_POST['Bodega']))
		{
			$model2->attributes=$_POST['Bodega'];
			if($model2->save()){
                               // $mensaje = MensajeSistema::mensaje('S001');
                                //$tipo = "success";
				//$this->redirect(array('admin', 'mensaje'=>$mensaje, 'tipo'=>$tipo));
                            $this->redirect(array('admin&men=S003'));
                        }
                        else{
                            //$mensaje = MensajeSistema::mensaje('E001');
                            //$tipo = "error";
                            //$this->render('admin', array('mensaje'=>$mensaje, 'tipo'=>$tipo));
                            $this->redirect(array('admin&men=E003'));
                        }
		}
		if(isset($_GET['Bodega']))
			$model->attributes=$_GET['Bodega'];

		$this->render('admin',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
        
        // Inventario
        public function actionInventario()
	{
		$model=new Bodega('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Bodega']))
			$model->attributes=$_GET['Bodega'];

		$this->render('inventario',array(
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
		$model=Bodega::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='bodega-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionCargarbodega(){
            $item_id = (int)$_GET['id'];
            $bus = Bodega::model()->findByPk($item_id);

            $res = array(
                 'ID'=>$bus->ID,
                 'DESCRIPCION'=>$bus->DESCRIPCION,
            );

            echo CJSON::encode($res);
        }
               
        
}
