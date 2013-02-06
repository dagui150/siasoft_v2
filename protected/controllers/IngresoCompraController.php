<?php

class IngresoCompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        public $modulo='Compras';
        public $submodulo='Ingreso de Compra';
	public $layout='//layouts/column2';
        public $ingreso;

	/**
	 * @return array action filters
	 */
	public function filters(){
            return array(
                                      array('CrugeAccessControlFilter'),
                              );
          }
        
        public function actionCargarLineas (){
            $item_id = $_GET['seleccion'];
            $bus = OrdenCompraLinea::model()->findByPk($item_id);
            $bus2 = Articulo::model()->find('ARTICULO = "'.$bus->ARTICULO.'"');
            $unidad = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD_COMPRA.'"');
            $bodega = Bodega::model()->find('ID = "'.$bus->BODEGA.'"');
            $ordenada = Controller::unformat($bus->CANTIDAD_ORDENADA) - Controller::unformat($bus->CANTIDAD_RECIBIDA);
            
            
            $res = array(
                   'ARTICULO' => $bus->ARTICULO,
                   'DESCRIPCION' => $bus2->NOMBRE,
                   'UNIDAD_ORDENADA' => $unidad->ID,
                   'UNIDAD_ORDENADA_NOMBRE' => $unidad->NOMBRE,
                   'BODEGA' => $bus->BODEGA,
                   'BODEGA_NOMBRE' => $bodega->DESCRIPCION,
                   'CANTIDAD_ORDENADA' => $ordenada,
                   'PRECIO_UNITARIO' => $bus->PRECIO_UNITARIO,
                   'CANTIDAD_REAL' => $bus->CANTIDAD_ORDENADA,
                   'COSTO_FISCAL_UNITARIO' => Articulo::darCosto($bus->ARTICULO),
                   'ID' => $item_id,
            );
            echo CJSON::encode($res);
        }
               
        public function actionActlinea(){
            $linea = new IngresoCompraLinea;
            $linea->attributes = $_POST['IngresoCompraLinea'];
            $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
            
            if($linea->validate()){
                     echo '<div id="alert" class="alert alert-success" data-dismiss="modal">
                            <h2 align="center">Operacion Satisfactoria</h2>
                            </div>
                     <span id="form-cargado" style="display:none">';
                          $this->renderPartial('_form_lineas', 
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
                    $this->renderPartial('_form_lineas', 
                        array(
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    );
                    Yii::app()->end();
                }
        }

        public function actionCargarProveedor(){
            
            $item_id = $_GET['buscar'];
            $bus = Proveedor::model()->findByPk($item_id);
            $res = array(
                'NOMBRE' => $bus->NOMBRE,
                'ID' => $bus->PROVEEDOR,
            );
            
            echo CJSON::encode($res);
        }
        
        public function actionCargarArticulo(){
            
            $item_id = $_GET['buscar'];
            $bus = Articulo::model()->findByPk($item_id);
            if($bus){
                $bus2 = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD_ALMACEN.'"');
                $bus3 = UnidadMedida::model()->findAll('TIPO = "'.$bus2->TIPO.'"');

                $res = array(
                     'DESCRIPCION'=>$bus->NOMBRE,
                     'UNIDAD'=>$bus3,
                     'ID'=>$bus->ARTICULO,

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
        
        public function actionformatoPDF() {

            $id = $_GET['id'];
            
            $this->ingreso = IngresoCompra::model()->findByPk($id);
            $lineas = new IngresoCompraLinea;
            $this->layout = ConfCo::model()->find()->fORMATOINGRESO->pLANTILLA->RUTA;
            
            $footer = '<table width="100%">
                    <tr><td align="center" valign="middle"><span class="piePagina"><b>Generado por:</b> ' . Yii::app()->user->name . '</span></td>
                        <td align="center" valign="middle"><span class="piePagina"><b>Generado el:</b> ' . date('Y/m/d') . '</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" valign="middle">Desarrollado por Tramasoft Soluciones TIC - <a href="http://www.tramasoft.com">www.tramasoft.com</a></td>
                    </tr>
                    </table>';
            
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

                                <td align="right" valign="middle"><strong>Número:</strong></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Tels:</b> '.$compania->TELEFONO1.'-'.$compania->TELEFONO2.'</td>
                                <td width="33%" align="right" valign="middle">'.$id.'</td>
                            </tr>
                        </table>';
            //'',array(377,279),0,'',15,15,16,16,9,9, 'P'
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4',0,'','15','15','30','','5','', 'P');
            //$mPDF1->w=210;   //manually set width
            //$mPDF1->h=148.5; //manually set height
            $mPDF1->SetHTMLHeader($header);
            $mPDF1->SetHTMLFooter($footer);
            $mPDF1->WriteHTML($this->render('pdf', array('model' => $this->ingreso,'model2'=>$lineas), true));
            $mPDF1->SetHTMLFooter($footer);

            $mPDF1->Output();
            Yii::app()->end();
        }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
                $dataProviderOrdenes=new CActiveDataProvider(OrdenCompraLinea::model(), array(
                    'keyAttribute'=>'ORDEN_COMPRA_LINEA',
                    'criteria'=>array(
                        'select'=>'o.PROVEEDOR, t.ORDEN_COMPRA_LINEA, t.ARTICULO, t.FECHA_REQUERIDA',
                        'join'=>'inner join orden_compra o ON t.ORDEN_COMPRA = o.ORDEN_COMPRA',
                        'condition'=>'o.PROVEEDOR=-1',
                    ),
                ));
		$model = new IngresoCompra;
                $articulo = new Articulo;
                $proveedor = new Proveedor;
                $linea = new IngresoCompraLinea;
                $ordenLinea = new OrdenCompraLinea;
                $config = ConfCo::model()->find();
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                $i = 1;
                
                if(Yii::app()->request->isAjaxRequest){
                    if(isset($_GET[0])){
                        $busqueda = $_GET[0];
                        $dataProviderOrdenes->criteria = array(
                            'select'=>'o.PROVEEDOR, t.ORDEN_COMPRA_LINEA, t.ARTICULO, t.FECHA_REQUERIDA',
                            'join'=>'inner join orden_compra o ON t.ORDEN_COMPRA = o.ORDEN_COMPRA',
                            'condition'=>'o.PROVEEDOR="'.$busqueda.'" AND t.ESTADO = "A" OR t.ESTADO = "B"',
                        );
                        // para responderle al request ajax debes hacer un ECHO con el JSON del dataprovider
                        echo CJSON::encode($dataProviderOrdenes);
                    }
                }
                
                /* creacion del dataProvider
                */
                $dataProvider=new CActiveDataProvider(Proveedor::model(), array(
                    'keyAttribute'=>'PROVEEDOR',// IMPORTANTE, para que el CGridView conozca la seleccion
                    'criteria'=>array(
                        //'condition'=>'cualquier condicion where de tu sql iria aqui',
                    ),
                ));
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
                if(isset($_GET['OrdenCompraLinea']))
			$ordenLinea->attributes=$_GET['OrdenCompraLinea'];
                
                
		if(isset($_GET['Proveedor']))
			$proveedor->attributes=$_GET['Proveedor'];

                if(isset($_POST['ajax']) && $_POST['ajax']==='ingreso-compra-linea-form')
		{
			echo CActiveForm::validate($linea);
			Yii::app()->end();
		}

		if(isset($_POST['IngresoCompra']))
		{
			$model->attributes=$_POST['IngresoCompra'];
                        $_POST['IngresoCompra']['TIENE_FACTURA'] == 1 ? $model->TIENE_FACTURA = 'S' : $model->TIENE_FACTURA = 'N';
			if($model->save()){
                            if(isset($_POST['LineaNuevo'])){
                                foreach ($_POST['LineaNuevo'] as $datos){
                                    $salvar = new IngresoCompraLinea;
                                    $salvar->INGRESO_COMPRA = $_POST['IngresoCompra']['INGRESO_COMPRA'];
                                    $salvar->LINEA_NUM = $i;
                                    $salvar->ORDEN_COMPRA_LINEA = $datos['ORDEN_COMPRA_LINEA'];
                                    $salvar->ARTICULO = $datos['ARTICULO'];
                                    $salvar->BODEGA = $datos['BODEGA'];
                                    $salvar->CANTIDAD_ORDENADA = $datos['CANTIDAD_ORDENADA'];
                                    $salvar->UNIDAD_ORDENADA = $datos['UNIDAD_ORDENADA'];
                                    $salvar->CANTIDAD_ACEPTADA = $datos['CANTIDAD_ACEPTADA'];
                                    $salvar->CANTIDAD_RECHAZADA = $datos['CANTIDAD_RECHAZADA'];
                                    $recibida = OrdenCompraLinea::model()->findByPk($datos['ORDEN_COMPRA_LINEA']);
                                    $recibir = $recibida->CANTIDAD_RECIBIDA + $datos['CANTIDAD_ACEPTADA'];
                                    $rechaza = $recibida->CANTIDAD_RECHAZADA + $datos['CANTIDAD_RECHAZADA'];
                                    OrdenCompraLinea::model()->updateByPk($datos['ORDEN_COMPRA_LINEA'], array('CANTIDAD_RECIBIDA' => $recibir, 'CANTIDAD_RECHAZADA' => $rechaza));
                                    $salvar->PRECIO_UNITARIO = $datos['PRECIO_UNITARIO'];
                                    $salvar->COSTO_FISCAL_UNITARIO = $datos['COSTO_FISCAL_UNITARIO'];
                                    $salvar->ACTIVO = 'S';
                                    $salvar->save();                                    
                                    $config->ULT_EMBARQUE = $_POST['IngresoCompra']['INGRESO_COMPRA'];
                                    $config->save();                                    
                                    $i++;
                                }
                            }
				//$this->redirect(array('admin'));
                                $this->redirect(array('admin&men=S003'));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
                        'ruta'=>$ruta,
                        'proveedor'=>$proveedor,
                        'config' => $config,
                        'linea' => $linea,
                        'articulo' => $articulo,
                        'ordenLinea' => $ordenLinea,
                        'dataProviderOrdenes' => $dataProviderOrdenes,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new IngresoCompra('search');
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
		$model->unsetAttributes();  // clear any default values
                
		if(isset($_GET['IngresoCompra']))
			$model->attributes=$_GET['IngresoCompra'];
                

		$this->render('admin',array(
			'model'=>$model,
                        'ruta'=>$ruta,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=IngresoCompra::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='ingreso-compra-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAplicar(){
            
            $check = explode(',',$_GET['pasar']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            foreach($check as $id){                
                $ingreso = IngresoCompra::model()->findByPk($id);                
                
                switch ($ingreso->ESTADO){
                    case 'P' :
                        $transaction=$ingreso->dbConnection->beginTransaction();
                        try{
                            $lineas = IngresoCompraLinea::model()->findAll('INGRESO_COMPRA = "'.$ingreso->INGRESO_COMPRA.'"');
                            $this->transacciones($lineas, $ingreso);                        
                            $ingreso->ESTADO = 'R';
                            $ingreso->APLICADO_POR = Yii::app()->user->name;
                            $ingreso->APLICADO_EL = date("Y-m-d H:i:s");                        
                            $ingreso->save();

                            foreach($lineas as $datos){
                                $articulo = Articulo::model()->findByPk($datos->ARTICULO);
                                $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$datos->ARTICULO,'BODEGA'=>$datos->BODEGA));

                                if($existenciaBodega){
                                        /*$existenciaBodega->CANT_DISPONIBLE = $existenciaBodega->CANT_DISPONIBLE + $datos->CANTIDAD_ACEPTADA;                                        
                                        $existenciaBodega->save(); //- La cantidad aceptada para el articulo exede a la maxima permitida;     */ 
                                        $valor = $existenciaBodega->CANT_DISPONIBLE + $datos->CANTIDAD_ACEPTADA;
                                        ExistenciaBodega::model()->updateByPk($existenciaBodega->ID, array('CANT_DISPONIBLE'=>$valor));
                                }else{                                
                                    $existenciaBodega = new ExistenciaBodega;
                                    $existenciaBodega->ARTICULO = $datos->ARTICULO;
                                    $existenciaBodega->BODEGA = $datos->BODEGA;
                                    $existenciaBodega->EXISTENCIA_MINIMA = 0;
                                    $existenciaBodega->EXISTENCIA_MAXIMA = 0;
                                    $existenciaBodega->PUNTO_REORDEN = 0;
                                    $existenciaBodega->CANT_RESERVADA = 0;
                                    $existenciaBodega->CANT_REMITIDA = 0;
                                    $existenciaBodega->CANT_CUARENTENA = 0;
                                    $existenciaBodega->CANT_VENCIDA = 0;
                                    $existenciaBodega->ACTIVO = 'S';
                                    $existenciaBodega->CANT_DISPONIBLE = $datos->CANTIDAD_ACEPTADA;
                                    $existenciaBodega->CREADO_POR = Yii::app()->user->name;
                                    $existenciaBodega->CREADO_EL = date("Y-m-d H:i:s");
                                    $existenciaBodega->ACTUALIZADO_POR = Yii::app()->user->name;
                                    $existenciaBodega->ACTUALIZADO_EL = date("Y-m-d H:i:s");
                                    $existenciaBodega->insert(); // - El articulo no pertenece a esta bodega
                                }
                            }
                            $transaction->commit();
                        }catch(Exception $e){
                            $contError+=1;
                            $error.= $id.',';
                            $transaction->rollBack();
                        }
                        break;
                    case 'R' :
                        $contWarning+=1;
                        $warning.= $id.',';
                        break;
                    case 'C' :
                        $contError+=1;
                        $error.= $id.',';
                        break;
                }
            }            
            echo '<div id="alert" class="alert alert-success" data-dismiss="modal">
                            <h2 align="center">Operacion Satisfactoria</h2>
                            </div>
                                 <span id="form-cargado" style="display:none">';     
                                    $this->renderPartial('_aplicar');
                                 echo '</span>                      
                         <div id="boton-cargado" class="modal-footer">';
                            $this->widget('bootstrap.widgets.TbButton', array(
                                 'buttonType'=>'button',
                                 'type'=>'normal',
                                 'label'=>'Aceptar',
                                 'icon'=>'ok',
                                 'htmlOptions'=>array('id'=>'nuevo','onclick'=>'reescribir();')
                              ));
                     echo '</div>';                     
                     Yii::app()->end();
        }
        
        public function transacciones($lineas, $ingreso){
            
            //Transaccion Inv
            $transaccion = new TransaccionInv;            
            $transaccion->CONSECUTIVO_CO = $ingreso->INGRESO_COMPRA;
            $transaccion->MODULO_ORIGEN = 'CO';
            $transaccion->REFERENCIA = 'Ingreso de compra';
            $transaccion->ACTIVO = 'S';
            $transaccion->save();
            
            foreach($lineas as $datos){  
                //Transaccion Inv Detalle
                $detalle = new TransaccionInvDetalle;
                $detalle->TRANSACCION_INV = $transaccion->TRANSACCION_INV;
                $detalle->LINEA = $datos->LINEA_NUM;
                $detalle->ARTICULO = $datos->ARTICULO;
                $detalle->UNIDAD = $datos->UNIDAD_ORDENADA;
                $detalle->BODEGA = $datos->BODEGA;
                $detalle->NATURALEZA = 'E';
                $detalle->CANTIDAD = $datos->CANTIDAD_ACEPTADA;
                $detalle->COSTO_UNITARIO = $datos->COSTO_FISCAL_UNITARIO;
                $detalle->PRECIO_UNITARIO = $datos->PRECIO_UNITARIO;
                $detalle->ACTIVO = 'S';
                $detalle->TIPO_TRANSACCION_CANTIDAD = 'D';
                $detalle->save();
                Articulo::model()->actualizarCosto($datos->ARTICULO);
                
                //Backorder - recibido
                $back = OrdenCompraLinea::model()->findByPk($datos->ORDEN_COMPRA_LINEA);
                if($back->CANTIDAD_RECIBIDA == $back->CANTIDAD_ORDENADA){
                    $back->ESTADO = 'R';
                    $back->save();
                    OrdenCompraLinea::model()->cambiaRecibir($datos->ORDEN_COMPRA_LINEA);
                }
                else{
                    $back->ESTADO = 'B';
                    $back->save();
                    OrdenCompra::model()->updateByPk($back->ORDEN_COMPRA, array('ESTADO'=>'B'));                    
                }
                
            }
        }
        
        public function actionListar(){
            
            $check = explode(',',$_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
                        
            foreach($check as $id){
                $ingreso = IngresoCompra::model()->findByPk($id);
                
                switch ($ingreso->ESTADO){
                    case 'P' :
                        //$documento->ESTADO = 'A';
                        $this->modificarExistencias($ingreso);
                        $contSucces+=1;
                        $succes .= $id.',';
                        break;
                    
                    case 'R' :
                        $contWarning+=1;
                        $warning.= $id.',';
                        break;
                    
                    case 'C' :
                        $contError+=1;
                        $error.= $id.',';
                        break;
                }
            }
            $mensajeSucces = MensajeSistema::model()->findByPk('S002');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h4 align="center">'.$mensajeSucces->MENSAJE.': <br>'.$contSucces.' Ingreso(s)<br>('.$succes.')</h4>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h4 align="center">'.$mensajeError->MENSAJE.': <br>'.$contError.' Ingreso(s) no Aplicados<br>('.$error.')</h4>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h4 align="center">'.$mensajeWarning->MENSAJE.': <br>'.$contWarning.' Ingreso(s) ya Aplicados<br>('.$warning.')</h4>');
            
            $this->widget('bootstrap.widgets.TbAlert'); 
        }
        
        protected function modificarExistencias($documento){
            
            $lineas = IngresoCompraLinea::model()->findAll('INGRESO_COMPRA = "'.$documento->INGRESO_COMPRA.'"');            
            foreach($lineas as $datos){                
                $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$datos->ARTICULO,'BODEGA'=>$datos->BODEGA));               
                if($existenciaBodega){                                        
                    if($datos->CANTIDAD_ACEPTADA > $existenciaBodega->EXISTENCIA_MAXIMA){
                        echo " - La cantidad aceptada para el articulo <b>".Articulo::darNombre($datos->ARTICULO)."</b> exede a la maxima permitida => Agregar<br /><br />";                        
                    }
                }else{
                    echo ' - El articulo <b>'.Articulo::darNombre($datos->ARTICULO).'</b> no pertenece a esta bodega => añadirlo<br /><br />';
                }
            }
        }
        
        public function actionCancelar(){
            
            $documentos = explode(',',$_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($documentos as $id){
                 $documento = IngresoCompra::model()->findByPk($id);
                 
                 if($documento->ESTADO == 'C'){
                      $contError+=1;
                      $error.= $id.',';
                 }elseif($documento->ESTADO == 'P'){
                     $documento->ESTADO = 'C';
                     $documento->CANCELADO_POR = Yii::app()->user->name;
                     $documento->CANCELADO_EL = date("Y-m-d H:i:s");
                     $contSucces+=1;
                     $succes .= $id.',';
                 }elseif($documento->ESTADO == 'R'){
                     $contWarning+=1;
                     $warning.= $id.',';
                 }                    
                 $documento->save();
            }
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');            
            
           if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Documento(s) Cancelados<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Documento(s) no Cancelados<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Documento(s) ya Cancelados<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.TbAlert');
            
        }
}