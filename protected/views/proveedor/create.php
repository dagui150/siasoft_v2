<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List Proveedor', 'url'=>array('index')),
	array('label'=>'Manage Proveedor', 'url'=>array('admin')),
);
?>

<h1>Crear Proveedor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'cuenta'=>$cuenta, 'nit'=>$nit)); ?>