<?php
$this->breadcrumbs=array(
	'Nit'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Nit', 'url'=>array('index')),
	array('label'=>'Create Nit', 'url'=>array('create')),
	array('label'=>'Update Nit', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Nit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Nit', 'url'=>array('admin')),
);
?>

<h1>Ver Nit # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'TIIPO_DOCUMENTO',
		'RAZON_SOCIAL',
		'ALIAS',
		'OBSERVACIONES',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
