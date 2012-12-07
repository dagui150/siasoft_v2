<?php
$this->breadcrumbs=array(
	'Condicion de Pagos',
);

$this->menu=array(
	array('label'=>'Create CodicionPago', 'url'=>array('create')),
	array('label'=>'Manage CodicionPago', 'url'=>array('admin')),
);
?>

<h1>Condicion de Pagos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
