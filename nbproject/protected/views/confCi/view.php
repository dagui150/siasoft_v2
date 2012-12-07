<?php
$this->breadcrumbs=array(
	'Conf Cis'=>array('admin'),
	$model->ID,
);
?>

<h1>Ver ConfCi #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'COSTOS_DEC',
		'EXISTENCIAS_DEC',
		'PESOS_DEC',
		'COSTO_FISCAL',
		'COSTO_COMPARATIVO',
		'COSTO_INGR_DEFAULT',
		'UNIDAD_PESO',
		'UNIDAD_VOLUMEN',
		'EXIST_EN_TOTALES',
		'NOMBRE_CLASIF_1',
		'NOMBRE_CLASIF_2',
		'NOMBRE_CLASIF_3',
		'NOMBRE_CLASIF_4',
		'NOMBRE_CLASIF_5',
		'NOMBRE_CLASIF_6',
		'INTEGRACION_CONTA',
		'USA_CODIGO_BARRAS',
		'LINEAS_MAX_TRANS',
		'USA_UNIDADES_DIST',
		'ASISTENCIA_AUTOMAT',
		'USA_CODIGO_EAN13',
		'USA_CODIGO_EAN8',
		'USA_CODIGO_UCC12',
		'USA_CODIGO_UCC8',
		'EAN13_REGLA_LOCAL',
		'EAN8_REGLA_LOCAL',
		'UCC12_REGLA_LOCAL',
		'PRIORIDAD_BUSQUEDA',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
