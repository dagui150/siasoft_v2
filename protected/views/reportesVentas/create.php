<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Proveedor";?>
<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	'Crear',
);

?>

<h1>Crear Proveedor</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>