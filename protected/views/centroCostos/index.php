<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Centro de Costos',
);

$this->menu=array(
	array('label'=>'Create CentroCostos', 'url'=>array('create')),
	array('label'=>'Manage CentroCostos', 'url'=>array('admin')),
);
?>

<h1>Centro de Costos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
