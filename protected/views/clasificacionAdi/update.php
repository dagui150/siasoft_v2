<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Clasificaciones'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h1>Actualizar Clasificacion "<?php echo $model2->NOMBRE; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>