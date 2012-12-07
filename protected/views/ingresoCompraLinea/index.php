<?php
/* @var $this IngresoCompraLineaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ingreso Compra Líneas',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' IngresoCompraLinea', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' IngresoCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Ingreso Compra Líneas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
