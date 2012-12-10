<?php
$this->breadcrumbs=array(
	'Bodegas',
);

$this->menu=array(
	array('label'=>'Create Bodega', 'url'=>array('create')),
	array('label'=>'Manage Bodega', 'url'=>array('admin')),
);
?>

<h1>Bodegas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
