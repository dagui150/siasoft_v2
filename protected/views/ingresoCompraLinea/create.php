<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */

$this->breadcrumbs=array(
	'Ingreso Compra Líneas'=>array('index'),
	Yii::t('app','CREATE').'',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' IngresoCompraLinea', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' IngresoCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Create IngresoCompraLinea</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>