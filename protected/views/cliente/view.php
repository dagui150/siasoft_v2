<?php
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Clientes'=>array('admin'),
	$model->CLIENTE,
);

?>

<h1>Ver Cliente #<?php echo $model->CLIENTE; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CLIENTE',
		'NOMBRE',
                array(
                    'name'=>'NIT',
                    'value'=>$model->NIT ? $model->NIT.' - '.$model->nIT->RAZON_SOCIAL : 'No Asignado'
                ),
		'FECHA_INGRESO',
		'ALIAS',
		'CONTACTO',
		'CARGO',
		'INTERES_CORRIENTE',
		'INTERES_MORA',
		'DESCUENTO',
		'LIMITE_CREDITO',
		'EMAIL',
		'SITIO_WEB',
		'DIRECCION_COBRO',
		'DIRECCION_EMBARQUE',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
