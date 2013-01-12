<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Actualizar',
);

?>

<h1>Actualizar Pedido <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('form_articulos', array('model'=>$model,
			'bodega'=>$bodega,
			'linea'=>$linea,
                        'linea22'=>$linea22,
			'articulo'=>$articulo,
			'modelLinea'=>$modelLinea,
			'countLineas'=>$countLineas,
			'ruta'=>$ruta,
                        'ruta2'=>$ruta2)); ?>