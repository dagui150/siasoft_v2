<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." ".Yii::t('app','ADMINISTRATION_SETTINGS');?>
<?php
$this->breadcrumbs=array(
	'Sistema'=>array('create'),
	'Configuración General',
);
?>

<h1><?php echo Yii::t('app','CREATE').' '. Yii::t('app','ADMINISTRATION_SETTINGS'); ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>