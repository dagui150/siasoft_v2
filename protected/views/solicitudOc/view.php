<?php
$this->breadcrumbs=array(
	'Solicitud Ocs'=>array('index'),
	$model->SOLICITUD_OC,
);

$this->menu=array(
	array('label'=>'Listar SolicitudOc', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOc', 'url'=>array('create')),
	array('label'=>'Actualizar SolicitudOc', 'url'=>array('update', 'id'=>$model->SOLICITUD_OC)),
	array('label'=>'Eliminar SolicitudOc', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SOLICITUD_OC),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar SolicitudOc', 'url'=>array('admin')),
);
?>

<h1>Ver SolicitudOc #<?php echo $model->SOLICITUD_OC; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'SOLICITUD_OC',
		'DEPARTAMENTO',
		'FECHA_SOLICITUD',
		'FECHA_REQUERIDA',
		'AUTORIZADA_POR',
		'FECHA_AUTORIZADA',
		'PRIORIDAD',
		'LINEAS_NO_ASIG',
		'COMENTARIO',
		'CANCELADA_POR',
		'FECHA_CANCELADA',
		'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'ESTADO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
