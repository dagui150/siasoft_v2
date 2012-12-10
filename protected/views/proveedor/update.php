<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	$model->PROVEEDOR=>array('view','id'=>$model->PROVEEDOR),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'List Proveedor', 'url'=>array('index')),
	array('label'=>'Create Proveedor', 'url'=>array('create')),
	array('label'=>'View Proveedor', 'url'=>array('view', 'id'=>$model->PROVEEDOR)),
	array('label'=>'Manage Proveedor', 'url'=>array('admin')),
);
?>

<h1>Actualizar Proveedor <?php echo $model->PROVEEDOR; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'cuenta'=>$cuenta, 'nit'=>$nit)); ?>