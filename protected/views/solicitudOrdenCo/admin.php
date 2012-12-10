<?php $this->pageTitle=Yii::app()->name." - Solicitud Orden Compra";?>
<?php
$this->breadcrumbs=array(
	'Solicitud Orden Compra'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOrdenCo', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOrdenCo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('solicitud-orden-co-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Solicitud Orden Compra</h1>

<p>
Si lo desea, puede entrar en un operador de comparacion (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al comienzo de cada uno de los valores de su busqueda para especificar como la comparacion se debe hacer.
</p>

<?php echo CHtml::link('Búsqueda Avazada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'solicitud-orden-co-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'SOLICITUD_OC',
		'SOLICITUD_OC_LINEA',
		'ORDEN_COMPRA',
		'ORDEN_COMPRA_LINEA',
		'DECIMA',
		/*
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
