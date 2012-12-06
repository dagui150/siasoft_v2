<?php
$this->breadcrumbs=array(
	'Configuracion Compras',
);

$this->menu=array(
	array('label'=>'Create ConfCo', 'url'=>array('create')),
	array('label'=>'Manage ConfCo', 'url'=>array('admin')),
);
?>

<h1>Configuracion de Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
