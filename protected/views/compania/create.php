<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." ".Yii::t('app','COMPANIES');?>
<?php
$this->breadcrumbs=array(
	Yii::t('app','COMPANIES')=>array('admin'),
	Yii::t('app','CREATE'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Compania', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' Compania', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','CREATE').' '.Yii::t('app','COMPANY'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>