<?php
$this->breadcrumbs=array(
	'Solicitud Oc Líneas'=>array('admin'),
	$model->SOLICITUD_OC_LINEA=>array('view','id'=>$model->SOLICITUD_OC_LINEA),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOcLinea', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOcLinea', 'url'=>array('create')),
	array('label'=>'Ver SolicitudOcLinea', 'url'=>array('view', 'id'=>$model->SOLICITUD_OC_LINEA)),
	array('label'=>'Administrar SolicitudOcLinea', 'url'=>array('admin')),
);
?>

<h1>Actualizar SolicitudOcLinea <?php echo $model->SOLICITUD_OC_LINEA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>