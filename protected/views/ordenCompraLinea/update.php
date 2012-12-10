<?php
$this->breadcrumbs=array(
	'Orden Compra Lineas'=>array('index'),
	$model->ORDEN_COMPRA_LINEA=>array('view','id'=>$model->ORDEN_COMPRA_LINEA),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar OrdenCompraLinea', 'url'=>array('index')),
	array('label'=>'Crear OrdenCompraLinea', 'url'=>array('create')),
	array('label'=>'Ver OrdenCompraLinea', 'url'=>array('view', 'id'=>$model->ORDEN_COMPRA_LINEA)),
	array('label'=>'Administrar OrdenCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Actualizar OrdenCompraLinea <?php echo $model->ORDEN_COMPRA_LINEA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>