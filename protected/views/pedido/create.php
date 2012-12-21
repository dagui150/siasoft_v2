<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Pedido', 'url'=>array('index')),
	array('label'=>'Manage Pedido', 'url'=>array('admin')),
);
?>

<h1>Create Pedido</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'bodega'=>$bodega, 'condicion'=>$condicion, 'linea'=>$linea, 'modelLinea'=>$modelLinea, 'ruta2'=>$ruta2, 'cliente'=>$cliente, 'articulo'=>$articulo, 'ruta'=>$ruta)); ?>