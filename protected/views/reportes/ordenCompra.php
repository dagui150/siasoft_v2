<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_PURCHASE_ORDERS');?>
<?php
$this->breadcrumbs=array(
	'Reportes'=>array('inventario'),
	Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_PURCHASE_ORDERS'),
);

?>

<h1><?php echo Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_PURCHASE_ORDERS');?></h1>

<?php $tipo_form='ordenCompra'; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'tipo'=>$tipo_form, 'provider'=>$provider)); ?>