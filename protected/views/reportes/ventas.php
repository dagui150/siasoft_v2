<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_SALES');?>
<?php
$this->breadcrumbs=array(
	'Reportes'=>array('ventas'),
	Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_SALES'),
);

?>

<h1><?php echo Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_SALES');?></h1>

<?php $tipo_form='ventas'; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'tipo'=>$tipo_form)); ?>