<?php
/* @var $this IngresoCompraController */
/* @var $model IngresoCompra */

$this->breadcrumbs=array(
	'Ingreso Compras'=>array('index'),
	$model->INGRESO_COMPRA=>array('view','id'=>$model->INGRESO_COMPRA),
	'Update',
);

$this->menu=array(
	array('label'=>'List IngresoCompra', 'url'=>array('index')),
	array('label'=>'Create IngresoCompra', 'url'=>array('create')),
	array('label'=>'View IngresoCompra', 'url'=>array('view', 'id'=>$model->INGRESO_COMPRA)),
	array('label'=>'Manage IngresoCompra', 'url'=>array('admin')),
);
?>

<h1>Update IngresoCompra <?php echo $model->INGRESO_COMPRA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>