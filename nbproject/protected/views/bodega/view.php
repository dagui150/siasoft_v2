<?php
$this->breadcrumbs=array(
	'Bodegas'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Bodega', 'url'=>array('index')),
	array('label'=>'Create Bodega', 'url'=>array('create')),
	array('label'=>'Update Bodega', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Bodega', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bodega', 'url'=>array('admin')),
);
?>

<h1>Ver Bodega # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'TIPO',
		'TELEFONO',
		'DIRECCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
