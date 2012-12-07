<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." ".Yii::t('app','COUNTRIES');?>
<?php
$this->breadcrumbs=array(
	Yii::t('app','COUNTRIES')=>array('admin'),
	Yii::t('app','CREATE'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Pais', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' Pais', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','CREATE').' '.Yii::t('app','COUNTRY'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model2)); ?>