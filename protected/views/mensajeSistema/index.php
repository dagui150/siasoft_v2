<?php
/* @var $this MensajeSistemaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Mensaje Sistemas',
);

$this->menu=array(
	array('label'=>'Create MensajeSistema', 'url'=>array('create')),
	array('label'=>'Manage MensajeSistema', 'url'=>array('admin')),
);
?>

<h1>Mensaje Sistemas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
