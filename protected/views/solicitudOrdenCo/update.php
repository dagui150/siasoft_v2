<?php
$this->breadcrumbs=array(
	'Solicitud Orden Cos'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOrdenCo', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOrdenCo', 'url'=>array('create')),
	array('label'=>'Ver SolicitudOrdenCo', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Administrar SolicitudOrdenCo', 'url'=>array('admin')),
);
?>

<h1>Actualizar SolicitudOrdenCo <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>