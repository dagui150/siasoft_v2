<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */

$this->breadcrumbs=array(
	'Ingreso Compra Lineas'=>array('index'),
	$model->INGRESO_COMPRA_LINEA=>array('view','id'=>$model->INGRESO_COMPRA_LINEA),
	'Update',
);

$this->menu=array(
	array('label'=>'List IngresoCompraLinea', 'url'=>array('index')),
	array('label'=>'Create IngresoCompraLinea', 'url'=>array('create')),
	array('label'=>'View IngresoCompraLinea', 'url'=>array('view', 'id'=>$model->INGRESO_COMPRA_LINEA)),
	array('label'=>'Manage IngresoCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Update IngresoCompraLinea <?php echo $model->INGRESO_COMPRA_LINEA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>