<?php

class FacturaController extends SBaseController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
        public $breadcrumbs=array();

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
		$model=new Factura;
                $cliente = new Cliente;
                $linea = new FacturaLinea;
                $articulo = new Articulo;
                $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
                $ruta2 = Yii::app()->request->baseUrl.'/images/cargar.gif';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                if(isset($_POST['ajax']) && $_POST['ajax']==='factura-linea-form')
		{
			echo CActiveForm::validate($linea);
			Yii::app()->end();
		}

		if(isset($_POST['Factura']))
		{
                        $transaction = $model->dbConnection->beginTransaction();
			$model->attributes=$_POST['Factura'];
                        try{
                            //ACTUALIZAR CONSECUTIVO
                                $modelConsecutivo = ConsecutivoFa::model()->findByPk($model->CONSECUTIVO);
                                $consecutivo = substr($modelConsecutivo->MASCARA,0,4);
                                $mascara = strlen($modelConsecutivo->MASCARA);
                                $longitud = $mascara - 4;
                                $count = Factura::model()->count();
                                $consecutivo .= str_pad(++$count, $longitud, "0", STR_PAD_LEFT);
                                $model->FACTURA = $consecutivo;

                            $model->REMITIDO = 'N';   
                            $model->RESERVADO = 'N';   
                            $model->ESTADO = 'N';   
                            if($model->save()){
                                if(isset($_POST['LineaNuevo'])){
                                        $i = 0;
                                        foreach ($_POST['LineaNuevo'] as $datos){
                                            $salvar = new PedidoLinea;
                                            $salvar->ARTICULO = $datos['ARTICULO'];
                                            $salvar->PEDIDO = $model->FACTURA;
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
                                            $salvar->ESTADO = 'N';
                                            $salvar->ACTIVO = 'S';
                                            $salvar->save();
                                            $i++;
                                        }
                                }

                                $modelConsecutivo->VALOR_CONSECUTIVO = substr($modelConsecutivo->MASCARA,0,4).str_pad(++$count, $longitud, "0", STR_PAD_LEFT);

                                $modelConsecutivo->save();
                                $this->redirect(array('admin'));
                            }
                            $transaction->commit();
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
		));
	}
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
        
        public function actionCargarconsecutivo($id){
             $bus =ConsecutivoFa::model()->findByPk($id);
            $res=array(
                'VALOR'=>$bus->VALOR_CONSECUTIVO,
            );
            
           echo CJSON::encode($res);
        }
}
