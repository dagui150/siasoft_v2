<?php
$this->breadcrumbs=array(
	'Tipo Cuentas'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar TipoCuenta', 'url'=>array('index')),
	array('label'=>'Crear TipoCuenta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tipo-cuenta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Tipo Cuentas</h1>

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
	'id'=>'tipo-cuenta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'TIPO_CUENTA',
		'DESCRIPCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		/*
		'ACTUALIZADO_EL',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
