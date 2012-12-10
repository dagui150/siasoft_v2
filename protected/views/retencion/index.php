<?php
$this->breadcrumbs=array(
	'Retencions',
);

$this->menu=array(
	array('label'=>'Crear Retencion', 'url'=>array('create')),
	array('label'=>'Administrar Retencion', 'url'=>array('admin')),
);
?>

<h1>Retencions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
