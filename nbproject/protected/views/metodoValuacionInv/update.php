<?php
$this->breadcrumbs=array(
	'Metodo Valuacion Invs'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);
?>

<h1>Actualizar MetodoValuacion <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>