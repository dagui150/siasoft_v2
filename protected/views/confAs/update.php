<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." ".Yii::t('app','ADMINISTRATION_SETTINGS');?>

<?php
$this->breadcrumbs=array(

	'Sistema'=>array('update', 'id'=>$model2->ID),
	Yii::t('app','ADMINISTRATION_SETTINGS'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('view', 'id'=>$model2->ID)),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','ADMINISTRATION_SETTINGS') ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>