<?php
$this->breadcrumbs=array(
	'Clasificacion Adi Valors'=>array('admin'),
	$model->ID,
);
?>

<h1>Ver ClasificacionAdiValor #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'cLASIFICACION.NOMBRE',
		'VALOR',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
