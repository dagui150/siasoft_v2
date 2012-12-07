<?php
$this->breadcrumbs=array(
	'Unidad Medidas'=>array('admin'),
	$model->ID,
);
?>

<h1>Ver UnidadMedida #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'ABREVIATURA',
		'TIPO',
		'uNIDADBASE.NOMBRE',
		'EQUIVALENCIA',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
