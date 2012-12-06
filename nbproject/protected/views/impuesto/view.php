<?php
$this->breadcrumbs=array(
	'Impuestos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Listar Impuesto', 'url'=>array('index')),
	array('label'=>'Crear Impuesto', 'url'=>array('create')),
	array('label'=>'Actualizar Impuesto', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Eliminar Impuesto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar Impuesto', 'url'=>array('admin')),
);
?>

<h1>Ver Impuesto #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'procentaje',
		'activo',
		'creado_por',
		'creado_el',
		'actualizado_por',
		'actualizado_el',
	),
)); ?>
