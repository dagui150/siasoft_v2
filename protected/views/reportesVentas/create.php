<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_SALE');?>
<?php
$this->breadcrumbs=array(
	Yii::t('app','REPORTS_SALE')=>array('create'),
	Yii::t('app','CREATE'),
);
?>

<h1><?php echo Yii::t('app','GENERATE').' '. Yii::t('app','REPORTS_SALE'); ?></h1>

<?php echo $this->renderPartial('_form'); ?>