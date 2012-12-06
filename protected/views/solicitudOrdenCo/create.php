<?php
$this->breadcrumbs=array(
	'Solicitud Orden Cos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOrdenCo', 'url'=>array('index')),
	array('label'=>'Administrar SolicitudOrdenCo', 'url'=>array('admin')),
);
?>

<h1>Crear SolicitudOrdenCo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>