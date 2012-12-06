<?php
/* @var $this ArticuloPrecioController */
/* @var $model ArticuloPrecio */

$this->breadcrumbs=array(
	'Articulo Precios'=>array('index'),
	$model->ID,
);

?>

<h1>View ArticuloPrecio #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ARTICULO',
		'NIVEL_PRECIO',
		'PRECIO',
		'ESQUEMA_TRABAJO',
		'MARGEN_MULTIPLICADOR',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
