<?php
$this->breadcrumbs=array(
	'Zonas'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Zona', 'url'=>array('index')),
	array('label'=>'Create Zona', 'url'=>array('create')),
	array('label'=>'Update Zona', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Zona', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Zona', 'url'=>array('admin')),
);
?>

<h1>Ver Zona # <?php echo $model->ID; ?></h1>

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
