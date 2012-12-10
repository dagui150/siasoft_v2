<?php
$this->breadcrumbs=array(
	'Orden Compra Lineas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar OrdenCompraLinea', 'url'=>array('index')),
	array('label'=>'Crear OrdenCompraLinea', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('orden-compra-linea-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Orden Compra Lineas</h1>

<p>
Si lo desea, puede entrar en un operador de comparacion (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al comienzo de cada uno de los valores de su busqueda para especificar como la comparacion se debe hacer.
</p>

<?php echo CHtml::link('Busqueda Avazada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orden-compra-linea-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ORDEN_COMPRA_LINEA',
		'ORDEN_COMPRA',
		'LINEA_NUM',
		'ARTICULO',
		'DESCRIPCION',
		'BODEGA',
		/*
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
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
