<?php
$this->breadcrumbs=array(
	'Configuracion de Compras'=>array('index'),
	'Administracion',
);

$this->menu=array(
	array('label'=>'List ConfCo', 'url'=>array('index')),
	array('label'=>'Create ConfCo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('conf-co-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Configuracion de Compras</h1>

<?php echo CHtml::link(Yii::t('app','ADVANCED_SEARCH'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div align = "right">
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Listar',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('confCo/index'),
	'icon' => 'list-alt white'
)); 

?>
</div>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'conf-co-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'BODEGA_DEFAULT',
		'ULT_SOLICITUD',
		'ULT_ORDEN_COMPRA',
		'ULT_EMBARQUE',
		'ULT_SOLICITUD_M',
		/*
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
		*/
	
		array(
			'class'=>'CButtonColumn',
			'template' => '{view} {update}',
		),
	),
)); ?>
