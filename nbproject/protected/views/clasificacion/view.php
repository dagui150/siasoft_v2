<?php
$this->breadcrumbs=array(
	'Clasificacions'=>array('admin'),
	$model->ID,
);

?>

<h1>Ver Clasificacion #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'AGRUPACION',
		'uNIDAD.NOMBRE',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
