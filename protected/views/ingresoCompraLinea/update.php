<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */

$this->breadcrumbs=array(
	'Ingreso Compra Líneas'=>array('index'),
	$model->INGRESO_COMPRA_LINEA=>array('view','id'=>$model->INGRESO_COMPRA_LINEA),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' IngresoCompraLinea', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' IngresoCompraLinea', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' IngresoCompraLinea', 'url'=>array('view', 'id'=>$model->INGRESO_COMPRA_LINEA)),
	array('label'=>Yii::t('app','MANAGE').' IngresoCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Update IngresoCompraLinea <?php echo $model->INGRESO_COMPRA_LINEA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>