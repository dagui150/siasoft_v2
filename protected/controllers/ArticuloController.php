<?php

class ArticuloController extends SBaseController
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
	/*
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
                   $model=new Articulo;
                   $bodega = new Bodega;
                   $impuesto = new Impuesto;
                   $retencion = new Retencion;
                   
                   $conf=ConfCi::model()->find();
                   $tipo=array();
                   $cont=0;

                   if($conf->USA_CODIGO_EAN13==true)
                        $tipo[$cont]= 'EAN13';
                        $cont++;
                   if($conf->USA_CODIGO_EAN8==true)
                         $tipo[$cont]= 'EAN8';
                         $cont++;

                   if($conf->USA_CODIGO_UCC12==true)
                        $tipo[$cont]= 'UCC12';
                        $cont++;

                   if($conf->USA_CODIGO_UCC8==true)
                         $tipo[$cont]= 'UCC8';
                        $cont++;
                        
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
                    
		if(isset($_POST['Articulo']))
		{
                        $model->attributes=$_POST['Articulo']; 
                        
                        if($_POST['Articulo']['IMPUESTO_COMPRA'] === '')
                            $model->IMPUESTO_COMPRA = NULL;
                        
                        if($_POST['Articulo']['BODEGA'] === '')
                            $model->BODEGA = NULL;
                        
                        if($_POST['Articulo']['RETENCION_COMPRA'] === '')
                            $model->RETENCION_COMPRA = NULL;
                        
                        if($_POST['Articulo']['RETENCION_VENTA'] === '')
                            $model->RETENCION_VENTA = NULL;
                        
			if($model->save()){
                            if(isset($_POST['OtraClasificacionNuevo'])){
                                foreach ($_POST['OtraClasificacionNuevo'] as $datos){
                                     $adi = new ClasificAdiArticulo;
                                     $adi->ARTICULO = $_POST['Articulo']['ARTICULO'];
                                     $adi->VALOR = $datos['VALOR'];
                                     $adi->ACTIVO = 'S';
                                     $adi->save();
                                }
                            }
                            $this->redirect(array('admin'));
                        }
		}
                
                if(isset($_GET['ClasificacionAdiValor']))
			$adivalor->attributes=$_GET['ClasificacionAdiValor'];
                
                if(isset($_GET['Bodega']))
			$bodega->attributes=$_GET['Bodega'];
                
                if(isset($_GET['Impuesto']))
			$impuesto->attributes=$_GET['Impuesto'];
                
                if(isset($_GET['Retencion']))
			$retencion->attributes=$_GET['Retencion'];
                
                if(isset($_GET['Bodega']))
			$bodega->attributes=$_GET['Bodega'];
                
                if(isset($_GET['Impuesto']))
			$impuesto->attributes=$_GET['Impuesto'];
                
                if(isset($_GET['Retencion']))
			$retencion->attributes=$_GET['Retencion'];
                
		$this->render('create',array(
			'model'=>$model,
                        'tipo'=>$tipo,
                        'conf'=>$conf,
                        'bodega'=>$bodega,
                        'impuesto'=>$impuesto,
                        'retencion'=>$retencion,
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
                $conf=ConfCi::model()->find();
                $lineas = ClasificAdiArticulo::model()->findAll('ARTICULO = "'.$model->ARTICULO.'"');
                $bodega = new Bodega;
                $impuesto = new Impuesto;
                $retencion = new Retencion;
                $tipo=array();
                $cont=0;

                   if($conf->USA_CODIGO_EAN13==true)
                        $tipo[$cont]= 'EAN13';
                        $cont++;
                   if($conf->USA_CODIGO_EAN8==true)
                         $tipo[$cont]= 'EAN8';
                         $cont++;

                   if($conf->USA_CODIGO_UCC12==true)
                        $tipo[$cont]= 'UCC12';
                        $cont++;

                   if($conf->USA_CODIGO_UCC8==true)
                         $tipo[$cont]= 'UCC8';
                        $cont++;
                
		// Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

		if(isset($_POST['Articulo']))
		{
			$model->attributes=$_POST['Articulo'];
                        
                        if($_POST['Articulo']['IMPUESTO_COMPRA'] === '')
                            $model->IMPUESTO_COMPRA = NULL;
                        
                        if($_POST['Articulo']['BODEGA'] === '')
                            $model->BODEGA = NULL;
                        
                        if($_POST['Articulo']['RETENCION_COMPRA'] === '')
                            $model->RETENCION_COMPRA = NULL;
                        
                        if($_POST['Articulo']['RETENCION_VENTA'] === '')
                            $model->RETENCION_VENTA = NULL;
                        
			if($model->save()){
                            //Actualizar Registros
                            if(isset($_POST['ClasificAdiArticulo'])){
                                foreach ($_POST['ClasificAdiArticulo'] as $datos){
                                     $adi = ClasificAdiArticulo::model()->findByPk($datos['ID']);;
                                     $adi->ARTICULO = $model->ARTICULO;
                                     $adi->VALOR = $datos['VALOR'];
                                     $adi->ACTIVO = 'S';
                                     $adi->save();
                                }
                            }
                            //NUEVOS REGISTROS
                            if(isset($_POST['OtraClasificacionNuevo'])){
                                foreach ($_POST['OtraClasificacionNuevo'] as $datos){
                                     $adi = new ClasificAdiArticulo;
                                     $adi->ARTICULO = $model->ARTICULO;
                                     $adi->VALOR = $datos['VALOR'];
                                     $adi->ACTIVO = 'S';
                                     $adi->save();
                                }
                            }
                            //ELIMINAR REGISTROS
                             if(isset($_POST['eliminar'])){
                                $arEliminar = explode(',',$_POST['eliminar']);
                                
                                foreach($arEliminar as $elimina){
                                    $borrar = ClasificAdiArticulo::model()->deleteByPk($elimina);
                                }
                                
                             }
                            $this->redirect(array('admin'));
                        }
		}
                
                if(isset($_GET['ClasificacionAdiValor']))
			$adivalor->attributes=$_GET['ClasificacionAdiValor'];
                
                if(isset($_GET['ClasificacionAdiArticulo']))
			$adi->attributes=$_GET['ClasificacionAdiArticulo'];
                
                if(isset($_GET['Bodega']))
			$bodega->attributes=$_GET['Bodega'];
                
                if(isset($_GET['Impuesto']))
			$impuesto->attributes=$_GET['Impuesto'];
                
                if(isset($_GET['Retencion']))
			$retencion->attributes=$_GET['Retencion'];
                
		$this->render('update',array(
			'model'=>$model,
                        'tipo'=>$tipo,
                        'conf'=>$conf,
                        'lineas'=>$lineas,
                        'tipo'=>$tipo,
                        'bodega'=>$bodega,
                        'impuesto'=>$impuesto,
                        'retencion'=>$retencion,
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
		$dataProvider=new CActiveDataProvider('Articulo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Articulo('search');
		$model->unsetAttributes();  // clear any default values
                
		if(isset($_GET['Articulo']))
			$model->attributes=$_GET['Articulo'];
                
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
		$model=Articulo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='articulo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionCargar() {
                $var = $_POST['ClasificacionAdiValor'];
		$data=  ClasificacionAdiValor::model()->findAll('CLASIFICACION = '.$var);
               
               $data=CHtml::listData($data,'ID','VALOR');
               echo "<option value=''>Seleccione</option>";
               foreach($data as $value=>$name)
               {
                       echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
               }
	}
        
        public function actionCargarAjax(){
                    $bus = Impuesto::model()->findByPk($_POST['Articulo']['IMPUESTO_COMPRA']);
                   if($bus)
                        echo CHtml::tag('input',array('disabled'=>true,'id'=>'IMPUESTO2','name'=>'IMPUESTO2','value'=>$bus->NOMBRE));  
                   else
                       echo CHtml::tag('input',array('disabled'=>true,'id'=>'IMPUESTO2','name'=>'IMPUESTO2','value'=>'Ninguno'));
        } 
        
        public function actionCargarAjax2(){
            
              $bus = Bodega::model()->findByPk($_POST['Articulo']['BODEGA']);
              if($bus)
                   echo CHtml::tag('input',array('disabled'=>true,'id'=>'BODEGA2','name'=>'BODEGA2','value'=>$bus->DESCRIPCION));  
               else
                  echo CHtml::tag('input',array('disabled'=>true,'id'=>'BODEGA2','name'=>'BODEGA2','value'=>'Ninguno'));

           
        }
        
        public function actionCargarAjax3(){
            
              $bus = Impuesto::model()->findByPk($_POST['Articulo']['IMPUESTO_VENTA']);
                   if($bus)
                        echo CHtml::tag('input',array('disabled'=>true,'id'=>'IMPUESTO3','name'=>'IMPUESTO3','value'=>$bus->NOMBRE));  
                   else
                       echo CHtml::tag('input',array('disabled'=>true,'id'=>'IMPUESTO3','name'=>'IMPUESTO3','value'=>'Ninguno'));
        } 
        
        public function actionCargarAjax4(){
            
              $bus = Retencion::model()->findByPk($_POST['Articulo']['RETENCION_VENTA']);
                   if($bus)
                        echo CHtml::tag('input',array('disabled'=>true,'id'=>'RETENCION2','name'=>'RETENCION2','value'=>$bus->NOMBRE));  
                   else
                       echo CHtml::tag('input',array('disabled'=>true,'id'=>'RETENCION2','name'=>'RETENCION2','value'=>'Ninguno'));
        } 
        public function actionCargarAjax5(){
                        
             $bus = Retencion::model()->findByPk($_POST['Articulo']['RETENCION_COMPRA']);
             if($bus)
                 echo CHtml::tag('input',array('disabled'=>true,'id'=>'RETENCION3','name'=>'RETENCION3','value'=>$bus->NOMBRE));  
             else
                echo CHtml::tag('input',array('disabled'=>true,'id'=>'RETENCION3','name'=>'RETENCION3','value'=>'Ninguno'));
        } 
        
        public function actionCargararticulo(){
            $item_id = (int)$_GET['id'];
            $bus = Articulo::model()->findByPk($item_id);

            $res = array(
                 'ID'=>$bus->ARTICULO,
                 'NOMBRE'=>$bus->NOMBRE,
            );

            echo CJSON::encode($res);
        }
}
