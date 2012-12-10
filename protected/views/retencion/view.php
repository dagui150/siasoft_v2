<?php
$this->breadcrumbs=array(
	'Retencions'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar Retencion', 'url'=>array('index')),
	array('label'=>'Crear Retencion', 'url'=>array('create')),
	array('label'=>'Actualizar Retencion', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar Retencion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar Retencion', 'url'=>array('admin')),
);
?>

<h1>Ver Retencion #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'PORCENTAJE',
		'MONTO_MINIMO',
		'TIPO',
		'APLICA_MONTO',
		'APLICA_SUBTOTAL',
		'APLICA_SUB_DESC',
		'APLICA_IMPUESTO1',
		'APLICA_RUBRO1',
		'APLICA_RUBRO2',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
