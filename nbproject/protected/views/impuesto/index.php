<?php
$this->breadcrumbs=array(
	'Impuestos',
);

$this->menu=array(
	array('label'=>'Crear Impuesto', 'url'=>array('create')),
	array('label'=>'Administrar Impuesto', 'url'=>array('admin')),
);
?>

<h1>Impuestos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
