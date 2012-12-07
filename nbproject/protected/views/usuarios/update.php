<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h4>Actualizar Usuario <?php echo $model2->USERNAME; ?></h4>

<?php echo $this->renderPartial('_form2', array('model2'=>$model2)); ?>