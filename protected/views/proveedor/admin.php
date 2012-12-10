<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'List Proveedor', 'url'=>array('index')),
	array('label'=>'Create Proveedor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('proveedor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Proveedores</h1>

<div align="right">
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Listar',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('proveedor/index'),
	'icon' => 'list-alt white'
)); 

?>

<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('proveedor/create'),
	'icon' => 'plus white'
)); 

?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'proveedor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'PROVEEDOR',
		'CATEGORIA',
		'NOMBRE',
		'ALIAS',
		'CONTACTO',
		'CARGO',
		/*
		'DIRECCION',
		'EMAIL',
		'FECHA_INGRESO',
		'TELEFONO1',
		'TELEFONO2',
		'FAX',
		'NIT',
		'CONDICION_PAGO',
		'ACTIVO',
		'ORDEN_MINIMA',
		'DESCUENTO',
		'TASA_INTERES_MORA',
		*/
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
