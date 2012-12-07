<?php
$this->breadcrumbs=array(
	'Solicitud Oc Líneas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOcLinea', 'url'=>array('index')),
	array('label'=>'Administrar SolicitudOcLinea', 'url'=>array('admin')),
);
?>

<h1>Crear SolicitudOcLinea</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>