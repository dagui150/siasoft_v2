<?php
$this->breadcrumbs=array(
	'Existencia Bodegas',
);

$this->menu=array(
	array('label'=>'Crear ExistenciaBodega', 'url'=>array('create')),
	array('label'=>'Administrar ExistenciaBodega', 'url'=>array('admin')),
);
?>

<h1>Existencia Bodegas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
