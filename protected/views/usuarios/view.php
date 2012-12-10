<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	$model->ID,
);

?>

<h1>Ver Usuarios #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'USERNAME',
		'PASS',
		'ACTIVO',
	),
)); ?>
