<?php
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Facturas'
);
?>

<h1>Facturas</h1>


<div align="right">
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('create'),
	'icon' => 'plus white'
)); 

?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'factura-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'FACTURA',
		'CLIENTE',
		'BODEGA',
		'CONDICION_PAGO',
		'NIVEL_PRECIO',
		'PEDIDO',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
