<?php
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Facturas'=>array('admin'),
	$model->FACTURA,
);

?>

<h1>Ver Factura #<?php echo $model->FACTURA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'FACTURA',
		'CLIENTE',
		'BODEGA',
		'CONDICION_PAGO',
		'NIVEL_PRECIO',
		'PEDIDO',
		'FECHA_FACTURA',
		'FECHA_DESPACHO',
		'FECHA_ENTREGA',
		'ORDEN_COMPRA',
		'FECHA_ORDEN',
		'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'COMENTARIOS_CXC',
		'OBSERVACIONES',
		'TOTAL_MERCADERIA',
		'MONTO_ANTICIPO',
		'MONTO_FLETE',
		'MONTO_SEGURO',
		'MONTO_DESCUENTO1',
		'TOTAL_IMPUESTO1',
		'TOTAL_A_FACTURAR',
		'REMITIDO',
		'RESERVADO',
		'ESTADO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
