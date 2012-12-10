<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	$model->PROVEEDOR,
);

$this->menu=array(
	array('label'=>'List Proveedor', 'url'=>array('index')),
	array('label'=>'Create Proveedor', 'url'=>array('create')),
	array('label'=>'Update Proveedor', 'url'=>array('update', 'id'=>$model->PROVEEDOR)),
	array('label'=>'Delete Proveedor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->PROVEEDOR),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Proveedor', 'url'=>array('admin')),
);
?>

<h1>Ver Proveedor # <?php echo $model->PROVEEDOR; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'PROVEEDOR',
		'CATEGORIA',
		'NOMBRE',
		'ALIAS',
		'CONTACTO',
		'CARGO',
		'DIRECCION',
		'EMAIL',
		'FECHA_INGRESO',
		'TELEFONO1',
		'TELEFONO2',
		'FAX',
		'NIT',
		'CONDICION_PAGO',
		'ACTIVO',
		'ORDEN_MINIMA',
		'DESCUENTO',
		'TASA_INTERES_MORA',
	),
)); ?>
