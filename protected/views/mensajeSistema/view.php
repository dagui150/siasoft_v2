<?php
/* @var $this MensajeSistemaController */
/* @var $model MensajeSistema */

$this->breadcrumbs=array(
	'Mensaje Sistemas'=>array('index'),
	$model->CODIGO,
);

$this->menu=array(
	array('label'=>'List MensajeSistema', 'url'=>array('index')),
	array('label'=>'Create MensajeSistema', 'url'=>array('create')),
	array('label'=>'Update MensajeSistema', 'url'=>array('update', 'id'=>$model->CODIGO)),
	array('label'=>'Delete MensajeSistema', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CODIGO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MensajeSistema', 'url'=>array('admin')),
);
?>

<h1>View MensajeSistema #<?php echo $model->CODIGO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CODIGO',
		'TIPO',
		'MENSAJE',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
