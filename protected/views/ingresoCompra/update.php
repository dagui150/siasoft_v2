<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Ingreso Compras";?>
<?php
/* @var $this IngresoCompraController */
/* @var $model IngresoCompra */

$this->breadcrumbs=array(
	'Ingreso Compras'=>array('admin'),
	$model->INGRESO_COMPRA=>array('view','id'=>$model->INGRESO_COMPRA),
	'Actualizar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' IngresoCompra', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' IngresoCompra', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' IngresoCompra', 'url'=>array('view', 'id'=>$model->INGRESO_COMPRA)),
	array('label'=>Yii::t('app','MANAGE').' IngresoCompra', 'url'=>array('admin')),
);
?>

<h1>Update IngresoCompra <?php echo $model->INGRESO_COMPRA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>