<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 2'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List UbicacionGeografica2', 'url'=>array('index')),
	array('label'=>'Manage UbicacionGeografica2', 'url'=>array('admin')),
);
?>

<h1>Crear Ubicacion Geografica 2</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>