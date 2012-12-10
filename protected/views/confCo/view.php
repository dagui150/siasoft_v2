<?php
$this->breadcrumbs=array(
	'Configuracion Compras'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List ConfCo', 'url'=>array('index')),
	array('label'=>'Create ConfCo', 'url'=>array('create')),
	array('label'=>'Update ConfCo', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete ConfCo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConfCo', 'url'=>array('admin')),
);
?>

<h1>Ver Configuracion de Compras # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'BODEGA_DEFAULT',
		'ULT_SOLICITUD',
		'ULT_ORDEN_COMPRA',
		'ULT_EMBARQUE',
		'ULT_SOLICITUD_M',
		'ULT_ORDEN_COMPRA_M',
		'ULT_EMBARQUE_M',
		'ULT_DEVOLUCION',
		'ULT_DEVOLUCION_M',
		'USAR_RUBROS',
		'ORDEN_OBSERVACION',
		'MAXIMO_LINORDEN',
		'POR_VARIAC_COSTO',
		'CP_EN_LINEA',
		'IMP1_AFECTA_DESCTO',
		'FACTOR_REDONDEO',
		'PRECIO_DEC',
		'CANTIDAD_DEC',
		'PEDIDOS_SOLICITUD',
		'PEDIDOS_ORDEN',
		'PEDIDOS_EMBARQUE',
		'DIRECCION_EMBARQUE',
		'DIRECCION_COBRO',
		'RUBRO1_SOLNOM',
		'RUBRO2_SOLNOM',
		'RUBRO3_SOLNOM',
		'RUBRO4_SOLNOM',
		'RUBRO5_SOLNOM',
		'RUBRO1_EMBNOM',
		'RUBRO2_EMBNOM',
		'RUBRO3_EMBNOM',
		'RUBRO4_EMBNOM',
		'RUBRO5_EMBNOM',
		'RUBRO1_ORDNOM',
		'RUBRO2_ORDNOM',
		'RUBRO3_ORDNOM',
		'RUBRO4_ORDNOM',
		'RUBRO5_ORDNOM',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
