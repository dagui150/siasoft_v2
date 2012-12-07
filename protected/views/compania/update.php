<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." ".Yii::t('app','COMPANIES');?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('update', 'id'=>$model->ID),
	"Datos Empresa");
?>

<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Datos Empresa";?>

<h1><?php echo Yii::t('app','UPDATE').' '.Yii::t('app','COMPANY'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>