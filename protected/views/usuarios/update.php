<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h1>Actualizar Usuario <?php echo $model2->USERNAME; ?></h1>

<?php echo $this->renderPartial('_form2', array('model2'=>$model2)); ?>