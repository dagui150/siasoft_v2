<?php
$this->breadcrumbs=array(
	'Metodo Valuacion Invs'=>array('admin'),
	$model->ID,
);

?>

<h1>Ver MetodoValuacionInv #<?php echo $model->ID; ?></h1>

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
