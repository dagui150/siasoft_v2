<?php
$this->breadcrumbs=array(
	'Orden Compras',
);

$this->menu=array(
	array('label'=>'Crear OrdenCompra', 'url'=>array('create')),
	array('label'=>'Administrar OrdenCompra', 'url'=>array('admin')),
);
?>

<h1>Orden Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
