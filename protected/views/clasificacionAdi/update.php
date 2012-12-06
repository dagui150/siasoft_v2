<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Clasificaciónes";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Clasificaciónes'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h1>Actualizar Clasificación "<?php echo $model2->NOMBRE; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>