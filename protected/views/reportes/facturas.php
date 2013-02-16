<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_INVOICES');?>
<?php
$this->breadcrumbs=array(
	'Reportes'=>array('inventario'),
	Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_INVOICES'),
);

?>

<h1><?php echo Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_INVOICES');?></h1>

<?php $tipo_form='facturas'; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'tipo'=>$tipo_form)); ?>