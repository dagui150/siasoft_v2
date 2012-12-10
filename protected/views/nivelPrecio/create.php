<?php
$this->breadcrumbs=array(
	'Nivel Precio'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List NivelPrecio', 'url'=>array('index')),
	array('label'=>'Manage NivelPrecio', 'url'=>array('admin')),
);
?>

<h1>Crear Nivel Precio</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>