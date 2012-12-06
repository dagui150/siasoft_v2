<?php
/* @var $this ArticuloEnsambleController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Articulo Ensambles',
);

$this->menu=array(
	array('label'=>'Create ArticuloEnsamble', 'url'=>array('create')),
	array('label'=>'Manage ArticuloEnsamble', 'url'=>array('admin')),
);
?>

<h1>Articulo Ensambles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
