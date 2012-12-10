<?php
$this->breadcrumbs=array(
	'Existencia Bodegas'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar ExistenciaBodega', 'url'=>array('index')),
	array('label'=>'Crear ExistenciaBodega', 'url'=>array('create')),
	array('label'=>'Actualizar ExistenciaBodega', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar ExistenciaBodega', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar ExistenciaBodega', 'url'=>array('admin')),
);
?>

<h1>Ver ExistenciaBodega #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ARTICULO',
		'BODEGA',
		'EXISTENCIA_MINIMA',
		'EXISTENCIA_MAXIMA',
		'PUNTO_REORDEN',
		'CANT_DISPONIBLE',
		'CANT_RESERVADA',
		'CANT_REMITIDA',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
