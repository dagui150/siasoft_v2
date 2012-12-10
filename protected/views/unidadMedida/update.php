<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Unidad Medidas'=>array('admin'),
	$model2->NOMBRE=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h1>Actualizar UnidadMedida "<?php echo $model2->NOMBRE; ?>" </h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>