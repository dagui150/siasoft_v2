<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */

$this->breadcrumbs=array(
	'Ingreso Compra Líneas'=>array('index'),
	$model->INGRESO_COMPRA_LINEA,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' IngresoCompraLinea', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' IngresoCompraLinea', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' IngresoCompraLinea', 'url'=>array('update', 'id'=>$model->INGRESO_COMPRA_LINEA)),
	array('label'=>Yii::t('app','DELETE').' IngresoCompraLinea', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->INGRESO_COMPRA_LINEA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' IngresoCompraLinea', 'url'=>array('admin')),
);
?>

<h1>View IngresoCompraLinea #<?php echo $model->INGRESO_COMPRA_LINEA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'INGRESO_COMPRA_LINEA',
		'INGRESO_COMPRA',
		'LINEA_NUM',
		'ORDEN_COMPRA_LINEA',
		'ARTICULO',
		'BODEGA',
		'CANTIDAD_ORDENADA',
		'UNIDAD_ORDENADA',
		'CANTIDAD_ACEPTADA',
		'CANTIDAD_RECHAZADA',
		'PRECIO_UNITARIO',
		'COSTO_FISCAL_UNITARIO',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
