<?php
$this->breadcrumbs=array(
	'Articulo Proveedores'=>array('admin'),
	$model->ID,
);
?>

<h1>Ver ArticuloProveedor #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ARTICULO',
		'PROVEEDOR',
		'CODIGO_CATALOGO',
		'NOMBRE_CATALOGO',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
