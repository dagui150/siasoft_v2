<?php
/* @var $this RegimenTributarioController */
/* @var $model RegimenTributario */

$this->breadcrumbs=array(
	'Regimen Tributarios'=>array('index'),
	$model->REGIMEN,
);

$this->menu=array(
	array('label'=>'List RegimenTributario', 'url'=>array('index')),
	array('label'=>'Create RegimenTributario', 'url'=>array('create')),
	array('label'=>'Update RegimenTributario', 'url'=>array('update', 'id'=>$model->REGIMEN)),
	array('label'=>'Delete RegimenTributario', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->REGIMEN),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage RegimenTributario', 'url'=>array('admin')),
);
?>

<h1>View RegimenTributario #<?php echo $model->REGIMEN; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'REGIMEN',
		'DESCRIPCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
