<?php
$this->breadcrumbs=array(
	'Tipo Tarjeta',
);

$this->menu=array(
	array('label'=>'Create TipoTarjeta', 'url'=>array('create')),
	array('label'=>'Manage TipoTarjeta', 'url'=>array('admin')),
);
?>

<h1>Tipo Tarjeta</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
