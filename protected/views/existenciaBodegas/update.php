<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Actualizar',
);

?>

<h1>Actualizar Pedido <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,
			'bodega'=>$bodega,
			'linea'=>$linea,
			'articulo'=>$articulo,
			'modelLinea'=>$modelLinea,
			'countLineas'=>$countLineas,
			'ruta'=>$ruta,
                        'ruta2'=>$ruta2)); ?>