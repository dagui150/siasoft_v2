<?php
$this->breadcrumbs=array(
	'Tipo Cuentas'=>array('index'),
	$model->TIPO_CUENTA,
);

$this->menu=array(
	array('label'=>'Listar TipoCuenta', 'url'=>array('index')),
	array('label'=>'Crear TipoCuenta', 'url'=>array('create')),
	array('label'=>'Actualizar TipoCuenta', 'url'=>array('update', 'id'=>$model->TIPO_CUENTA)),
	array('label'=>'Eliminar TipoCuenta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TIPO_CUENTA),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar TipoCuenta', 'url'=>array('admin')),
);
?>

<h1>Ver TipoCuenta #<?php echo $model->TIPO_CUENTA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TIPO_CUENTA',
		'DESCRIPCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
