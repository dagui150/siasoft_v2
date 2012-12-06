<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 1'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List UbicacionGeografica1', 'url'=>array('index')),
	array('label'=>'Create UbicacionGeografica1', 'url'=>array('create')),
	array('label'=>'Update UbicacionGeografica1', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete UbicacionGeografica1', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UbicacionGeografica1', 'url'=>array('admin')),
);
?>

<h1>Ver Ubicacion Geografica 1 # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'pAIS.NOMBRE',
		'NOMBRE',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
