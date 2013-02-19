<?php

class ReportesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2'; 
	/**
	 * @return array action filters
	 */
	public function filters(){
            return array(
                array('CrugeAccessControlFilter'),
            );
          }
          
        public function actionExcel()
	{
            $model = new CArrayDataProvider(Yii::app()->getSession()->get('reportes'));
            switch ($_GET['tipo']){
                case 'ventas':
                    $this->render('excelVentas',array(
                        'model' => $model,
                    ));
                    break;
                case 'inventario':
                    $this->render('excelInventario',array(
                        'model' => $model,
                    ));
                    break;
                case 'compras':
                    $this->render('excelCompras',array(
                        'model' => $model,
                    ));
                    break;
            }
	}
          
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ventas' page.
	 */
	public function actionVentas()
	{
                $provider=new CActiveDataProvider(Factura::model(), array(
			'criteria'=>array(
                                'condition'=>' FACTURA=-1',
                         ),
                         
		));
                
                
                if(isset($_GET['Reportes']['FECHA_DESDE'])){
                    $provider->keyAttribute = 'FACTURA';
                    $provider->criteria = array(
                                'select' => 't.FACTURA, t.CONSECUTIVO, t.CLIENTE, t.FECHA_FACTURA, t.TOTAL_A_FACTURAR, t.BODEGA, t.NIVEL_PRECIO',
                                'condition'=>'t.FECHA_FACTURA BETWEEN "'.$_GET['Reportes']['FECHA_DESDE'].'" AND "'.$_GET['Reportes']['FECHA_HASTA'].'"',
                );
                    
                if(isset($_GET['Reportes']['BODEGAS']))
                    $provider->criteria->compare('t.BODEGA',$_GET['Reportes']['BODEGAS']);
                    
                if(isset($_GET['Reportes']['CLIENTES']))
                    $provider->criteria->compare('t.CLIENTE',$_GET['Reportes']['CLIENTES']);
                }
                $model=new Reportes;                
		$this->render('ventas',array(
			'model'=>$model,
                        'provider'=> $provider
		));
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ventas' page.
	 */
	public function actionInventario()
	{
                $provider=new CActiveDataProvider(Articulo::model(), array(
			'criteria'=>array(
                                'condition'=>'ARTICULO=-1',
                         ),
                    'pagination'=>false
		));
                
                $provider->keyAttribute = 'ARTICULO';
                $provider->criteria = array(
                                'select' => 't.ARTICULO, t.NOMBRE, t.EXISTENCIA_MINIMA, t.EXISTENCIA_MAXIMA, eb.BODEGA, t.UNIDAD_ALMACEN, eb.CANT_DISPONIBLE',
                                'join' => 'LEFT JOIN existencia_bodega eb ON t.ARTICULO = eb.ARTICULO',
                );
                
                
                if(isset($_GET['Reportes']['BODEGAS']))
                    $provider->criteria->compare('eb.BODEGA',$_GET['Reportes']['BODEGAS']);
                    
                if(isset($_GET['Reportes']['TIPO_ARTICULOS']))
                    $provider->criteria->compare('t.TIPO_ARTICULO',$_GET['Reportes']['TIPO_ARTICULOS']);
                
                if(isset($_GET['Reportes']['ARTICULOS_ACTIVO']))
                    $provider->criteria->compare('t.ACTIVO',$_GET['Reportes']['ARTICULOS_ACTIVO']);
                
                $provider->sort =array(
                            'attributes'=>
                                array(
                                    'ARTICULO',
                                    'NOMBRE',
                                    'EXISTENCIA_MINIMA',
                                    'EXISTENCIA_MAXIMA',
                                    'BODEGA',
                                    'UNIDAD_ALMACEN',
                                    'CANT_DISPONIBLE'=>array(
                                        'asc'=>'eb.CANT_DISPONIBLE',
                                        'desc'=>'eb.CANT_DISPONIBLE DESC',
                                        'label'=>'Cant. Disp.',
                                        'default'=>'asc',
                                    ),
                                ),
                        );
                
                $model=new Reportes;
		$this->render('inventario',array(
			'model'=>$model,
                        'provider'=>$provider,
		));
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ordenCompra' page.
	 */
	public function actionOrdenCompra()
	{
                $provider=new CActiveDataProvider(OrdenCompra::model(), array(
			'criteria'=>array(
                                'condition'=>'ORDEN_COMPRA=-1',
                         ),
                    'pagination'=>false
		));
                
                $provider->keyAttribute = 'ORDEN_COMPRA';
                $provider->criteria = array(
                                'select' => 't.ORDEN_COMPRA, t.PROVEEDOR, t.FECHA, t.BODEGA, t.PRIORIDAD, t.CONDICION_PAGO, t.TOTAL_A_COMPRAR',
                );
                
                
                if(isset($_GET['Reportes']['BODEGAS']))
                    $provider->criteria->compare('eb.BODEGA',$_GET['Reportes']['BODEGAS']);
                    
                if(isset($_GET['Reportes']['TIPO_ARTICULOS']))
                    $provider->criteria->compare('t.TIPO_ARTICULO',$_GET['Reportes']['TIPO_ARTICULOS']);
                
                if(isset($_GET['Reportes']['ARTICULOS_ACTIVO']))
                    $provider->criteria->compare('t.ACTIVO',$_GET['Reportes']['ARTICULOS_ACTIVO']);
                
                $model=new Reportes;
		$this->render('ordenCompra',array(
			'model'=>$model,
                        'provider'=>$provider
		));
	}
        
        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ConfAs::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='reportes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
