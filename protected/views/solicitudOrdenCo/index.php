<?php
$this->breadcrumbs=array(
	'Solicitud Orden Cos',
);

$this->menu=array(
	array('label'=>'Crear SolicitudOrdenCo', 'url'=>array('create')),
	array('label'=>'Administrar SolicitudOrdenCo', 'url'=>array('admin')),
);
?>

<h1>Solicitud Orden Cos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
