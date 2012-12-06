<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Proveedor";?>
<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Proveedor', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' Proveedor', 'url'=>array('admin')),
);
?>

<h1>Crear Proveedor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'cuenta'=>$cuenta, 'nit'=>$nit)); ?>