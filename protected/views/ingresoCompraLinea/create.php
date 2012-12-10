<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */

$this->breadcrumbs=array(
	'Ingreso Compra Lineas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IngresoCompraLinea', 'url'=>array('index')),
	array('label'=>'Manage IngresoCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Create IngresoCompraLinea</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>