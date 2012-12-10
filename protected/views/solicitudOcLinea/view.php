<?php
$this->breadcrumbs=array(
	'Solicitud Oc Lineas'=>array('index'),
	$model->SOLICITUD_OC_LINEA,
);

$this->menu=array(
	array('label'=>'Listar SolicitudOcLinea', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOcLinea', 'url'=>array('create')),
	array('label'=>'Actualizar SolicitudOcLinea', 'url'=>array('update', 'id'=>$model->SOLICITUD_OC_LINEA)),
	array('label'=>'Eliminar SolicitudOcLinea', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SOLICITUD_OC_LINEA),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar SolicitudOcLinea', 'url'=>array('admin')),
);
?>

<h1>Ver SolicitudOcLinea #<?php echo $model->SOLICITUD_OC_LINEA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'SOLICITUD_OC_LINEA',
		'SOLICITUD_OC',
		'LINEA_NUM',
		'ARTICULO',
		'DESCRIPCION',
		'CANTIDAD',
		'SALDO',
		'COMENTARIO',
		'FECHA_REQUERIDA',
		'ESTADO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
