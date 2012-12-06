<?php
$this->breadcrumbs=array(
	'Nits'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List Nit', 'url'=>array('index')),
	array('label'=>'Manage Nit', 'url'=>array('admin')),
);
?>

<h1>Crear Nit</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>