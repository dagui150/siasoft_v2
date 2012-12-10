<?php
$this->breadcrumbs=array(
	'Solicitud Oc Líneas',
);

$this->menu=array(
	array('label'=>'Crear SolicitudOcLinea', 'url'=>array('create')),
	array('label'=>'Administrar SolicitudOcLinea', 'url'=>array('admin')),
);
?>

<h1>Solicitud Oc Líneas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
