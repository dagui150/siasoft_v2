<?php

class PedidoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $pedido;

	/**
	 * @return array action filters
	 */
	public function filters(){
            return array(
                array('CrugeAccessControlFilter'),
            );
        }
        /**
         * Este metod hace las opertaciones necesarias para agregar una linea
         */
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
                            $this->widget('bootstrap.widgets.TbButton', array(
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
                $cliente = new Cliente('factura');
                $linea = new PedidoLinea;
                $articulo = new Articulo;
                $modelLinea = '';
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation(array($model,$cliente));
                if(isset($_POST['ajax']) && $_POST['ajax']==='pedido-linea-form')
		{
			echo CActiveForm::validate($linea);
			Yii::app()->end();
		}

		if(isset($_POST['Pedido']))
		{
			$model->attributes=$_POST['Pedido'];
                        $modelConsecutivo = ConsecutivoFa::model()->findByPk($model->CONSECUTIVO);
                        $model->PEDIDO = $modelConsecutivo->VALOR_CONSECUTIVO;
                        $model->REMITIDO = 'N';   
                        $model->RESERVADO = 'N';   
                        $model->ESTADO = 'N';
                        
                        $model->TOTAL_MERCADERIA=Controller::unformat($_POST['Pedido']['TOTAL_MERCADERIA']);
                        $model->MONTO_ANTICIPO=Controller::unformat($_POST['Pedido']['MONTO_ANTICIPO']);
                        $model->MONTO_FLETE=Controller::unformat($_POST['Pedido']['MONTO_FLETE']);
                        $model->MONTO_SEGURO=Controller::unformat($_POST['Pedido']['MONTO_SEGURO']);
                        $model->MONTO_DESCUENTO1=Controller::unformat($_POST['Pedido']['MONTO_DESCUENTO1']);
                        $model->TOTAL_IMPUESTO1=Controller::unformat($_POST['Pedido']['TOTAL_IMPUESTO1']);
                        $model->TOTAL_A_FACTURAR=Controller::unformat($_POST['Pedido']['TOTAL_A_FACTURAR']);
                        
			$cliente->attributes=$_POST['Cliente'];
                        $transaction = $model->dbConnection->beginTransaction();
                        try{
                            if($cliente->CLIENTE != '0'){
                                $cliente->PAIS = 'COL';
                                $cliente->save();
                            }
                            $model->save();
                            if(isset($_POST['LineaNuevo'])){
                                  $i = 1;
                                  foreach ($_POST['LineaNuevo'] as $datos){
                                        $salvar = new PedidoLinea;
                                        $salvar->PEDIDO = $model->PEDIDO;
                                        $salvar->ARTICULO = $datos['ARTICULO'];
                                        $salvar->LINEA = $i;
                                        $salvar->UNIDAD = $datos['UNIDAD'];
                                        $salvar->CANTIDAD = Controller::unformat($datos['CANTIDAD']);
                                        $salvar->PRECIO_UNITARIO = Controller::unformat($datos['PRECIO_UNITARIO']);
                                        $salvar->PORC_DESCUENTO = $datos['PORC_DESCUENTO'];
                                        $salvar->MONTO_DESCUENTO = Controller::unformat($datos['MONTO_DESCUENTO']);
                                        $salvar->PORC_IMPUESTO = $datos['PORC_IMPUESTO'];
                                        $salvar->VALOR_IMPUESTO = Controller::unformat($datos['VALOR_IMPUESTO']);
                                        $salvar->TIPO_PRECIO = $datos['TIPO_PRECIO'];
                                        $salvar->COMENTARIO = $datos['COMENTARIO'];
                                        $salvar->TOTAL = Controller::unformat($datos['TOTAL']);
                                        $salvar->ESTADO = 'N';
                                        $salvar->ACTIVO = 'S';
                                        $salvar->save();
                                        $i++;
                                 }
                             }
                             //ACTUALIZAR SIGUIENTE VALOR
                             $separados = ConsecutivoFa::extractNum($modelConsecutivo->VALOR_CONSECUTIVO);
                             $longitud = strlen($separados[1]);
                             $count = Pedido::model()->count('CONSECUTIVO = "'.$model->CONSECUTIVO.'"');
                             $modelConsecutivo->VALOR_CONSECUTIVO = $separados[0].str_pad(++$count, $longitud, "0", STR_PAD_LEFT);

                             $modelConsecutivo->update();
                             $transaction->commit();
                             $this->redirect(array('admin'));
                        }catch(Exception $e){
                            echo $e;
                            $transaction->rollback();
                            Yii::app()->end();
                        }		
                }

		$this->render('create',array(
			'model'=>$model,
                        'linea'=>$linea,
                        'cliente'=>$cliente,
                        'articulo'=>$articulo,
                        'ruta'=>$ruta,
                        'ruta2'=>$ruta2,
                        'modelLinea'=>$modelLinea = '',
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
            $bodega = new Bodega;
            $cliente = new Cliente;
            $condicion = new CodicionPago;
            $linea = new PedidoLinea;
            $articulo = new Articulo;
            $modelLinea = PedidoLinea::model()->findAll('PEDIDO ="'.$model->PEDIDO.'"');
            $countLineas = PedidoLinea::model()->count('PEDIDO ="'.$model->PEDIDO.'"');
            $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
            $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';
            $i = 1;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Pedido']))
		{
			$model->attributes=$_POST['Pedido'];                        
                        
                        $model->TOTAL_MERCADERIA=Controller::unformat($_POST['Pedido']['TOTAL_MERCADERIA']);
                        $model->MONTO_ANTICIPO=Controller::unformat($_POST['Pedido']['MONTO_ANTICIPO']);
                        $model->MONTO_FLETE=Controller::unformat($_POST['Pedido']['MONTO_FLETE']);
                        $model->MONTO_SEGURO=Controller::unformat($_POST['Pedido']['MONTO_SEGURO']);
                        $model->MONTO_DESCUENTO1=Controller::unformat($_POST['Pedido']['MONTO_DESCUENTO1']);
                        $model->TOTAL_IMPUESTO1=Controller::unformat($_POST['Pedido']['TOTAL_IMPUESTO1']);
                        $model->TOTAL_A_FACTURAR=Controller::unformat($_POST['Pedido']['TOTAL_A_FACTURAR']);
                        
                        
                        
			if($model->save()){
				if(isset($_POST['PedidoLinea'])){
                                    foreach ($_POST['PedidoLinea'] as $datos2){
                                        $salvar2 = PedidoLinea::model()->findByPk($datos2['ID']);
                                        $salvar2->PEDIDO = $model->PEDIDO;
                                        $salvar2->ARTICULO = $datos2['ARTICULO'];
                                        $salvar2->LINEA = $i;
                                        $salvar2->UNIDAD = $datos2['UNIDAD'];
                                    $salvar2->CANTIDAD = Controller::unformat($datos2['CANTIDAD']);
                                    $salvar2->PRECIO_UNITARIO = Controller::unformat($datos2['PRECIO_UNITARIO']);
                                        $salvar2->PORC_DESCUENTO = $datos2['PORC_DESCUENTO'];
                                    $salvar2->MONTO_DESCUENTO = Controller::unformat($datos2['MONTO_DESCUENTO']);
                                        $salvar2->PORC_IMPUESTO = $datos2['PORC_IMPUESTO'];
                                    $salvar2->VALOR_IMPUESTO = Controller::unformat($datos2['VALOR_IMPUESTO']);
                                        $salvar2->TIPO_PRECIO = $datos2['TIPO_PRECIO'];
                                        $salvar2->COMENTARIO = $datos2['COMENTARIO'];
                                    $salvar2->TOTAL = Controller::unformat($datos2['TOTAL']);
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
                                        $salvar->CANTIDAD = Controller::unformat($datos['CANTIDAD']);
                                        $salvar->PRECIO_UNITARIO = Controller::unformat($datos['PRECIO_UNITARIO']);
                                        $salvar->PORC_DESCUENTO = $datos['PORC_DESCUENTO'];
                                        $salvar->MONTO_DESCUENTO = Controller::unformat($datos['MONTO_DESCUENTO']);
                                        $salvar->PORC_IMPUESTO = $datos['PORC_IMPUESTO'];
                                        $salvar->VALOR_IMPUESTO = Controller::unformat($datos['VALOR_IMPUESTO']);
                                        $salvar->TIPO_PRECIO = $datos['TIPO_PRECIO'];
                                        $salvar->COMENTARIO = $datos['COMENTARIO'];
                                        $salvar->TOTAL = Controller::unformat($datos['TOTAL']);
                                        $salvar->ESTADO = 'N';
                                        $salvar->ACTIVO = 'S';
                                        $salvar->save();
                                        $i++;
                                 }
                             }
                             if($_POST['eliminar'] != ''){
                                $eliminar = explode(",", $_POST['eliminar']);
                                foreach($eliminar as $elimina){                                
                                        $borra = PedidoLinea::model()->deleteByPk($elimina);                                
                                }
                            }
                                $this->redirect(array('admin&men=S002'));
                        } else {
                            $this->redirect(array('admin&men=E002'));
                        }
		}

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
        
        
        //Inicio funciones que cargan info por JSON
         /**
          * Carga el cliente
          * Si el cliente existe retorna id y nombre
          * @param string $item_id id del cliente
          * @return CJSON respuesta
          */     
        protected function CargarCliente($item_id){            
            $bus = Cliente::model()->findByPk($item_id);
            $res = array(
                'EXISTE' => $bus ? true : false,
                'ID' => $bus ? $bus->CLIENTE : '',
                'NOMBRE' => $bus ?  $bus->NOMBRE : '',
            );
            
            echo CJSON::encode($res);
        }
        /**
         * Carga ciertos atributos de un articulo
         * @param string $item_id id del articulo
         * @return CJSON respuesta
         */
        protected function CargarArticulo($item_id){            
            $bus = Articulo::model()->findByPk($item_id, 'ACTIVO = "S"');
            $cant_valida ='';
            $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ACTIVO'=>'S','ARTICULO'=>$bus->ARTICULO,'BODEGA'=>isset($_GET['bodega']) ? $_GET['bodega'] :''));
            
            if($existenciaBodega && isset($_GET['cantidad'])){
                $cantidad = $this->darCantidad($existenciaBodega, $_GET['cantidad'],$_GET['unidad']);
                if($_GET['cantidad'] > $this->unformat($existenciaBodega->CANT_DISPONIBLE))
                    $cant_valida = 'N';
                else
                    $cant_valida = 'S';
            }
            $res = array(
                'EXISTE'=>$existenciaBodega ? 'S' : 'N',
                'CANT_VALIDA'=>$cant_valida,
                'ID' => $bus->ARTICULO,
                'NOMBRE' => $bus->NOMBRE,
                'IMPUESTO' => number_format($bus->iMPUESTOVENTA->PROCENTAJE, 2, ',', '.'),
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
        
        public function actionformatoPDF() 
        {

            $id = $_GET['id'];
            
            $this->pedido = Pedido::model()->findByPk($id);
            $lineas = new PedidoLinea;
            $this->layout =ConfFa::model()->find()->fORMATOPEDIDO->pLANTILLA->RUTA;
            $compania = Compania::model()->find();
            if ($compania->LOGO != '') {
                $logo = CHtml::image(Yii::app()->request->baseUrl . "/logo/" . $compania->LOGO, 'Logo');
            } else {
                $logo = CHtml::image(Yii::app()->request->baseUrl . "/logo/default.jpg", 'Logo');
            }
            $header = '<table width="100%" align="center">
                            <tr>
                                <td width="26%" rowspan="4" align="left" valign="middle">'.$logo.'
                                </td>
                                <td width="41%" align="center">'.$compania->NOMBRE_ABREV.'</td>
                                <td width="33%" rowspan="2" align="right" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center"><b>Nit:</b> '.$compania->NIT.'</td>
                            </tr>
                            <tr>
                                <td align="center">Direccion  '.$compania->DIRECCION.'</td>

                                <td align="right" valign="middle"><strong>Pedido Número:</strong></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Tels:</b> '.$compania->TELEFONO1.'-'.$compania->TELEFONO2.'</td>
                                <td width="33%" align="right" valign="middle">'.$id.'</td>
                            </tr>
                        </table>';
            $footer = '<table width="100%">
                    <tr><td align="center" valign="middle"><span class="piePagina"><b>Generado por:</b> ' . Yii::app()->user->name . '</span></td>
                        <td align="center" valign="middle"><span class="piePagina"><b>Generado el:</b> ' . date('Y/m/d') . '</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" valign="middle">Desarrollado por Tramasoft Soluciones TIC - <a href="http://www.tramasoft.com">www.tramasoft.com</a></td>
                    </tr>
                    </table>';
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4',0,'','15','15','30','15','5','', 'P');
            $mPDF1->w=210;   //manually set width
            $mPDF1->h=148.5; //manually set height
            $mPDF1->SetHTMLHeader($header);
            $mPDF1->SetHTMLFooter($footer);
            $mPDF1->WriteHTML($this->render('pdf', array('model' => $this->pedido,'model2'=>$lineas), true));

            $mPDF1->Output();
            Yii::app()->end();
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
                $bus = ArticuloPrecio::model()->findByPk($_GET['tipo']);
                $res = array(
                    'NOMBRE'=>$bus->nIVELPRECIO->DESCRIPCION,
                    'PRECIO'=>$bus->PRECIO,
                );
                echo CJSON::encode($res);
            }
        }
}
