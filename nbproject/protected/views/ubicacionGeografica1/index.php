<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 1',
);

$this->menu=array(
	array('label'=>'Create UbicacionGeografica1', 'url'=>array('create')),
	array('label'=>'Manage UbicacionGeografica1', 'url'=>array('admin')),
);
?>

<h1>Ubicacion Geografica 1</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
