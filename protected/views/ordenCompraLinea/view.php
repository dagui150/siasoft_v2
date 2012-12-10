<?php
$this->breadcrumbs=array(
	'Orden Compra Lineas'=>array('index'),
	$model->ORDEN_COMPRA_LINEA,
);

$this->menu=array(
	array('label'=>'Listar OrdenCompraLinea', 'url'=>array('index')),
	array('label'=>'Crear OrdenCompraLinea', 'url'=>array('create')),
	array('label'=>'Actualizar OrdenCompraLinea', 'url'=>array('update', 'id'=>$model->ORDEN_COMPRA_LINEA)),
	array('label'=>'Eliminar OrdenCompraLinea', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ORDEN_COMPRA_LINEA),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar OrdenCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Ver OrdenCompraLinea #<?php echo $model->ORDEN_COMPRA_LINEA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ORDEN_COMPRA_LINEA',
		'ORDEN_COMPRA',
		'LINEA_NUM',
		'ARTICULO',
		'DESCRIPCION',
		'BODEGA',
		'FECHA_REQUERIDA',
		'FACTURA',
		'CANTIDAD_ORDENADA',
		'UNIDAD_COMPRA',
		'PRECIO_UNITARIO',
		'PORC_DESCUENTO',
		'MONTO_DESCUENTO',
		'VALOR_IMPUESTO',
		'CANTIDAD_RECIBIDA',
		'CANTIDAD_RECHAZADA',
		'FECHA',
		'OBSERVACION',
		'ESTADO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
