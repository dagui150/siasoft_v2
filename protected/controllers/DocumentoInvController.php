<?php

class DocumentoInvController extends SBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
        public $modulo='Invetario';
        public $submodulo='Documentos Inventario';
	public $layout='//layouts/column2';
        public $breadcrumbs=array();
	public $menu=array();
        public $doc;

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
		$model=new DocumentoInv;
                $modelLi = new DocumentoInvLinea;
                $bodega = new Bodega;
                $articulo = new Articulo;
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
                if(isset($_POST['ajax']) && $_POST['ajax']==='documento-inv-linea-form')
		{
			echo CActiveForm::validate($modelLi);
			Yii::app()->end();
                }
                
		if(isset($_POST['DocumentoInv']))
		{
                        $model->attributes=$_POST['DocumentoInv'];
                        
                         //ACTUALIZAR CONSECUTIVO
                            $modelConsecutivo = ConsecutivoCi::model()->findByPk($model->CONSECUTIVO);
                            $consecutivo = substr($modelConsecutivo->MASCARA,0,4);
                            $mascara = strlen($modelConsecutivo->MASCARA);
                            $longitud = $mascara - 4;
                            $count = DocumentoInv::model()->count('CONSECUTIVO = "'.$model->CONSECUTIVO.'"');
                            $consecutivo .= str_pad(++$count, $longitud, "0", STR_PAD_LEFT);
                            
                            $model->DOCUMENTO_INV = $consecutivo;
                        
			if($model->save()){
                            //AGREGAR LINEAS
                            $cont = 0;
                            if(isset($_POST['LineaNuevo'])){
                                foreach ($_POST['LineaNuevo'] as $datos){
                                     $lineas = new DocumentoInvLinea;
                                     $lineas->DOCUMENTO_INV = $model->DOCUMENTO_INV;
                                     $lineas->LINEA_NUM = ++$cont;
                                     $lineas->TIPO_TRANSACCION = $datos['TIPO_TRANSACCION'];
                                     $lineas->SUBTIPO = $datos['SUBTIPO'];
                                     $lineas->TIPO_TRANSACCION_CANTIDAD = $datos['TIPO_TRANSACCION_CANTIDAD'] != '' ? $datos['TIPO_TRANSACCION_CANTIDAD'] : NULL;
                                     $lineas->BODEGA = $datos['BODEGA'];
                                     $lineas->BODEGA_DESTINO = $datos['BODEGA_DESTINO'] != '' ? $datos['BODEGA_DESTINO'] : NULL;
                                     $lineas->ARTICULO = $datos['ARTICULO'];
                                     $lineas->CANTIDAD = $datos['CANTIDAD'];
                                     $lineas->UNIDAD = $datos['UNIDAD'];
                                     $lineas->COSTO_UNITARIO = $datos['COSTO_UNITARIO'];
                                     $lineas->ACTIVO = 'S';
                                     $lineas->save();
                                }
                            }
                            
                            $modelConsecutivo->SIGUIENTE_VALOR = substr($modelConsecutivo->MASCARA,0,4).str_pad(++$count, $longitud, "0", STR_PAD_LEFT);
                            
                            $modelConsecutivo->save();
                            
                            $this->redirect(array('admin'));
                        }
			
		}
                if(isset($_GET['Bodega']))
			$bodega->attributes=$_GET['Bodega'];
                
                if(isset($_GET['Articulo']))
			$articulo->attributes=$_GET['Articulo'];
                $model->ESTADO = 'P';
                $this->render('create',array(
			'model'=>$model,
			'modelLi'=>$modelLi,
                        'bodega'=>$bodega,
                        'articulo'=>$articulo,
                        'ruta'=>$ruta,
			
                 ));
	}
        
        public function actionCargarconsecutivo($id){
            
            $bus =ConsecutivoCi::model()->findByPk($id);
            $res=array(
                'SIGUIENTE_VALOR'=>$bus->SIGUIENTE_VALOR,
                'TIPO_TRANSACCION'=>CHtml::listData(ConsecCiTipoTrans::model()->with('tIPOTRANSACCION')->findAllByAttributes(array('CONSECUTIVO_CI'=>$id,'ACTIVO'=>'S')),'tIPOTRANSACCION.TIPO_TRANSACCION','tIPOTRANSACCION.NOMBRE'),
            );
            
           echo CJSON::encode($res);
        }
        
        //TODAS LAS OPERACIONES QUE SE HAGAN CON LAS LINEAS
        public function actionAgregarlinea(){
            
            if(isset($_POST['restaurarCombos'])){
                $res=array(
                    'SUBTIPOS'=>SubtipoTransaccion::darSubtipos(),
                    'CANTIDADES'=>TipoCantidadArticulo::darCantidades(),
                );
                echo CJSON::encode($res);
            }
            
            if(isset($_POST['DocumentoInvLinea']))
                 $this->validarLineas($_POST['DocumentoInvLinea']);          
           
           if(isset($_GET['tipo']))
                $this->cargarSubtipo($_GET['tipo']);
           
           if(isset($_GET['tipo_transaccion']))
               $this->cargarCantidades($_GET['tipo_transaccion']);
           
               
           if(isset($_GET['idBodega']))
                $this->cargarBodega($_GET['idBodega']);
           
           if(isset($_GET['idArticulo']))
                $this->cargarArticulo($_GET['idArticulo']);
            
        }
        //CARGAR LAS CANTIDADES A AFECTAR SEGUN TRANSACCION BASE
        protected function cargarCantidades($id_transaccion){
            
            $transacciones= CHtml::listData(TipoTransaccionCantidad::model()->with('cANTIDAD')->findAll('TIPO_TRANSACCION = "'.$id_transaccion.'"'),'CANTIDAD','cANTIDAD.NOMBRE');
            $transaccion = TipoTransaccion::model()->findByPk($id_transaccion);
            $res = array(
                'TRANSACCIONES'=>$transacciones ? $transacciones : array(),
                'NATURALEZA'=>$transaccion->NATURALEZA
            );
            
            echo CJSON::encode($res);
            Yii::app()->end();
        }

        //CARGAR COMBO DEPENDIENTE DE LOS SUBTIPOS DE TRANSACCION
        protected function cargarSubtipo($id){
            
            $data = SubtipoTransaccion::model()->findAllByAttributes(array('TIPO_TRANSACCION'=>$id));
                
           $data=CHtml::listData($data,'ID','NOMBRE') ;
                
           echo CJSON::encode($data);
            
            
        }
        
        //CARGAR EL NOMBRE DE LA BODEGA 
        protected function cargarBodega($idBodega){
            $bus = Bodega::model()->findByPk($idBodega);
            $res = array(
                'NOMBRE'=>isset($bus->DESCRIPCION) ? $bus->DESCRIPCION :'Ninguno'
            );
            
            echo CJSON::encode($res);
            Yii::app()->end();
            
        }
        
        //CARGAR EL NOMBRE DEL ARTICULO
        protected function cargarArticulo($idArticulo){
            $bus = Articulo::model()->findByPk($idArticulo);
            $res = array(
                'NOMBRE'=>isset($bus->NOMBRE) ? $bus->NOMBRE :'Ninguno',
                'COSTO'=>'',
                'UNIDAD'=>$bus->UNIDAD_ALMACEN
            );
            
            if($bus->COSTO_FISCAL == 'Estándar')
                $res['COSTO'] = $bus->COSTO_ESTANDAR;
            
            if($bus->COSTO_FISCAL == 'Promedio')
                $res['COSTO'] = $bus->COSTO_PROMEDIO;
            
            if($bus->COSTO_FISCAL == 'Último')
                $res['COSTO'] = $bus->COSTO_ULTIMO;
            
            echo CJSON::encode($res);
            Yii::app()->end();
        }
        
        //VALIDAR EL FORMULARIO DE LAS LINEAS DE LA MODAL
        protected function validarLineas($post){
            
            $busDocumentos = DocumentoInv::model()->findByPk($_POST['documento']);
            $model = $busDocumentos ? $busDocumentos : new DocumentoInv;
            $modelLi = new DocumentoInvLinea;
            $bodega = new Bodega;
            $articulo = new Articulo;
            $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
            $tipo_transaccion = CHtml::listData(ConsecCiTipoTrans::model()->with('tIPOTRANSACCION')->findAll('CONSECUTIVO_CI = "'.$_POST['consecutivo'].'"'),'tIPOTRANSACCION.TIPO_TRANSACCION','tIPOTRANSACCION.NOMBRE');
            $modelLi->attributes=$post;
            
            if(isset($_POST['DocumentoInvLinea']['TIPO_TRANSACCION']) && $_POST['DocumentoInvLinea']['TIPO_TRANSACCION'] != '')
                  $subtipos = CHtml::listData(SubtipoTransaccion::model()->findAll('TIPO_TRANSACCION = "'.$_POST['DocumentoInvLinea']['TIPO_TRANSACCION'].'"'),'ID','NOMBRE');

           if(isset($_POST['DocumentoInvLinea']['TIPO_TRANSACCION_CANTIDAD']) && $_POST['DocumentoInvLinea']['TIPO_TRANSACCION_CANTIDAD'] != ''){
                        
                 $tipo = TipoTransaccion::model()->findByPk($_POST['DocumentoInvLinea']['TIPO_TRANSACCION']);
                      
                 $cantidades = TipoTransaccionCantidad::model()->with('cANTIDAD')->findAll('TIPO_TRANSACCION = "'.$tipo->TRANSACCION_BASE.'"');
                        
                 $cantidades = $cantidades != array() ? CHtml::listData($cantidades,'CANTIDAD','cANTIDAD.NOMBRE') : TipoCantidadArticulo::darCombo();
                                                    
           }
            if($_POST['DocumentoInvLinea']['SIGNO'] != '' && $modelLi->CANTIDAD > 0){
                $modelLi->CANTIDAD = -$modelLi->CANTIDAD;
            }
            if($modelLi->validate()){
                     echo '<div id="alert" class="alert alert-success" data-dismiss="modal">
                            <h2 align="center">Operacion Satisfactoria</h2>
                            </div>
                     <span id="form-cargado" style="display:none">';
                          $this->renderPartial('_form_lineas', 
                            array(
                                'model'=>$model,
                                'modelLi'=>$modelLi,
                                'bodega'=>$bodega,
                                'articulo'=>$articulo,
                                'ruta'=>$ruta,
                                'Pnombre_bodega'=>isset($_POST['NOMBRE_BODEGA']) ? $_POST['NOMBRE_BODEGA'] : '',
                                'Pnombre_bodega_destino'=>isset($_POST['NOMBRE_BODEGA_DESTINO']) ? $_POST['NOMBRE_BODEGA_DESTINO'] : '',
                                'Pnombre_articulo'=>isset($_POST['NOMBRE_ARTICULO']) ? $_POST['NOMBRE_ARTICULO'] : '',
                                'Psubtipos'=>isset($subtipos) ? $subtipos : array(),
                                'Vsubtipo'=>isset($_POST['DocumentoInvLinea']['SUBTIPO']) ? $_POST['DocumentoInvLinea']['SUBTIPO'] : 'Ninguno',
                                'Pcantidades'=>isset($cantidades) ? $cantidades : array(),
                                'Vcantidad'=>isset($_POST['DocumentoInvLinea']['TIPO_TRANSACCION_CANTIDAD']) ? $_POST['DocumentoInvLinea']['TIPO_TRANSACCION_CANTIDAD'] : 'Ninguno',
                                'PcampoActualiza'=>isset($_POST['CAMPO_ACTUALIZA']) ? $_POST['CAMPO_ACTUALIZA'] : '',
                                'Pactualiza'=>isset($_POST['ACTUALIZA']) ? $_POST['ACTUALIZA'] : 0,
                                'tipo_transaccion'=>$tipo_transaccion
                                
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
                    $this->renderPartial('_form_lineas', 
                        array(
                            'model'=>$model,
                            'modelLi'=>$modelLi,
                            'bodega'=>$bodega,
                            'articulo'=>$articulo,
                            'ruta'=>$ruta,
                            'Pnombre_bodega'=>isset($_POST['NOMBRE_BODEGA']) ? $_POST['NOMBRE_BODEGA'] : '',
                            'Pnombre_bodega_destino'=>isset($_POST['NOMBRE_BODEGA_DESTINO']) ? $_POST['NOMBRE_BODEGA_DESTINO'] : '',
                            'Pnombre_articulo'=>isset($_POST['NOMBRE_ARTICULO']) ? $_POST['NOMBRE_ARTICULO'] : '',
                            'Psubtipos'=>isset($subtipos) ? $subtipos : array(),
                            'Vsubtipo'=>isset($_POST['DocumentoInvLinea']['SUBTIPO']) ? $_POST['DocumentoInvLinea']['SUBTIPO'] : 'Ninguno',
                            'Pcantidades'=>isset($cantidades) ? $cantidades : array(),
                            'Vcantidad'=>isset($_POST['DocumentoInvLinea']['TIPO_TRANSACCION_CANTIDAD']) ? $_POST['DocumentoInvLinea']['TIPO_TRANSACCION_CANTIDAD'] : 'Ninguno',
                            'PcampoActualiza'=>isset($_POST['CAMPO_ACTUALIZA']) ? $_POST['CAMPO_ACTUALIZA'] : '',
                            'PActualiza'=>isset($_POST['ACTUALIZA']) ? $_POST['ACTUALIZA'] : 0,
                            'tipo_transaccion'=>$tipo_transaccion
                        )
                    );
                    Yii::app()->end();
                }
            
        }
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
                $modelLi = new DocumentoInvLinea;
                $modelLinea = DocumentoInvLinea::model()->findAll('DOCUMENTO_INV ="'.$model->DOCUMENTO_INV.'"');
                $countLineas = DocumentoInvLinea::model()->count('DOCUMENTO_INV ="'.$model->DOCUMENTO_INV.'"');
                $bodega = new Bodega;
                $articulo = new Articulo;
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
                if(isset($_POST['ajax']) && $_POST['ajax']==='documento-inv-linea-form')
		{
			echo CActiveForm::validate($modelLi);
			Yii::app()->end();
                }
                
		if(isset($_POST['DocumentoInv']))
		{
			$model->attributes=$_POST['DocumentoInv'];
			if($model->save()){
                            //ELIMINAR REGISTROS
                             if(isset($_POST['eliminar'])){
                                $arEliminar = explode(',',$_POST['eliminar']);
                                foreach($arEliminar as $elimina){
                                    $borrar = DocumentoInvLinea::model()->deleteByPk($elimina);
                                }
                                
                             }
                             $cont = 0;
                            //ACTUALIZAR LINEAS DE DOCUMENTO
                            if(isset($_POST['DocumentoInvLinea'])){
                                foreach ($_POST['DocumentoInvLinea'] as $datos){
                                     $lineas = DocumentoInvLinea::model()->findByPk($datos['DOCUMENTO_INV_LINEA']);
                                     $lineas->LINEA_NUM = ++$cont;
                                     $lineas->TIPO_TRANSACCION = $datos['TIPO_TRANSACCION'];
                                     $lineas->SUBTIPO = $datos['SUBTIPO'];
                                     $lineas->TIPO_TRANSACCION_CANTIDAD = $datos['TIPO_TRANSACCION_CANTIDAD'] != '' ? $datos['TIPO_TRANSACCION_CANTIDAD'] : NULL;
                                     $lineas->BODEGA = $datos['BODEGA'];
                                     $lineas->BODEGA_DESTINO = $datos['BODEGA_DESTINO'] != '' ? $datos['BODEGA_DESTINO'] : NULL;
                                     $lineas->ARTICULO = $datos['ARTICULO'];
                                     $lineas->CANTIDAD = $datos['CANTIDAD'];
                                     $lineas->UNIDAD = $datos['UNIDAD'];
                                     $lineas->COSTO_UNITARIO = $datos['COSTO_UNITARIO'];
                                     $lineas->ACTIVO = 'S';
                                     $lineas->save();
                                }
                            }
                            
                            //NUEVAS LINEAS DE DOCUMENTO
                            if(isset($_POST['LineaNuevo'])){
                                foreach ($_POST['LineaNuevo'] as $datos){
                                     $lineas = new DocumentoInvLinea;
                                     $lineas->DOCUMENTO_INV = $model->DOCUMENTO_INV;
                                     $lineas->LINEA_NUM = ++$cont;
                                     $lineas->TIPO_TRANSACCION = $datos['TIPO_TRANSACCION'];
                                     $lineas->SUBTIPO = $datos['SUBTIPO'];
                                     $lineas->TIPO_TRANSACCION_CANTIDAD = $datos['TIPO_TRANSACCION_CANTIDAD'] != '' ? $datos['TIPO_TRANSACCION_CANTIDAD'] : NULL;
                                     $lineas->BODEGA = $datos['BODEGA'];
                                     $lineas->BODEGA_DESTINO = $datos['BODEGA_DESTINO'] != '' ? $datos['BODEGA_DESTINO'] : NULL;
                                     $lineas->ARTICULO = $datos['ARTICULO'];
                                     $lineas->CANTIDAD = $datos['CANTIDAD'];
                                     $lineas->UNIDAD = $datos['UNIDAD'];
                                     $lineas->COSTO_UNITARIO = $datos['COSTO_UNITARIO'];
                                     $lineas->ACTIVO = 'S';
                                     $lineas->save();
                                }
                            }
                            
                            $this->redirect(array('view','id'=>$model->DOCUMENTO_INV));
                        }
				
		}

		$this->render('update',array(
			'model'=>$model,
			'modelLi'=>$modelLi,
			'modelLinea'=>$modelLinea,
			'countLineas'=>$countLineas,
                        'bodega'=>$bodega,
                        'articulo'=>$articulo,
                        'ruta'=>$ruta,
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
			$model=$this->loadModel($id);
                        
                        $model->ACTIVO = 'N';
                        
                        $model->save();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DocumentoInv('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DocumentoInv']))
			$model->attributes=$_GET['DocumentoInv'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        /**
         *Genera un pdf con la informacion del item seleccionado
         *  
         */
        
        public function actionformatoPDF() {

            $id = $_GET['id'];
            
            $this->doc = $model = DocumentoInv::model()->findByPk($id);
            $model2 = new DocumentoInvLinea;
            
            $this->layout = ConsecutivoCi::model()->find('ID = "'.$model->CONSECUTIVO.'"')->fORMATOIMPRESION->RUTA;
            
            $footer = '<table width="100%">
                    <tr><td align="center" valign="middle"><span class="piePagina"><b>Generado por:</b> ' . Yii::app()->user->name . '</span></td>
                        <td align="center" valign="middle"><span class="piePagina"><b>Generado el:</b> ' . date('Y/m/d') . '</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" valign="middle">Desarrollado por Tramasoft Soluciones TIC - <a href="http://www.tramasoft.com">www.tramasoft.com</a></td>
                    </tr>
                    </table>';
            $mPDF1 = Yii::app()->ePdf->mpdf();
            $mPDF1->WriteHTML($this->render('pdf', array('model2' => $model2, 'model' => $this->doc), true));
            $mPDF1->SetHTMLFooter($footer);

            $mPDF1->Output();
            Yii::app()->end();
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=DocumentoInv::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='documento-inv-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionAprobar(){
            $documentos = explode(',',$_POST['seleccion']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($documentos as $id){
                 $documento = DocumentoInv::model()->findByPk($id);
                 
                 if($documento->ESTADO == 'L'){
                      $contError+=1;
                      $error.= $id.',';
                 }elseif($documento->ESTADO == 'A'){
                     $contWarning+=1;
                     $warning.= $id.',';
                 }elseif($documento->ESTADO == 'C'){
                     $contError+=1;
                     $error.= $id.',';
                 }elseif($documento->ESTADO == 'P'){
                     $documento->ESTADO = 'A';
                     $contSucces+=1;
                     $succes .= $id.',';
                 }
                    
                 $documento->save();
            }
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            
            
           if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Documento(s) Aprobados<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Documento(s) no Aprobados<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Documento(s) ya Aprobados<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.BootAlert');
        }
        
        public function actionReversar(){
            
            $documentos = explode(',',$_POST['seleccion']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($documentos as $id){
                 $documento = DocumentoInv::model()->findByPk($id);
                 
                 if($documento->ESTADO == 'L'){
                      $contError+=1;
                      $error.= $id.',';
                 }elseif($documento->ESTADO == 'A'){
                     $documento->ESTADO = 'P';
                     $contSucces+=1;
                     $succes .= $id.',';
                 }elseif($documento->ESTADO == 'C'){
                     $contError+=1;
                     $error.= $id.',';
                     
                 }elseif($documento->ESTADO == 'P'){
                     $contWarning+=1;
                     $warning.= $id.',';
                 }
                    
                 $documento->save();
            }
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            
            
           if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Documento(s) Reversado(s)<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Documento(s) no Reversado(s)<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Documento(s) ya Reversado(s)<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.BootAlert');
            
        }
        public function actionCancelar(){
            
            $documentos = explode(',',$_POST['seleccion']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($documentos as $id){
                 $documento = DocumentoInv::model()->findByPk($id);
                 
                 if($documento->ESTADO == 'L'){
                      $contError+=1;
                      $error.= $id.',';
                 }elseif($documento->ESTADO == 'A'){
                     $documento->ESTADO = 'C';
                     $contSucces+=1;
                     $succes .= $id.',';
                 }elseif($documento->ESTADO == 'C'){
                     $contWarning+=1;
                     $warning.= $id.',';
                     
                 }elseif($documento->ESTADO == 'P'){
                     $contError+=1;
                     $error.= $id.',';
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
            
           $this->widget('bootstrap.widgets.BootAlert');
            
        }
        
        public function actionAplicar(){
            
            $documentos = explode(',',$_POST['seleccion']);
            $contSucces = 0;
            $contError = 0;
            $contWarning = 0;
            $succes = '';
            $error = '';
            $warning = '';
            
            foreach($documentos as $id){
                 $documento = DocumentoInv::model()->findByPk($id);
                 
                 if($documento->ESTADO == 'C'){
                      $contError+=1;
                      $error.= $id.',';
                 }elseif($documento->ESTADO == 'A'){
                     //echo $documento->DOCUMENTO_INV.'<br />';
                     $transaction=$documento->dbConnection->beginTransaction();
                     try{
                        $this->modificarExistencias($documento);
                         $documento->ESTADO = 'L';
                         $documento->save();
                         $contSucces+=1;
                         $succes .= $id.',';
                        
                        $transaction->commit();
                     }catch(Exception $e) // se arroja una excepción si una consulta falla
                     {
                        $contError+=1;
                        $error.= $id.',';
                        echo $e;
                        $transaction->rollBack();
                     }
                 }elseif($documento->ESTADO == 'L'){
                     $contWarning+=1;
                     $warning.= $id.',';
                     
                 }elseif($documento->ESTADO == 'P'){
                     $contError+=1;
                     $error.= $id.',';
                 }
            }
                       
            $mensajeSucces = MensajeSistema::model()->findByPk('S001');
            $mensajeError = MensajeSistema::model()->findByPk('E001');
            $mensajeWarning = MensajeSistema::model()->findByPk('A001');
            
            
           if($contSucces !=0)
                Yii::app()->user->setFlash($mensajeSucces->TIPO, '<h3 align="center">'.$mensajeSucces->MENSAJE.': '.$contSucces.' Documento(s) Aplicados<br>('.$succes.')</h3>');
            
            if($contError !=0)
                Yii::app()->user->setFlash($mensajeError->TIPO, '<h3 align="center">'.$mensajeError->MENSAJE.': '.$contError.' Documento(s) no Aplicados<br>('.$error.')</h3>');
            
            if($contWarning !=0)
                Yii::app()->user->setFlash($mensajeWarning->TIPO, '<h3 align="center">'.$mensajeWarning->MENSAJE.': '.$contWarning.' Documento(s) ya Aplicados<br>('.$warning.')</h3>');
            
           $this->widget('bootstrap.widgets.BootAlert');
            
        }
        
        protected function modificarExistencias($documento){
            
            $lineas = DocumentoInvLinea::model()->findAll('DOCUMENTO_INV = "'.$documento->DOCUMENTO_INV.'"');
            $transaccionInv = new TransaccionInv;
            
                $transaccionInv->CONSECUTIVO_CI = $documento->DOCUMENTO_INV;
                $transaccionInv->MODULO_ORIGEN = 'CI';
                $transaccionInv->REFERENCIA = 'Transacción generada por Documento de Inventario';
                $transaccionInv->ACTIVO = 'S';
                
                if($transaccionInv->save()){
                   
                    foreach($lineas as $datos){
                        //echo $datos->ARTICULO.' - '.$datos->BODEGA.'<br />';
                        $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$datos->ARTICULO,'BODEGA'=>$datos->BODEGA));
                        $tipo_transaccion = TipoTransaccion::model()->findByPk($datos->TIPO_TRANSACCION);


                        if($existenciaBodega){
                        $transaccionInvDetalle = new TransaccionInvDetalle;
                            
                            $transaccionInvDetalle->TRANSACCION_INV = $transaccionInv->TRANSACCION_INV;
                            $transaccionInvDetalle->LINEA = $datos->LINEA_NUM;
                            $transaccionInvDetalle->TIPO_TRANSACCION = $datos->TIPO_TRANSACCION;
                            $transaccionInvDetalle->SUBTIPO = $datos->SUBTIPO;
                            $transaccionInvDetalle->TIPO_TRANSACCION_CANTIDAD = $datos->TIPO_TRANSACCION_CANTIDAD;
                            $transaccionInvDetalle->ARTICULO = $datos->ARTICULO;
                            $transaccionInvDetalle->UNIDAD = $datos->UNIDAD;
                            $transaccionInvDetalle->BODEGA = $datos->BODEGA;
                            $transaccionInvDetalle->COSTO_UNITARIO = $datos->COSTO_UNITARIO;
                            $transaccionInvDetalle->PRECIO_UNITARIO = 0;
                            $transaccionInvDetalle->ACTIVO = 'S';

                            switch($datos->TIPO_TRANSACCION_CANTIDAD){
                                case 'D':
                                    if($tipo_transaccion->NATURALEZA == 'E'){

                                        $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'E';

                                    }elseif($tipo_transaccion->NATURALEZA == 'S'){

                                        $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'S';

                                }elseif($tipo_transaccion->NATURALEZA == 'A')
                                        $this->naturaAmbas($datos,$existenciaBodega,$transaccionInvDetalle,$documento);
                                break;
                                case 'R':
                                    if($tipo_transaccion->NATURALEZA == 'E'){

                                        $existenciaBodega->CANT_RESERVADA += $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'E';

                                    }elseif($tipo_transaccion->NATURALEZA == 'S'){

                                        $existenciaBodega->CANT_RESERVADA -= $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'S';

                                }elseif($tipo_transaccion->NATURALEZA == 'A')
                                        $this->naturaAmbas($datos,$existenciaBodega,$transaccionInvDetalle,$documento);
                                break;
                                case 'T':
                                    if($tipo_transaccion->NATURALEZA == 'E'){

                                        $existenciaBodega->CANT_REMITIDA += $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'E';

                                    }elseif($tipo_transaccion->NATURALEZA == 'S'){

                                        $existenciaBodega->CANT_REMITIDA -= $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'S';

                                }elseif($tipo_transaccion->NATURALEZA == 'A')
                                       $this->naturaAmbas($datos,$existenciaBodega,$transaccionInvDetalle,$documento);
                                break;
                                case 'C':
                                    if($tipo_transaccion->NATURALEZA == 'E'){

                                        $existenciaBodega->CANT_CUARENTENA += $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'E';

                                    }elseif($tipo_transaccion->NATURALEZA == 'S'){

                                        $existenciaBodega->CANT_CUARENTENA -= $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'S';

                                }elseif($tipo_transaccion->NATURALEZA == 'A')
                                        $this->naturaAmbas($datos,$existenciaBodega,$transaccionInvDetalle,$documento);
                                break;
                                case 'V':
                                    if($tipo_transaccion->NATURALEZA == 'E'){

                                        $existenciaBodega->CANT_VENCIDA += $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'E';

                                    }elseif($tipo_transaccion->NATURALEZA == 'S'){

                                        $existenciaBodega->CANT_VENCIDA -= $datos->CANTIDAD;

                                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                        $transaccionInvDetalle->NATURALEZA = 'S';

                                }elseif($tipo_transaccion->NATURALEZA == 'A')
                                        $this->naturaAmbas($datos,$existenciaBodega,$transaccionInvDetalle,$documento);
                                break;
                            }
                            $existenciaBodega->save();
                            $transaccionInvDetalle->save();
                            Articulo::actualizarCosto($transaccionInvDetalle->ARTICULO);
                        }else{
                            echo 'No ahy relacion en entre articulo '.$datos->ARTICULO.' y la bodega '.$datos->BODEGA.'<br />';
                        }


                    }
                }else
                    $transaccionInv->delete();
                
            }
            
        protected function naturaAmbas($datos,$existenciaBodega,$transaccionInvDetalle,$documento){
            
           $transaccionInvDetalle2 = new TransaccionInvDetalle;
            
           $transaccionInvDetalle2->TRANSACCION_INV = $documento->DOCUMENTO_INV;
           $transaccionInvDetalle2->LINEA = $datos->LINEA_NUM;
           $transaccionInvDetalle2->TIPO_TRANSACCION = $documento->TIPO_TRANSACCION;
           $transaccionInvDetalle2->SUBTIPO = $documento->SUBTIPO;
           $transaccionInvDetalle2->ARTICULO = $documento->ARTICULO;
           $transaccionInvDetalle2->UNIDAD = $documento->UNIDAD;
           $transaccionInvDetalle2->BODEGA = $documento->BODEGA;
           $transaccionInvDetalle2->COSTO_UNITARIO = $documento->COSTO_UNITARIO;
           $transaccionInvDetalle2->PRECIO_UNITARIO = 0;
           $transaccionInvDetalle2->ACTIVO = 'S';
            
            switch($datos->TIPO_TRANSACCION){
                   case 'APRO':                         
                       if($datos->TIPO_TRANSACCION_CANTIDAD == 'D'){
                             $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'C';
                             if($datos->CANTIDAD > 0){
                                 //GUARDAR EL DETALLE DE LA ENTRADA
                                 $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                                 $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle->NATURALEZA = 'E';
                                 //GUARDAR EL DETALLE DE LA SALIDA
                                 $existenciaBodega->CANT_CUARENTENA -= $datos->CANTIDAD;
                                 $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle2->NATURALEZA = 'S';
                                 
                             }else{
                                 //GUARDAR EL DETALLE DE LA SALIDA
                                 $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;
                                 $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle2->NATURALEZA = 'S';
                                 //GUARDAR EL DETALLE DE LA ENTRADA
                                 $existenciaBodega->CANT_CUARENTENA += $datos->CANTIDAD;
                                 $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle->NATURALEZA = 'E';
                             }
                       }elseif($datos->TIPO_TRANSACCION_CANTIDAD == 'C'){
                           $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'D';
                             if($datos->CANTIDAD > 0){
                                 //GUARDAR EL DETALLE DE LA ENTRADA
                                 $existenciaBodega->CANT_CUARENTENA += $datos->CANTIDAD;
                                 $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle->NATURALEZA = 'E';
                                 //GUARDAR EL DETALLE DE LA SALIDA
                                 $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;
                                 $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle2->NATURALEZA = 'S';
                             }else{
                                 //GUARDAR EL DETALLE DE LA SALIDA
                                 $existenciaBodega->CANT_CUARENTENA -= $datos->CANTIDAD;
                                 $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle2->NATURALEZA = 'S';
                                 //GUARDAR EL DETALLE DE LA ENTRADA
                                 $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                                 $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                 $transaccionInvDetalle->NATURALEZA = 'E';
                             }
                       }
                   break;  
                   case 'FISI':
                       switch($datos->TIPO_TRANSACCION_CANTIDAD){
                            case 'D':
                                $existenciaBodega->CANT_DISPONIBLE = $datos->CANTIDAD;
                                //GUARDA LA CANTIDAD EXEDENTE EN EL AJUSTE FISICO
                                if($datos->CANTIDAD > $existenciaBodega->CANT_DISPONIBLE){
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD - $existenciaBodega->CANT_DISPONIBLE;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }else{
                                    $transaccionInvDetalle->CANTIDAD = $existenciaBodega->CANT_DISPONIBLE - $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }
                            break;
                            case 'R':
                                $existenciaBodega->CANT_RESERVADA = $datos->CANTIDAD;
                                //GUARDA LA CANTIDAD EXEDENTE EN EL AJUSTE FISICO
                                if($datos->CANTIDAD > $existenciaBodega->CANT_RESERVADA){
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD - $existenciaBodega->CANT_RESERVADA;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }else{
                                    $transaccionInvDetalle->CANTIDAD = $existenciaBodega->CANT_RESERVADA - $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }
                            break;
                            case 'T':
                                $existenciaBodega->CANT_REMITIDA = $datos->CANTIDAD;
                                //GUARDA LA CANTIDAD EXEDENTE EN EL AJUSTE FISICO
                                if($datos->CANTIDAD > $existenciaBodega->CANT_REMITIDA){
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD - $existenciaBodega->CANT_REMITIDA;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }else{
                                    $transaccionInvDetalle->CANTIDAD = $existenciaBodega->CANT_REMITIDA - $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }
                            break;
                            case 'C':
                                $existenciaBodega->CANT_CUARENTENA = $datos->CANTIDAD;
                                //GUARDA LA CANTIDAD EXEDENTE EN EL AJUSTE FISICO
                                if($datos->CANTIDAD > $existenciaBodega->CANT_CUARENTENA){
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD - $existenciaBodega->CANT_CUARENTENA;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }else{
                                    $transaccionInvDetalle->CANTIDAD = $existenciaBodega->CANT_CUARENTENA - $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }
                            break;
                            case 'V':
                                $existenciaBodega->CANT_VENCIDA = $datos->CANTIDAD;
                                //GUARDA LA CANTIDAD EXEDENTE EN EL AJUSTE FISICO
                                if($datos->CANTIDAD > $existenciaBodega->CANT_VENCIDA){
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD - $existenciaBodega->CANT_VENCIDA;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }else{
                                    $transaccionInvDetalle->CANTIDAD = $existenciaBodega->CANT_VENCIDA - $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }
                            break;
                        }
                   break;
                   case 'MISC':
                        $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                        switch($datos->TIPO_TRANSACCION_CANTIDAD){
                            case 'D':
                                if($datos->CANTIDAD > 0){
                                    $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }else{
                                    $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }
                            break;
                            case 'R':
                                if($datos->CANTIDAD > 0){
                                    $existenciaBodega->CANT_RESERVADA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }else{
                                    $existenciaBodega->CANT_RESERVADA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }
                            break;
                            case 'T':
                                if($datos->CANTIDAD > 0){
                                    $existenciaBodega->CANT_REMITIDA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }else{
                                    $existenciaBodega->CANT_REMITIDA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }
                            break;
                            case 'C':
                                if($datos->CANTIDAD > 0){
                                    $existenciaBodega->CANT_CUARENTENA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }else{
                                    $existenciaBodega->CANT_CUARENTENA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }
                                
                            break;
                            case 'V':
                                 if($datos->CANTIDAD > 0){
                                    $existenciaBodega->CANT_VENCIDA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'S';
                                }else{
                                    $existenciaBodega->CANT_VENCIDA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                }                                
                            break;
                        }
                   break;
               
                   case 'RESE':
                       $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'R';
                       //SI EL VALOR ES POSITIVO O NEGATIVO
                       if($datos->CANTIDAD > 0){
                           //GUARDAR EL DETALLE DE LA SALIDA
                           $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;
                           $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                           $transaccionInvDetalle2->NATURALEZA = 'S';
                       
                           //GUARDAR EL DETALLE DE LA ENTRADA
                            $existenciaBodega->CANT_RESERVADA  += $datos->CANTIDAD;
                            $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                            $transaccionInvDetalle->NATURALEZA = 'E';
                       }else{
                           //GUARDAR EL DETALLE DE LA SALIDA
                           $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                           $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                           $transaccionInvDetalle2->NATURALEZA = 'S';
                           
                           //GUARDAR EL DETALLE DE LA ENTRADA
                           $existenciaBodega->CANT_RESERVADA  += (-1*$datos->CANTIDAD);
                           $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                           $transaccionInvDetalle->NATURALEZA = 'E';
                       }
                   break;

                   case 'TRAS':
                       $existenciaBodegaDestino = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$datos->ARTICULO,'BODEGA'=>$datos->BODEGA_DESTINO));
                       $transaccionInvDetalle2->BODEGA = $datos->BODEGA_DESTINO;
                       if($existenciaBodegaDestino){
                            switch($datos->TIPO_TRANSACCION_CANTIDAD){
                                case 'D':
                                    $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'D';
                                    //GUARDAR LA SALIDA DE BODEGA ORIGEN
                                    $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;
                                    $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle2->NATURALEZA = 'S';
                                    //GUARDAR LA ENTRADA A LA BODEGA DESTINO
                                    $existenciaBodegaDestino->CANT_DISPONIBLE += $datos->CANTIDAD;
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                break;
                                case 'R':
                                    $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'R';
                                    //GUARDAR LA SALIDA DE BODEGA ORIGEN
                                    $existenciaBodega->CANT_RESERVADA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle2->NATURALEZA = 'S';
                                    //GUARDAR LA ENTRADA A LA BODEGA DESTINO
                                    $existenciaBodegaDestino->CANT_RESERVADA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                break;
                                case 'T':
                                    $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'T';
                                    //GUARDAR LA SALIDA DE BODEGA ORIGEN
                                    $existenciaBodega->CANT_REMITIDA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle2->NATURALEZA = 'S';
                                    //GUARDAR LA ENTRADA A LA BODEGA DESTINO
                                    $existenciaBodegaDestino->CANT_REMITIDA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                break;
                                case 'C':
                                    $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'C';
                                    //GUARDAR LA SALIDA DE BODEGA ORIGEN
                                    $existenciaBodega->CANT_CUARENTENA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle2->NATURALEZA = 'S';
                                    //GUARDAR LA ENTRADA A LA BODEGA DESTINO
                                    $existenciaBodegaDestino->CANT_CUARENTENA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                break;
                                case 'V':
                                    $transaccionInvDetalle2->TIPO_TRANSACCION_CANTIDAD = 'V';
                                    //GUARDAR LA SALIDA DE BODEGA ORIGEN
                                    $existenciaBodega->CANT_VENCIDA -= $datos->CANTIDAD;
                                    $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle2->NATURALEZA = 'S';
                                    //GUARDAR LA ENTRADA A LA BODEGA DESTINO
                                    $existenciaBodegaDestino->CANT_VENCIDA += $datos->CANTIDAD;
                                    $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                                    $transaccionInvDetalle->NATURALEZA = 'E';
                                break;
                            }
                            $existenciaBodegaDestino->save();
                       }else{
                           echo 'No ahy relacion entre el articulo '.$datos->ARTICULO.' y la bodega '.$datos->BODEGA_DESTINO.' para el traspaso<br />';
                       }
                   break;

                   case 'VENC':
                       if($datos->CANTIDAD > 0){
                           //GUARDAR EL DETALLE DE LA SALIDA
                           $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;
                           $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                           $transaccionInvDetalle2->NATURALEZA = 'S';
                       
                           //GUARDAR EL DETALLE DE LA ENTRADA
                            $existenciaBodega->CANT_VENCIDA  += $datos->CANTIDAD;
                            $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                            $transaccionInvDetalle->NATURALEZA = 'E';
                       }else{
                           //GUARDAR EL DETALLE DE LA SALIDA
                           $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                           $transaccionInvDetalle2->CANTIDAD = $datos->CANTIDAD;
                           $transaccionInvDetalle2->NATURALEZA = 'S';
                       
                           //GUARDAR EL DETALLE DE LA ENTRADA
                            $existenciaBodega->CANT_VENCIDA  += (-1*$datos->CANTIDAD);
                            $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;                           
                       }
                   break;
                   default:
                       $transaccionInvDetalle->CANTIDAD = $datos->CANTIDAD;
                       if($datos->CANTIDAD > 0)
                            $transaccionInvDetalle->NATURALEZA = 'E';
                       else
                            $transaccionInvDetalle->NATURALEZA = 'S';
                       switch($datos->TIPO_TRANSACCION_CANTIDAD){
                                case 'D':
                                    $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                                break;
                                case 'R':
                                    $existenciaBodega->CANT_RESERVADA += $datos->CANTIDAD;
                                break;
                                case 'T':
                                    $existenciaBodega->CANT_REMITIDA += $datos->CANTIDAD;
                                break;
                                case 'C':
                                    $existenciaBodega->CANT_CUARENTENA += $datos->CANTIDAD;
                                break;
                                case 'V':
                                    $existenciaBodega->CANT_VENCIDA += $datos->CANTIDAD;
                                break;
                       }
                  break;
            }
            if($transaccionInvDetalle2->save())
                Articulo::actualizarCosto($transaccionInvDetalle2->ARTICULO);
        }
}