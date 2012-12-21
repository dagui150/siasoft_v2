<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Actualizar',
);

?>

<h1>Actualizar Pedido <?php echo $model->PEDIDO; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
			'bodega'=>$bodega,
			'cliente'=>$cliente,
			'condicion'=>$condicion,
			'linea'=>$linea,
			'articulo'=>$articulo,
			'modelLinea'=>$modelLinea,
			'countLineas'=>$countLineas,
			'ruta'=>$ruta,
                        'ruta2'=>$ruta2)); ?>