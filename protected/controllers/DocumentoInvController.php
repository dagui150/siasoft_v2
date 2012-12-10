<?php

class DocumentoInvController extends SBaseController
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
                'TIPO_TRANSACCION'=>CHtml::listData(ConsecCiTipoTrans::model()->with('tIPOTRANSACCION')->findAll('CONSECUTIVO_CI = "'.$id.'"'),'tIPOTRANSACCION.TIPO_TRANSACCION','tIPOTRANSACCION.NOMBRE'),
            );
            
           echo CJSON::encode($res);
        }
        
        //TODAS LAS OPERACIONES QUE SE HAGAN CON LAS LINEAS
        public function actionAgregarlinea(){
            
            if(isset($_GET['cantidades']))
                 echo CJSON::encode(TipoCantidadArticulo::darCombo());
            
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
           
           if(isset($_GET['cantidad']))
               echo CJSON::encode(array('NOMBRE'=>TipoCantidadArticulo::darNombre($_GET['cantidad']) ));
                
           if(isset($_GET['idBodega']))
                $this->cargarBodega($_GET['idBodega']);
           
           if(isset($_GET['idArticulo']))
                $this->cargarArticulo($_GET['idArticulo']);
            
        }
        //CARGAR LAS CANTIDADES A AFECTAR SEGUN TRANSACCION BASE
        protected function cargarCantidades($id_transaccion){
            
            $bus = TipoTransaccion::model()->findByPk($id_transaccion);
            
            $res = array(
                'TRANSACCIONES'=> TipoTransaccionCantidad::darTransacciones($bus->TRANSACCION_BASE),
                'TRANSACCION_BASE'=> $bus->TRANSACCION_BASE
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
                'NOMBRE'=>isset($bus->NOMBRE) ? $bus->NOMBRE :'Ninguno'
            );
            
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
                     $documento->ESTADO = 'L';
                     
                     $this->modificarExistencias($documento); 
                     
                     $contSucces+=1;
                     $succes .= $id.',';
                 }elseif($documento->ESTADO == 'L'){
                     $contWarning+=1;
                     $warning.= $id.',';
                     
                 }elseif($documento->ESTADO == 'P'){
                     $contError+=1;
                     $error.= $id.',';
                 } 
                 //$documento->save();
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
            
            foreach($lineas as $datos){
                echo $datos->ARTICULO.' - '.$datos->BODEGA.'<br />';
                $articulo = Articulo::model()->findByPk($datos->ARTICULO);
                $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$datos->ARTICULO,'BODEGA'=>$datos->BODEGA));
                $tipo_transaccion = TipoTransaccion::model()->findByPk($datos->TIPO_TRANSACCION);
                
               // echo $datos->TIPO_TRANSACCION_CANTIDAD.'<br />';
                if($existenciaBodega){
                    switch($tipo_transaccion->TRANSACCION_BASE){
                        case 'APRO':
                            if($datos->TIPO_TRANSACCION_CANTIDAD == 'D')
                                $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                            elseif($datos->TIPO_TRANSACCION_CANTIDAD == 'C')
                                    $existenciaBodega->CANT_CUARENTENA -= $datos->CANTIDAD;
                        break;

                        case 'COMP':
                            if($datos->TIPO_TRANSACCION_CANTIDAD == 'D')
                                $existenciaBodega->CANT_DISPONIBLE += $datos->CANTIDAD;
                           
                        break;

                        case 'CONS':
                            if($datos->TIPO_TRANSACCION_CANTIDAD == 'D')
                                $existenciaBodega->CANT_DISPONIBLE -= $datos->CANTIDAD;
                        break;
                    
                        case 'COST':
                            $articulo->COSTO_ESTANDAR = $$datos->COSTO_UNITARIO;
                        break;
                    
                        case 'ENSA':
                            //preguntar a diego
                        break;
                        case 'FISI':
                           //cantidades pendientes por revisar
                        break;
                        case 'MISC':
                            //cantidades pendientes por revisar y valores negativos
                        break;
                        case 'PROD':
                            //cantidades pendientes por revisar
                        break;
                    
                        case 'RESE':
                            //disminuye disponible y aumenta reservada
                        break;

                        case 'TRAS':
                            //revisar traspaso
                        break;

                        case 'VENC':
                            //cantidades pendientes por revisar
                        break;

                        case 'VENT':
                            //disnimuye disponible o reservada, aumenta la cant vendida
                        break;

                        default:
                            echo "i no es igual a 0, 1 ni 2<br />";
                    }
                    echo $existenciaBodega->CANT_RESERVADA.'<br />';
                    echo $existenciaBodega->CANT_REMITIDA.'<br />';
                    echo $existenciaBodega->CANT_VENCIDA.'<br /><br />';
                }else{
                    echo 'no existe nada<br /><br />';
                }
                
                
            }
            
        }
        
}
