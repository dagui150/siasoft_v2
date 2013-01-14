<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Bodegas'=>array('inventario'),
	'Bodega '.$model->ID,
);

?>

<h1>Asociación de artículos a Bodegas - Bodega <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('form_articulos', array('model'=>$model,
			'bodega'=>$bodega,
			'linea'=>$linea,
                        'linea22'=>$linea22,
			'articulo'=>$articulo,
			'modelLinea'=>$modelLinea,
			'countLineas'=>$countLineas,
			'ruta'=>$ruta,
                        'ruta2'=>$ruta2)); ?>