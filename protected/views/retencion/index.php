<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Retenciones',
);

$this->menu=array(
	array('label'=>'Crear Retención', 'url'=>array('create')),
	array('label'=>'Administrar Retención', 'url'=>array('admin')),
);
?>

<h1>Retencions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
