<?php
$this->breadcrumbs=array(
	'Orden Compra Líneas',
);

$this->menu=array(
	array('label'=>'Crear OrdenCompraLinea', 'url'=>array('create')),
	array('label'=>'Administrar OrdenCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Orden Compra Líneas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
