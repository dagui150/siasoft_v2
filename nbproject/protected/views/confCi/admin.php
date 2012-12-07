<?php
$this->breadcrumbs=array(
	'Configuracion Inventario'=>array('admin'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('conf-ci-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'conf-ci-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'COSTOS_DEC',
		'EXISTENCIAS_DEC',
		'PESOS_DEC',
		'COSTO_FISCAL',
		'COSTO_COMPARATIVO',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view} {update}'
		),
	),
)); ?>
