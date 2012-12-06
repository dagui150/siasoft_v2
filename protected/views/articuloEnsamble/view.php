<?php
/* @var $this ArticuloEnsambleController */
/* @var $model ArticuloEnsamble */

$this->breadcrumbs=array(
	'Articulo Ensambles'=>array('index'),
	$model->ID,
);
?>

<h1>View ArticuloEnsamble #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ARTICULO_PADRE',
		'ARTICULO_HIJO',
		'CANTIDAD',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
