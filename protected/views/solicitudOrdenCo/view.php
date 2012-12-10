<?php
$this->breadcrumbs=array(
	'Solicitud Orden Cos'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar SolicitudOrdenCo', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOrdenCo', 'url'=>array('create')),
	array('label'=>'Actualizar SolicitudOrdenCo', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar SolicitudOrdenCo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar SolicitudOrdenCo', 'url'=>array('admin')),
);
?>

<h1>Ver SolicitudOrdenCo #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'SOLICITUD_OC',
		'SOLICITUD_OC_LINEA',
		'ORDEN_COMPRA',
		'ORDEN_COMPRA_LINEA',
		'DECIMA',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
