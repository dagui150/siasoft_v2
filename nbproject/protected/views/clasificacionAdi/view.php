<?php
$this->breadcrumbs=array(
	'Clasificacion Adis'=>array('admin'),
	$model->ID,
);

?>

<h1>Ver ClasificacionAdi #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'POSICION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
