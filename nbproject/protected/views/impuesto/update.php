<?php
$this->breadcrumbs=array(
	'Impuestos'=>array('index'),
	$model2->id=>array('admin'),
	'Actualizar',
);

?>

<h1>Actualizar Impuesto <?php echo $model2->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>