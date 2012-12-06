<?php
$this->breadcrumbs=array(
	'Dias Feriados',
);

$this->menu=array(
	array('label'=>'Create DiaFeriado', 'url'=>array('create')),
	array('label'=>'Manage DiaFeriado', 'url'=>array('admin')),
);
?>

<h1>Dias Feriados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
