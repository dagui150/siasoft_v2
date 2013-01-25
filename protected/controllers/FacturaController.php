<?php

class FacturaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $factura;

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
	 * If creation is successful, the browser will be redirected to the 'admin' page.
	 */
	public function actionCreate()
	{
		$model=new Factura;
                $cliente = new Cliente('factura');
                $linea = new FacturaLinea;
                $articulo = new Articulo;
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';
                $conf = ConfFa::model()->find();

                $model->CONDICION_PAGO = !isset($_POST['Factura']['CONDICION_PAGO']) && $conf->COND_PAGO_CONTADO!= '' ? $conf->COND_PAGO_CONTADO:$_POST['Factura']['CONDICION_PAGO'];
                $model->BODEGA = !isset($_POST['Factura']['BODEGA']) && $conf->BODEGA_DEFECTO!= '' ? $conf->BODEGA_DEFECTO:$_POST['Factura']['BODEGA'];
                $model->NIVEL_PRECIO =!isset($_POST['Factura']['NIVEL_PRECIO']) &&  $conf->NIVEL_PRECIO!= '' ? $conf->NIVEL_PRECIO:$_POST['Factura']['NIVEL_PRECIO'];
                $model->UNIDAD =isset($_POST['Factura']['UNIDAD'])  ? $_POST['Factura']['UNIDAD'] :'';
                
                
                
		$this->performAjaxValidation(array($model,$cliente));
                if(isset($_POST['ajax']) && $_POST['ajax']==='factura-linea-form')
		{
			echo CActiveForm::validate($linea);
			Yii::app()->end();
		}

		if(isset($_POST['Factura']))
		{
                        
                        
                        $transaccionInv = new TransaccionInv;
			$model->attributes=$_POST['Factura'];
                        $modelConsecutivo = ConsecutivoFa::model()->findByPk($model->CONSECUTIVO);
                        $model->FACTURA = $modelConsecutivo->VALOR_CONSECUTIVO;
                        $model->BODEGA = $_POST['Factura']['BODEGA'];   
                        $model->REMITIDO = 'N';   
                        $model->RESERVADO = 'N';   
                        $model->ESTADO = 'N';
                        
			$cliente->attributes=$_POST['Cliente'];
                        $transaction = $model->dbConnection->beginTransaction();
                        try{
                            if($cliente->CLIENTE != '0'){
                                $cliente->PAIS = 'COL';
                                $cliente->ACTIVO = 'S';
                                $cliente->save();
                            }
                            $model->save();
                            $transaccionInv->CONSECUTIVO_FA = $model->FACTURA;
                            $transaccionInv->MODULO_ORIGEN = 'FA';
                            $transaccionInv->REFERENCIA = 'Transacción generada por Factura';
                            $transaccionInv->ACTIVO = 'S';

                            if($transaccionInv->save()){
                                 if(isset($_POST['LineaNuevo'])){
                                      $i = 1;
                                      foreach ($_POST['LineaNuevo'] as $datos){
                                            $transaccionInvDetalle = new TransaccionInvDetalle;
                                          //GUARDAR LINEAS DE FACTURA
                                            
                                            $salvar = new FacturaLinea;
                                            $salvar->FACTURA = $model->FACTURA;
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
                                         //ACTUALIZAR EL INVENTARIO
                                            $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$datos['ARTICULO'],'BODEGA'=>$model->BODEGA));
                                            $cantidad = $this->darCantidad($existenciaBodega, Controller::unformat($datos['CANTIDAD']), $datos['UNIDAD']);
                                            $existenciaBodega->CANT_DISPONIBLE -= $cantidad;
                                            $existenciaBodega->update();
                                         //GUARDAR LINEAS DE TRANSACCION
                            
                                            $transaccionInvDetalle->TRANSACCION_INV = $transaccionInv->TRANSACCION_INV;
                                            $transaccionInvDetalle->LINEA = $i;
                                            $transaccionInvDetalle->TIPO_TRANSACCION_CANTIDAD = 'D';
                                            $transaccionInvDetalle->ARTICULO = $datos['ARTICULO'];
                                            $transaccionInvDetalle->UNIDAD = $datos['UNIDAD'];
                                            $transaccionInvDetalle->NATURALEZA = 'S';
                                            $transaccionInvDetalle->CANTIDAD = $cantidad;
                                            $transaccionInvDetalle->BODEGA = $model->BODEGA;
                                            $transaccionInvDetalle->COSTO_UNITARIO = 0;
                                            $transaccionInvDetalle->PRECIO_UNITARIO = $datos['PRECIO_UNITARIO'];
                                            $transaccionInvDetalle->ACTIVO = 'S';
                                            $transaccionInvDetalle->save();
                                          //
                                            $i++;
                                     }
                                 }
                            }
                              //ACTUALIZAR SIGUIENTE VALOR
                                $separados = ConsecutivoFa::extractNum($modelConsecutivo->MASCARA);
                                $longitud = strlen($separados[1]);
                                $count = Factura::model()->count('CONSECUTIVO = "'.$model->CONSECUTIVO.'"');
                                $modelConsecutivo->VALOR_CONSECUTIVO = $separados[0].str_pad(++$count, $longitud, "0", STR_PAD_LEFT);

                             $modelConsecutivo->update();
                             $transaction->commit();
                             
                             $arr=array();
                             $facturas =  Factura::model()->findAll();
                             foreach($facturas as $factura) 
                                $arr[]=$factura->FACTURA;
                             $pos=array_search($model->FACTURA,$arr);
                             $page=ceil(($pos+1)/10);
                             
                             $this->redirect(array('admin','id'=>$model->FACTURA,'Factura_page'=>$page));
                             
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
                        'conf'=>$conf,
                        'ruta'=>$ruta,
                        'ruta2'=>$ruta2,
		));
	}
        /**
         * Este metod hace las opertaciones necesarias para agregar una linea
         */
        public function actionAgregarlinea(){
            $linea = new FacturaLinea;
            $linea->attributes = $_POST['FacturaLinea'];
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
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Factura']))
		{
			$model->attributes=$_POST['Factura'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->FACTURA));
		}

		$this->render('update',array(
			'model'=>$model,
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Factura('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Factura']))
			$model->attributes=$_GET['Factura'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionformatoPDF() 
        {

            $id = $_GET['id'];
            
            $this->factura = Factura::model()->findByPk($id);
            $lineas = new FacturaLinea;
            $this->layout =ConfFa::model()->find()->fORMATOFACTURA->pLANTILLA->RUTA;
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
            $header = '<table width="100%" align="center" >
                            <tr>
                                <td width="26%" rowspan="5" align="left" valign="middle">'.$logo.'</td>
                                <td width="41%" align="center">'.$compania->NOMBRE_ABREV.'</td>
                                <td width="33%" align="right" valign="middle"><strong>Factura de Venta Núm:</strong></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Nit:</b> '.$compania->NIT.'</td>
                                <td width="33%" align="right" valign="middle">'.$id.'</td>
                            </tr>
                            <tr>
                                <td align="center">Dirección  '.$compania->DIRECCION.'</td>
                                <td align="right">Res. DIAN XXXX</td>
                                
                            </tr>
                            <tr>
                                <td align="center"><b>Tels:</b> '.$compania->TELEFONO1.'-'.$compania->TELEFONO2.'</td>
                                <td width="33%" align="right" valign="middle">Numeración Autorizada</td>
                            </tr>
                            
                            <tr>
                                <td align="center">Regimen Común</td>
                                <td align="right" valign="middle">ZZZZ-VVVVV</td>
                            </tr>
                        </table>';
            //'',array(377,279),0,'',15,15,16,16,9,9, 'P'
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4',0,'','15','15','33','','5','', 'P');
            $mPDF1->w=210;   //manually set width
            $mPDF1->h=148.5; //manually set height
            $mPDF1->SetHTMLHeader($header);
            $mPDF1->SetHTMLFooter($footer);
            //$mPDF1->WriteHTML(Yii::app()->bootstrap->register());
            $mPDF1->WriteHTML($this->render('pdf', array('model' => $this->factura,'model2'=>$lineas), true));
            

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
		$model=Factura::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='factura-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        /**
         * Este metodo retorna por medio de un objeto JSON el valor del proximo consecutivo a usar
         * @param integer $id 
         * @return CJSON respuesta
         */
        public function actionCargarconsecutivo($id){
             $bus =ConsecutivoFa::model()->findByPk($id);
            $res=array(
                'VALOR'=>$bus->VALOR_CONSECUTIVO,
            );
            
           echo CJSON::encode($res);
        }
}
