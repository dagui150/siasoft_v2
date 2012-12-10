<?php
/* @var $this IngresoCompraLineaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ingreso Compra Lineas',
);

$this->menu=array(
	array('label'=>'Create IngresoCompraLinea', 'url'=>array('create')),
	array('label'=>'Manage IngresoCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Ingreso Compra Lineas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
