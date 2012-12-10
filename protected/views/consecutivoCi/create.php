<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Consecutivos";?>
<?php
$this->breadcrumbs=array(
	'Consecutivos Cis'=>array('index'),
	'Crear',
);

?>

<h1>Crear Consecutivo</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>