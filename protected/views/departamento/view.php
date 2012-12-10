<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List Departamento', 'url'=>array('index')),
	array('label'=>'Create Departamento', 'url'=>array('create')),
	array('label'=>'Update Departamento', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Departamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Departamento', 'url'=>array('admin')),
);
?>

<h1>Ver Departamento # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
