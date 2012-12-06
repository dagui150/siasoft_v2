<?php
$this->breadcrumbs=array(
	'Bodegas'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Update',
);


?>

<h1>Actualizar Bodega <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>