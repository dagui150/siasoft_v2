<?php
$this->breadcrumbs=array(
	'Bodegas'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List Bodega', 'url'=>array('index')),
	array('label'=>'Manage Bodega', 'url'=>array('admin')),
);
?>

<h1>Crear Bodega</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>