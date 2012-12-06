<?php
/* @var $this RegimenTributarioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Regimen Tributarios',
);

$this->menu=array(
	array('label'=>'Create RegimenTributario', 'url'=>array('create')),
	array('label'=>'Manage RegimenTributario', 'url'=>array('admin')),
);
?>

<h1>Regimen Tributarios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
