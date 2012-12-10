<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Valores - Clasificaciones'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h1>Actualizar Valor-Clasificación "<?php echo $model2->VALOR; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>