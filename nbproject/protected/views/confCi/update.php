<?php
$this->breadcrumbs=array(
	'Configuracion Inventario'=>array('admin'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);
?>

<?php echo $this->renderPartial('_form2', array('model'=>$model)); ?>