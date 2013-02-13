<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Proveedor";?>
<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	$model->PROVEEDOR=>array('view','id'=>$model->PROVEEDOR),
	'Actualizar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Proveedor', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Proveedor', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' Proveedor', 'url'=>array('view', 'id'=>$model->PROVEEDOR)),
	array('label'=>Yii::t('app','MANAGE').' Proveedor', 'url'=>array('admin')),
);
?>

<h1>Actualizar Proveedor <?php echo $model->PROVEEDOR; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'cuenta'=>$cuenta, 'nit'=>$nit)); ?>