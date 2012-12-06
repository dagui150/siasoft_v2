<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */

$this->breadcrumbs=array(
	'Ingreso Compra Líneas'=>array('index'),
	Yii::t('app','MANAGE').'',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' IngresoCompraLinea', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' IngresoCompraLinea', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ingreso-compra-linea-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Ingreso Compra Líneas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ingreso-compra-linea-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'INGRESO_COMPRA_LINEA',
		'INGRESO_COMPRA',
		'LINEA_NUM',
		'ORDEN_COMPRA_LINEA',
		'ARTICULO',
		'BODEGA',
		/*
		'CANTIDAD_ORDENADA',
		'UNIDAD_ORDENADA',
		'CANTIDAD_ACEPTADA',
		'CANTIDAD_RECHAZADA',
		'PRECIO_UNITARIO',
		'COSTO_FISCAL_UNITARIO',
		'ACTIVO',
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
