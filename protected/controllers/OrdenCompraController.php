<?php

class OrdenCompraController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $orden;
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
        
        public function actionPdf(){
            $id = $_GET['id'];
            $conf = ConfCo::model()->find();
            $compania = Compania::model()->find();
            $orden = OrdenCompra::model()->findByPk($id);
            $lineas = OrdenCompraLinea::model()->findAll('ORDEN_COMPRA = "'.$id.'"');
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $mPDF1->WriteHTML($this->renderPartial('pdf', array('orden' => $orden, 'lineas' => $lineas, 'compania' => $compania, 'conf'=>$conf), true));
            $mPDF1->Output();
            Yii::app()->end();
        }
        
        public function actionformatoPDF() {

            $id = $_GET['id'];
            $this->orden = OrdenCompra::model()->findByPk($id);
            $lineas = new OrdenCompraLinea;
            $this->layout = ConfCo::model()->find()->fORMATOORDEN->pLANTILLA->RUTA;
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
            $mPDF1->WriteHTML($this->render('pdf', array('model' => $this->orden, 'model2' => $lineas), true));
            $mPDF1->SetHTMLFooter($footer);

            $mPDF1->Output();
            Yii::app()->end();
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
            $bus = Articulo::model()->findByPk($item_id,  'ACTIVO = "S"');
            $res = array(
                 'DESCRIPCION'=>$bus->NOMBRE,
                 'UNIDAD' => $bus->UNIDAD_ALMACEN,
                 'UNIDAD_NOMBRE' => $bus->uNIDADALMACEN->NOMBRE,
                 'UNIDADES' => CHtml::listData(UnidadMedida::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>$bus->uNIDADALMACEN->TIPO)),'ID','NOMBRE'),
                 'ID'=>$bus->ARTICULO,
                );
             echo CJSON::encode($res);
        }
        
        public function actionCargarLineas (){
           $item_id = $_GET['seleccion'];
           $bus = SolicitudOcLinea::model()->findByPk($item_id);
           $bus2 = Articulo::model()->find('ARTICULO = "'.$bus->ARTICULO.'"');
           if($bus2->IMPUESTO_COMPRA != NULL){
               $bus2 = Impuesto::model()->find('ID = "'.$bus2->IMPUESTO_COMPRA.'"');
               $unidad = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD.'"');
               $cantidad = $bus->CANTIDAD - $bus->SALDO;
               $res = array(
                   'ARTICULO' => $bus->ARTICULO,
                   'DESCRIPCION' => $bus->DESCRIPCION,
                   'UNIDAD' => $unidad,
                   'FECHA_REQUERIDA' => $bus->FECHA_REQUERIDA,
                   'CANTIDAD' => $cantidad,
                   'COMENTARIO' => $bus->COMENTARIO,
                   'SOLICITUD' => $bus->SOLICITUD_OC,
                   'IMPUESTO' => $bus2->PROCENTAJE,   
                   'ID' => $item_id,
                );
           }
           else{
               $unidad = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD.'"');
               $cantidad = $bus->CANTIDAD - $bus->SALDO;
               $res = array(
                   'ARTICULO' => $bus->ARTICULO,
                   'DESCRIPCION' => $bus->DESCRIPCION,
                   'UNIDAD' => $unidad,
                   'FECHA_REQUERIDA' => $bus->FECHA_REQUERIDA,
                   'CANTIDAD' => $cantidad,
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
            
            $id = explode(",", $_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($id as $cancela){
                 $cancelar = OrdenCompra::model()->findByPk($cancela);
                 
                 switch ($cancelar->ESTADO){
                     case 'C' :
                        $contError+=1;
                        $error.= $cancela.',';
                        break;
                    
                     case 'E' :
                        $contError+=1;
                        $error.= $cancela.',';
                        break;
                 
                     case 'P' :
                        $cancelar->ESTADO = 'C';
                        $cancelar->USUARIO_CANCELA = Yii::app()->user->name;
                        $cancelar->FECHA_CANCELA = date("Y-m-d H:i:s");
                        if($cancelar->save()){
                            $actLinea = OrdenCompraLinea::model()->findAll('ORDEN_COMPRA = "'.$cancela.'"');
                            foreach ($actLinea as $datos){
                                $datos->ESTADO = 'C';
                                $datos->save();
                            }
                        }
                        $contSucces+=1;
                        $succes .= $cancela.',';
                        break;
                
                    case 'B' :
                        $contWarning+=1;
                        $warning.= $cancela.',';
                        break;
                    
                    case 'R' :
                        $contWarning+=1;
                        $warning.= $cancela.',';
                        break;
                    
                    case 'A' :
                        $contWarning+=1;
                        $warning.= $cancela.',';
                        break;
                 }
                 
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            }
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Orden(es) Cancelada(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Orden(es) no Cancelada(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Orden(es) ya Cancelada(s) o Cerrada(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.TbAlert');        
            
        }
        
        public function actionAutorizar(){
            
            $id = explode(",", $_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($id as $autoriza){
                 $autorizar = OrdenCompra::model()->findByPk($autoriza);
                 
                 switch ($autorizar->ESTADO){
                     case 'C' :
                        $contError+=1;
                        $error.= $autoriza.',';
                        break;
                    
                     case 'E' :
                        $contError+=1;
                        $error.= $autoriza.',';
                        break;
                 
                     case 'P' :                      
                        $autorizar->ESTADO = 'A';
                        $autorizar->AUTORIZADA_POR = Yii::app()->user->name;
                        $autorizar->FECHA_AUTORIZADA = date("Y-m-d H:i:s");
                        if($autorizar->save()){
                            $actLinea = OrdenCompraLinea::model()->findAll('ORDEN_COMPRA = "'.$autoriza.'"');
                            foreach ($actLinea as $datos){
                                $datos->ESTADO = 'A';
                                $datos->save();
                            }
                        }
                        $contSucces+=1;
                        $succes .= $autoriza.',';
                        break;
                
                    case 'B' :
                        $contWarning+=1;
                        $warning.= $autoriza.',';
                        break;
                    
                    case 'R' :
                        $contWarning+=1;
                        $warning.= $autoriza.',';
                        break;
                    
                    case 'A' :
                        $contWarning+=1;
                        $warning.= $autoriza.',';
                        break;
                 }
                 
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            }
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Orden(es) Autorizada(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Orden(es) no Autorizada(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Orden(es) ya Autorizada(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.TbAlert');
        }
        
        public function actionReversar(){
            
            $id = explode(",", $_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($id as $reversa){
                $reversar = OrdenCompra::model()->findByPk($reversa);
                 
                 switch ($reversar->ESTADO){
                     case 'C' :
                        $contError+=1;
                        $error.= $autoriza.',';
                        break;
                    
                     case 'E' :
                        $contError+=1;
                        $error.= $autoriza.',';
                        break;
                 
                     case 'A' :
                         $contar = OrdenCompraLinea::model()->countByAttributes(array('ORDEN_COMPRA' => $reversa), 'ESTADO <> "A"');   
                         if($contar == 0){
                            $reversar->ESTADO = 'P';
                            $reversar->AUTORIZADA_POR = "";
                            $reversar->FECHA_AUTORIZADA = "";
                            if($reversar->save()){
                                $actLinea = OrdenCompraLinea::model()->findAll('ORDEN_COMPRA = "'.$reversa.'"');
                                foreach ($actLinea as $datos){
                                    $datos->ESTADO = 'P';
                                    $datos->save();
                                }
                            }
                            else{
                                $contError+=1;
                                $error.= $reversa.',';
                                break;
                            }
                            $contSucces+=1;
                            $succes .= $reversa.',';
                        }
                        else{
                            $contError+=1;
                            $error.= $reversa.',';
                        }
                        break;
                
                    case 'P' :
                        $contWarning+=1;
                        $warning.= $reversar.',';
                        break;
                    
                    case 'B' :
                        $contWarning+=1;
                        $warning.= $reversar.',';
                        break;
                    
                    case 'R' :
                        $contWarning+=1;
                        $warning.= $reversar.',';
                        break;
                 }
                 
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            }
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Orden(es) Reversada(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Orden(es) no Reversada(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Orden(es) ya Reversada(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.TbAlert');            
        }
        
        public function actionCerrar(){
            
            $id = explode(",", $_POST['check']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($id as $cierra){
                 $cerrar = OrdenCompra::model()->findByPk($cierra);
                 
                 switch ($cerrar->ESTADO){
                     case 'C' :
                        $contError+=1;
                        $error.= $cierra.',';
                        break;
                    
                     case 'E' :
                        $contError+=1;
                        $error.= $cierra.',';
                        break;
                 
                     case 'R' :
                        $cerrar->ESTADO = 'E';
                        $cerrar->USUARIO_CIERRA = Yii::app()->user->name;
                        $cerrar->FECHA_CIERRA = date("Y-m-d H:i:s");
                        $cerrar->save();
                        $contSucces+=1;
                        $succes .= $cierra.',';
                        break;
                
                    case 'B' :
                        $contWarning+=1;
                        $warning.= $cierra.',';
                        break;
                    
                    case 'P' :
                        $contWarning+=1;
                        $warning.= $cierra.',';
                        break;
                    
                    case 'A' :
                        $contWarning+=1;
                        $warning.= $cierra.',';
                        break;
                 }
                 
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            }
            if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Orden(es) Cerrada(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Orden(es) no Cerrada(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Orden(es) pendientes de proceso antes de ser cerrada(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.TbAlert');   
           
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
                $solicitudLinea = new SolicitudOcLinea;
                $articulo = new Articulo;
                $config = ConfCo::model()->find();
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                $i = 1;
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';

		if(isset($_POST['OrdenCompra']))
		{
			$model->attributes=$_POST['OrdenCompra'];
			if($model->save()){
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
                                    $salvar->CANTIDAD_ORDENADA = Controller::unformat($datos['CANTIDAD_ORDENADA']);
                                    $salvar->UNIDAD_COMPRA = $datos['UNIDAD_COMPRA'];
                                    $salvar->PRECIO_UNITARIO = Controller::unformat($datos['PRECIO_UNITARIO']);
                                    $salvar->PORC_DESCUENTO = $datos['PORC_DESCUENTO'];
                                    $salvar->MONTO_DESCUENTO = Controller::unformat($datos['MONTO_DESCUENTO']);
                                    $salvar->PORC_IMPUESTO = $datos['PORC_IMPUESTO'];
                                    $salvar->VALOR_IMPUESTO = Controller::unformat($datos['VALOR_IMPUESTO']);
                                    $salvar->CANTIDAD_RECIBIDA = Controller::unformat($datos['CANTIDAD_RECIBIDA']);
                                    $salvar->CANTIDAD_RECHAZADA = Controller::unformat($datos['CANTIDAD_RECHAZADA']);
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
                                        if($solicitud->SALDO == 0){                                            
                                            $solicitud->ESTADO = 'A';
                                        }
                                        $solicitud->save();
                                        SolicitudOcLinea::model()->cambiaAsignar($datos['SOLICITUD']);
                                    }                                       
                                }
                            }
				//$this->redirect(array('admin'));
                                $this->redirect(array('admin&men=S003'));
                        }
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
                        'ruta' => $ruta,
                        'ruta2' => $ruta2,
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
			if($model->save()) {
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
                                    $salvar2->CANTIDAD_ORDENADA = Controller::unformat($datos2['CANTIDAD_ORDENADA']);
                                    $salvar2->UNIDAD_COMPRA = $datos2['UNIDAD_COMPRA'];
                                    $salvar2->PRECIO_UNITARIO = Controller::unformat($datos2['PRECIO_UNITARIO']);
                                    $salvar2->PORC_DESCUENTO = $datos2['PORC_DESCUENTO'];
                                    $salvar2->MONTO_DESCUENTO = Controller::unformat($datos2['MONTO_DESCUENTO']);
                                    $salvar2->PORC_IMPUESTO = $datos2['PORC_IMPUESTO'];
                                    $salvar2->VALOR_IMPUESTO = Controller::unformat($datos2['VALOR_IMPUESTO']);
                                    $salvar2->CANTIDAD_RECIBIDA = Controller::unformat($datos2['CANTIDAD_RECIBIDA']);
                                    $salvar2->CANTIDAD_RECHAZADA = Controller::unformat($datos2['CANTIDAD_RECHAZADA']);
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
                            	//$this->redirect(array('admin'));
                                $this->redirect(array('admin&men=S002'));
                        }
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