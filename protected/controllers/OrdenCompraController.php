<?php

class OrdenCompraController extends SBaseController
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
				'actions'=>array('admin','delete','ActualizaImpuesto' , 'Cerrar', 'Reversar', 'Autorizar' ,'Cancelar', 'CargarProveedor', 'CargarLineas', 'CargarArticulo'),
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

        public function actionCargarProveedor() {
            
            $item_id = $_GET['buscar'];
            $bus = Proveedor::model()->findByPk($item_id);
            $res = array(
                'NOMBRE' => $bus->NOMBRE,
                'EMAIL' => $bus->EMAIL,
                'CONTACTO' => $bus->CONTACTO,
                'TELEFONO' => $bus->TELEFONO1,
                'ID' => $bus->PROVEEDOR,
                'DESCUENTO' => $bus->DESCUENTO,
            );
            
            echo CJSON::encode($res);
        }

        public function actionActualizaImpuesto(){
            $item_id = $_GET['buscar'];
            $bus = Articulo::model()->findByPk($item_id);
            if ($bus->IMPUESTO_COMPRA != NULL){
                $bus = Impuesto::model()->find('ID = "'.$bus->IMPUESTO_COMPRA.'"');
                $bus = array('PORCENTAJE'=>$bus->PROCENTAJE);
            }
            else{
                $bus = array('PORCENTAJE'=>'0.00');
            }
            echo CJSON::encode($bus);
        }
        
        public function actionCargarArticulo(){
            
            $item_id = $_GET['buscar'];
            $bus = Articulo::model()->findByPk($item_id);
            if($bus){
            $bus2 = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD_ALMACEN.'"');
            $bus3 = UnidadMedida::model()->findAll('TIPO = "'.$bus2->TIPO.'" ORDER BY NOMBRE asc');
            
            if ($bus->IMPUESTO_COMPRA == NULL){
                $bus4 = '0';
            }
            else{
                $bus4 = Impuesto::model()->find('ID = "'.$bus->IMPUESTO_COMPRA.'"');
                $bus4 = $bus4->PROCENTAJE;
            }
            $res = array(
                 'DESCRIPCION'=>$bus->NOMBRE,
                 'UNIDAD'=>$bus3,
                 'ID'=>$bus->ARTICULO,
                 'IMPUESTO'=>$bus4,
                 'ALMACEN'=>$bus->UNIDAD_ALMACEN,                  
            );
           
             $bus2= '';
             $bus3= '';
            
            }
            else{
                $res = array(
                 'DESCRIPCION'=>'Ninguno',
                 'UNIDAD'=>'',
                );
            }
             echo CJSON::encode($res);
            
            
        }
        
        public function actionCargarLineas (){
           $item_id = $_GET['seleccion'];
           $bus = SolicitudOcLinea::model()->findByPk($item_id);
           $bus2 = Articulo::model()->find('ARTICULO = "'.$bus->ARTICULO.'"');
           if($bus2->IMPUESTO_COMPRA != NULL){
               $bus2 = Impuesto::model()->find('ID = "'.$bus2->IMPUESTO_COMPRA.'"');
               $unidad = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD.'"');
               $res = array(
                   'ARTICULO' => $bus->ARTICULO,
                   'DESCRIPCION' => $bus->DESCRIPCION,
                   'UNIDAD' => $unidad,
                   'FECHA_REQUERIDA' => $bus->FECHA_REQUERIDA,
                   'CANTIDAD' => $bus->CANTIDAD,
                   'COMENTARIO' => $bus->COMENTARIO,
                   'SOLICITUD' => $bus->SOLICITUD_OC,
                   'IMPUESTO' => $bus2->PROCENTAJE,   
                   'ID' => $item_id,
                );
           }
           else{
               $unidad = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD.'"');
               $res = array(
                   'ARTICULO' => $bus->ARTICULO,
                   'DESCRIPCION' => $bus->DESCRIPCION,
                   'UNIDAD' => $unidad,
                   'FECHA_REQUERIDA' => $bus->FECHA_REQUERIDA,
                   'CANTIDAD' => $bus->CANTIDAD,
                   'COMENTARIO' => $bus->COMENTARIO,
                   'SOLICITUD' => $bus->SOLICITUD_OC,
                   'IMPUESTO' => '0',  
                   'ID' => $item_id,
                );
           }
           $unidad = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD.'"');
           echo CJSON::encode($res);
        }
        
        public function actionCancelar(){
            $id = explode(",", $_GET['buscar']);
            $error = 0;
            $exito = 0;
            $info = 0;
            
            foreach($id as $cancela){
                $cancelar = OrdenCompra::model()->findByPk($cancela);
                
                if($cancelar->ESTADO == 'C'){
                    $info++; // ya esta cancelada
                }
                else{
                    $cancelar->ESTADO = 'C';
                    $cancelar->USUARIO_CANCELA = Yii::app()->user->name;
                    $cancelar->FECHA_CANCELA = date("Y-m-d H:i:s");
                    if($cancelar->save()){
                        $exito++; // se cancelo correctamente
                    }
                    else{
                        $error++; // error al cancelar
                    }
                
            }}
            $variable = array('error'=>$error, 'info'=>$info, 'exito'=>$exito);
            echo CJSON::encode($variable);
        }
        
        public function actionAutorizar(){
            $id = explode(",", $_GET['buscar']);
            $error = 0;
            $exito = 0;
            $info = 0;
            $advertencia= 0;
            foreach($id as $autoriza){
                $autorizar = OrdenCompra::model()->findByPk($autoriza);
                if($autorizar->ESTADO == 'C' || $autorizar->ESTADO == 'E'){
                    $advertencia++; //esta en cancelar o cerrada
                }
                else{
                    if ($autorizar->ESTADO == 'N' || $autorizar->ESTADO == 'A'){
                        $info++; //ya esta en autorizar
                    }
                    else{
                        $autorizar->ESTADO = 'N';
                        //$autorizar->AUTORIZADA_POR = Yii::app()->user->name;
                        //$autorizar->FECHA_AUTORIZADA = date("Y-m-d H:i:s");
                        if($autorizar->save()){
                            $actLinea = OrdenCompraLinea::model()->findAll('ORDEN_COMPRA = "'.$autoriza.'"');
                            foreach ($actLinea as $datos){
                                $datos->ESTADO = 'N';
                                $datos->save();
                            }
                            $exito++; // Se autorizo correctamente
                        }
                        else{
                            $error++; // error no se pudo autorizar
                        }
                
                    }
                }            
                }
            $variable = array('error'=>$error, 'info'=>$info, 'exito'=>$exito, 'advertencia'=>$advertencia);
            echo CJSON::encode($variable);
        }
        
        public function actionReversar(){
            $id = explode(",", $_GET['buscar']);
            $error = 0;
            $exito = 0;
            $info = 0;
            $advertencia = 0;
            foreach($id as $reversa){
                $reversar = OrdenCompra::model()->findByPk($reversa);
                if($reversar->ESTADO == 'C' || $reversar->ESTADO == 'E'){
                    $advertencia++; //advertencia esta en cancelar
                }
                 else{
                     if ($reversar->ESTADO == 'A'){
                        $advertencia++; //advertencia ya esta en autorizar
                    }
                    else{
                        if($reversar->ESTADO == 'P'){
                            $info++; // esta aun en planeada
                        }
                        else{
                            $reversar->ESTADO = 'P';
                            //$reversar->AUTORIZADA_POR = "";
                            //$reversar->FECHA_AUTORIZADA = "";
                            if($reversar->save()){
                                $actLinea = OrdenCompraLinea::model()->findAll('ORDEN_COMPRA = "'.$reversa.'"');
                                foreach ($actLinea as $datos){
                                    $datos->ESTADO = 'P';
                                    $datos->save();
                                }
                            $exito++; // Se reverso correctamente
                            }
                            else{
                                $error++; // error 5 no se pudo reversar
                            }
                        }
                    }
                 }
            }
            $variable = array('error'=>$error, 'info'=>$info, 'exito'=>$exito, 'advertencia'=>$advertencia);
            echo CJSON::encode($variable);
        }
        
        public function actionCerrar(){
            $error = 0;
            $exito = 0;
            $info = 0;
            $id = explode(",", $_GET['buscar']);
            foreach($id as $cierra){
                $cerrar = OrdenCompra::model()->findByPk($cierra);
                if ($cerrar->ESTADO == 'E'){
                    $info++; // ya estaba en estado cerrado
                }
                else{
                    if ($cerrar->ESTADO == 'B' || $cerrar->ESTADO == 'R'){
                        $cerrar->ESTADO = 'E';
                        $cerrar->save();
                        $exito++; // se cerraron correctamente
                    }
                    else{
                        $error++; // no pudieron ser cerradas                    
                    }
                }
            }
            $variable = array('error'=>$error, 'info'=>$info, 'exito'=>$exito);
            echo CJSON::encode($variable);
        }
        
         /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
        
        public function actionCreate()
	{
		$model=new OrdenCompra;
                $proveedor = new Proveedor;
                $linea = new OrdenCompraLinea;                
                $solicitudLinea = new SolicitudOcLinea3;
                $articulo = new Articulo;
                $config = ConfCo::model()->find();
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                $i = 1;

		if(isset($_POST['OrdenCompra']))
		{
			$model->attributes=$_POST['OrdenCompra'];
			if($model->save())
                            if(isset($_POST['Nuevo'])){
                                foreach ($_POST['Nuevo'] as $datos){
                                    
                                    $salvar = new OrdenCompraLinea;
                                    $salvar->ORDEN_COMPRA = $_POST['OrdenCompra']['ORDEN_COMPRA'];
                                    $salvar->ARTICULO = $datos['ARTICULO'];
                                    $salvar->LINEA_NUM = $datos['LINEA_NUM'];
                                    $salvar->DESCRIPCION = $datos['DESCRIPCION'];
                                    $salvar->BODEGA = $datos['BODEGA'];
                                    $salvar->FECHA_REQUERIDA = $datos['FECHA_REQUERIDA'];
                                    $salvar->FACTURA = $datos['FACTURA'];
                                    $salvar->CANTIDAD_ORDENADA = $datos['CANTIDAD_ORDENADA'];
                                    $salvar->UNIDAD_COMPRA = $datos['UNIDAD_COMPRA'];
                                    $salvar->PRECIO_UNITARIO = $datos['PRECIO_UNITARIO'];
                                    $salvar->PORC_DESCUENTO = $datos['PORC_DESCUENTO'];
                                    $salvar->MONTO_DESCUENTO = $datos['MONTO_DESCUENTO'];
                                    $salvar->PORC_IMPUESTO = $datos['PORC_IMPUESTO'];
                                    $salvar->VALOR_IMPUESTO = $datos['VALOR_IMPUESTO'];
                                    $salvar->CANTIDAD_RECIBIDA = $datos['CANTIDAD_RECIBIDA'];
                                    $salvar->CANTIDAD_RECHAZADA = $datos['CANTIDAD_RECHAZADA'];
                                    $salvar->FECHA = $datos['FECHA'];
                                    $salvar->OBSERVACION = $datos['OBSERVACION'];
                                    $salvar->ESTADO = $datos['ESTADO'];
                                    $salvar->save();
                                    $config->ULT_ORDEN_COMPRA = $_POST['OrdenCompra']['ORDEN_COMPRA'];
                                    $config->save();
                                    
                                    if($datos['SOLICITUD'] != ''){
                                        $relacion = new SolicitudOrdenCo;
                                        $relacion->SOLICITUD_OC = $datos['SOLICITUD'];
                                        $relacion->SOLICITUD_OC_LINEA = $datos['ID_SOLICITUD_LINEA'];
                                        $relacion->ORDEN_COMPRA = $_POST['OrdenCompra']['ORDEN_COMPRA'];
                                        $relacion->ORDEN_COMPRA_LINEA = OrdenCompraLinea::model()->count();
                                        $relacion->DECIMA = $datos['CANTIDAD_ORDENADA'];
                                        $relacion->ACTIVO = 'S';
                                        $relacion->save();
                                        $solicitud = SolicitudOcLinea::model()->find('SOLICITUD_OC_LINEA = "'.$datos['ID_SOLICITUD_LINEA'].'"');
                                        $solicitud->SALDO = $datos['RESTA_CANT'] - $datos['CANTIDAD_ORDENADA'];
                                        $solicitud->save();
                                    }
                                       
                                }
                            }
				$this->redirect(array('admin'));
		}
                if(isset($_GET['Proveedor']))
			$proveedor->attributes=$_GET['Proveedor'];
                
		$this->render('create',array(
			'model'=>$model,
                        'config' => $config,
                        'proveedor' => $proveedor,
                        'linea' => $linea,
                        'solicitudLinea'=>$solicitudLinea,
                        'articulo' => $articulo,
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
                $linea = new OrdenCompraLinea;
                $linea2 = new OrdenCompraLinea2;
                $config = ConfCo::model()->find();
                $articulo = new Articulo;
                $proveedor = new Proveedor;
                $solicitudLinea = new SolicitudOcLinea3;
                $items = $linea->model()->findAll('ORDEN_COMPRA = "'.$id.'"');
                $i = 1;
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['OrdenCompra']))
		{
			$model->attributes=$_POST['OrdenCompra'];
                        if($_POST['eliminar'] != ''){
                            $eliminar = explode(",", $_POST['eliminar']);
                            foreach($eliminar as $elimina){
                                if($elimina != -1){
                                    $borra = OrdenCompraLinea::model()->deleteByPk($elimina);
                                }
                            }
                        }
			if($model->save()) 
                            if(isset($_POST['OrdenCompraLinea'])){
                                foreach ($_POST['OrdenCompraLinea'] as $datos2){
                                    
                                    $salvar2 = OrdenCompraLinea::model()->findByPk($datos2['ORDEN_COMPRA_LINEA']);
                                    $salvar2->ORDEN_COMPRA = $model->ORDEN_COMPRA;
                                    $salvar2->ARTICULO = $datos2['ARTICULO'];
                                    $salvar2->LINEA_NUM = $i;
                                    $salvar2->DESCRIPCION = $datos2['DESCRIPCION'];
                                    $salvar2->BODEGA = $datos2['BODEGA'];
                                    $salvar2->FECHA_REQUERIDA = $datos2['FECHA_REQUERIDA'];
                                    $salvar2->FACTURA = $datos2['FACTURA'];
                                    $salvar2->CANTIDAD_ORDENADA = $datos2['CANTIDAD_ORDENADA'];
                                    $salvar2->UNIDAD_COMPRA = $datos2['UNIDAD_COMPRA'];
                                    $salvar2->PRECIO_UNITARIO = $datos2['PRECIO_UNITARIO'];
                                    $salvar2->PORC_DESCUENTO = $datos2['PORC_DESCUENTO'];
                                    $salvar2->MONTO_DESCUENTO = $datos2['MONTO_DESCUENTO'];
                                    $salvar2->PORC_IMPUESTO = $datos2['PORC_IMPUESTO'];
                                    $salvar2->VALOR_IMPUESTO = $datos2['VALOR_IMPUESTO'];
                                    $salvar2->CANTIDAD_RECIBIDA = $datos2['CANTIDAD_RECIBIDA'];
                                    $salvar2->CANTIDAD_RECHAZADA = $datos2['CANTIDAD_RECHAZADA'];
                                    $salvar2->FECHA = $datos2['FECHA'];
                                    $salvar2->OBSERVACION = $datos2['OBSERVACION'];
                                    $salvar2->ESTADO = $datos2['ESTADO'];
                                    $salvar2->save();
                                    $i++;
                                    
                                    if($datos2['SOLICITUD'] != ''){
                                        $relacion = new SolicitudOrdenCo;
                                        $relacion->SOLICITUD_OC = $datos2['SOLICITUD'];
                                        $relacion->SOLICITUD_OC_LINEA = $datos2['ID_SOLICITUD_LINEA'];
                                        $relacion->ORDEN_COMPRA = $_POST['OrdenCompra']['ORDEN_COMPRA'];
                                        $relacion->ORDEN_COMPRA_LINEA = OrdenCompraLinea::model()->count();
                                        $relacion->DECIMA = $datos2['CANTIDAD_ORDENADA'];
                                        $relacion->ACTIVO = 'S';
                                        $relacion->save();
                                        $solicitud = SolicitudOcLinea::model()->find('SOLICITUD_OC_LINEA = "'.$datos2['ID_SOLICITUD_LINEA'].'"');
                                        $solicitud->SALDO = $datos2['RESTA_CANT'] - $datos2['CANTIDAD_ORDENADA'];
                                        $solicitud->save();
                                    }
                                       
                                }
                            }
                            
                            if(isset($_POST['Nuevo'])){
                                foreach ($_POST['Nuevo'] as $datos){
                                    
                                    $salvar = new OrdenCompraLinea;
                                    $salvar->ORDEN_COMPRA = $_POST['OrdenCompra']['ORDEN_COMPRA'];
                                    $salvar->ARTICULO = $datos['ARTICULO'];
                                    $salvar->LINEA_NUM = $i;
                                    $salvar->DESCRIPCION = $datos['DESCRIPCION'];
                                    $salvar->BODEGA = $datos['BODEGA'];
                                    $salvar->FECHA_REQUERIDA = $datos['FECHA_REQUERIDA'];
                                    $salvar->FACTURA = $datos['FACTURA'];
                                    $salvar->CANTIDAD_ORDENADA = $datos['CANTIDAD_ORDENADA'];
                                    $salvar->UNIDAD_COMPRA = $datos['UNIDAD_COMPRA'];
                                    $salvar->PRECIO_UNITARIO = $datos['PRECIO_UNITARIO'];
                                    $salvar->PORC_DESCUENTO = $datos['PORC_DESCUENTO'];
                                    $salvar->MONTO_DESCUENTO = $datos['MONTO_DESCUENTO'];
                                    $salvar->PORC_IMPUESTO = $datos['PORC_IMPUESTO'];
                                    $salvar->VALOR_IMPUESTO = $datos['VALOR_IMPUESTO'];
                                    $salvar->CANTIDAD_RECIBIDA = $datos['CANTIDAD_RECIBIDA'];
                                    $salvar->CANTIDAD_RECHAZADA = $datos['CANTIDAD_RECHAZADA'];
                                    $salvar->FECHA = $datos['FECHA'];
                                    $salvar->OBSERVACION = $datos['OBSERVACION'];
                                    $salvar->ESTADO = $datos['ESTADO'];
                                    $salvar->save();
                                    $i++;
                                }
                            }
                            
                            	$this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
                        'linea'=>$linea,
                        'linea2'=>$linea2,
                        'config'=>$config,
                        'articulo'=>$articulo,
                        'proveedor'=>$proveedor,
                        'solicitudLinea'=>$solicitudLinea,
                        'items'=>$items,
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
		$dataProvider=new CActiveDataProvider('OrdenCompra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new OrdenCompra('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['OrdenCompra']))
			$model->attributes=$_GET['OrdenCompra'];

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
		$model=OrdenCompra::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='orden-compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}