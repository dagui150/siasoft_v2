<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Unidades de Medida";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Unidades de Medida'=>array('admin'),
	$model2->NOMBRE=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h1>Actualizar Unidad de Medida "<?php echo $model2->NOMBRE; ?>" </h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>