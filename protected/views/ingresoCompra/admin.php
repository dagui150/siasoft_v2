<script>
function obtenerSeleccion(){

    var idcategoria = $.fn.yiiGridView.getSelection('ingreso-compra-grid');
    $('#check').val(idcategoria);
}
</script>
<?php
/* @var $this IngresoCompraController */
/* @var $model IngresoCompra */

$this->breadcrumbs=array(
	'Ingreso Compras'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'List IngresoCompra', 'url'=>array('index')),
	array('label'=>'Create IngresoCompra', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ingreso-compra-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Ingreso de Compras</h1>

<div align="right">
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('ingresoCompra/create'),
	'icon' => 'plus white',
)); 

?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'ingreso-compra-grid',
        'selectableRows'=>2,
        'selectionChanged'=>'obtenerSeleccion',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array('class'=>'CCheckBoxColumn'),
		'INGRESO_COMPRA',
		'PROVEEDOR',
		'FECHA_INGRESO',
		'TIENE_FACTURA',
                'APLICADO_POR',
		'APLICADO_EL',
		/*
                'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'NOTAS',
		'ESTADO',
		'CANCELADO_POR',
		'CANCELADO_EL',
		'CREADO_POR',
		'CREADO_EL',
		'MODIFICADO_POR',
		'MODIFICADO_EL',
		*/
	),
)); ?>
<?php echo CHtml::HiddenField('check',''); ?>