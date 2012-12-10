<?php
$this->breadcrumbs=array(
	'Articulo Multimedias'=>array('admin'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

?>

<h1>Actualizar Articulo Multimedia <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>