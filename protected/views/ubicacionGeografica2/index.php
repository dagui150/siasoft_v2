<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 2',
);

$this->menu=array(
	array('label'=>'Create UbicacionGeografica2', 'url'=>array('create')),
	array('label'=>'Manage UbicacionGeografica2', 'url'=>array('admin')),
);
?>

<h1>Ubicacion Geografica 2</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
