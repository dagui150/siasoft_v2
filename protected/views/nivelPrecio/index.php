<?php
$this->breadcrumbs=array(
	'Nivel Precio',
);

$this->menu=array(
	array('label'=>'Create NivelPrecio', 'url'=>array('create')),
	array('label'=>'Manage NivelPrecio', 'url'=>array('admin')),
);
?>

<h1>Nivel Precio</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
