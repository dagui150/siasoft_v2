<?php $this->pageTitle=Yii::app()->name." - Proveedores";?>
<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	'Administrar',
);
?>

<h1>Proveedores</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
<?php 

$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('proveedor/create'),
	'icon' => 'plus white'
)); 

?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
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
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'afterDelete'=>$this->mensajeBorrar(),
		),
	),
)); ?>
