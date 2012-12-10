<?php
/* @var $this IngresoCompraController */
/* @var $model IngresoCompra */

$this->breadcrumbs=array(
	'Ingreso Compras'=>array('admin'),
	'Ingreso Compras',
);

$this->menu=array(
	array('label'=>'List IngresoCompra', 'url'=>array('index')),
	array('label'=>'Manage IngresoCompra', 'url'=>array('admin')),
);
?>

<h1>Ingreso de Compra</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'proveedor'=>$proveedor, 'config'=>$config, 'linea'=>$linea, 'articulo'=>$articulo, 'ordenLinea'=>$ordenLinea, 'ruta'=>$ruta, 'dataProviderOrdenes' => $dataProviderOrdenes)); ?>