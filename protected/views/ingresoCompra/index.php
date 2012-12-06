<?php
/* @var $this IngresoCompraController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ingreso Compras',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' IngresoCompra', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' IngresoCompra', 'url'=>array('admin')),
);
?>

<h1>Ingreso Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
