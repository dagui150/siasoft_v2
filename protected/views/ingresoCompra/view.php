<?php
/* @var $this IngresoCompraController */
/* @var $model IngresoCompra */

$this->breadcrumbs=array(
	'Ingreso Compras'=>array('index'),
	$model->INGRESO_COMPRA,
);

$this->menu=array(
	array('label'=>'List IngresoCompra', 'url'=>array('index')),
	array('label'=>'Create IngresoCompra', 'url'=>array('create')),
	array('label'=>'Update IngresoCompra', 'url'=>array('update', 'id'=>$model->INGRESO_COMPRA)),
	array('label'=>'Delete IngresoCompra', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->INGRESO_COMPRA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage IngresoCompra', 'url'=>array('admin')),
);
?>

<h1>View IngresoCompra #<?php echo $model->INGRESO_COMPRA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'INGRESO_COMPRA',
		'PROVEEDOR',
		'FECHA_INGRESO',
		'TIENE_FACTURA',
		'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'NOTAS',
		'ESTADO',
		'APLICADO_POR',
		'APLICADO_EL',
		'CANCELADO_POR',
		'CANCELADO_EL',
		'CREADO_POR',
		'CREADO_EL',
		'MODIFICADO_POR',
		'MODIFICADO_EL',
	),
)); ?>
