<?php
$this->breadcrumbs=array(
	'Departamentos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List Departamento', 'url'=>array('index')),
	array('label'=>'Manage Departamento', 'url'=>array('admin')),
);
?>

<h1>Crear Departamento</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>