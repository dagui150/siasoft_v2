<?php
$this->breadcrumbs=array(
	'Solicitud Ocs',
);

$this->menu=array(
	array('label'=>'Crear SolicitudOc', 'url'=>array('create')),
	array('label'=>'Administrar SolicitudOc', 'url'=>array('admin')),
);
?>

<h1>Solicitud Ocs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
