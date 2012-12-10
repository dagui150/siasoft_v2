<?php
$this->breadcrumbs=array(
	'Orden Compras'=>array('index'),
	$model->ORDEN_COMPRA,
);

$this->menu=array(
	array('label'=>'Listar OrdenCompra', 'url'=>array('index')),
	array('label'=>'Crear OrdenCompra', 'url'=>array('create')),
	array('label'=>'Actualizar OrdenCompra', 'url'=>array('update', 'id'=>$model->ORDEN_COMPRA)),
	array('label'=>'Eliminar OrdenCompra', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ORDEN_COMPRA),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar OrdenCompra', 'url'=>array('admin')),
);
?>

<h1>Ver OrdenCompra #<?php echo $model->ORDEN_COMPRA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ORDEN_COMPRA',
		'PROVEEDOR',
		'FECHA',
		'BODEGA',
		'DEPARTAMENTO',
		'FECHA_COTIZACION',
		'FECHA_OFRECIDA',
		'FECHA_REQUERIDA',
		'FECHA_REQ_EMBARQUE',
		'PRIORIDAD',
		'CONDICION_PAGO',
		'DIRECCION_EMBARQUE',
		'DIRECCION_COBRO',
		'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'COMENTARIO_CXP',
		'INSTRUCCIONES',
		'OBSERVACIONES',
		'PORC_DESCUENTO',
		'MONTO_FLETE',
		'MONTO_SEGURO',
		'MONTO_ANTICIPO',
		'TIPO_PRORRATEO_OC',
		'TOTAL_A_COMPRAR',
		'USUARIO_CANCELA',
		'FECHA_CANCELA',
		'ESTADO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
