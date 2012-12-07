<?php
$this->breadcrumbs=array(

	Yii::t('app','ADMINISTRATION_SETTINGS')=>array('admin'),
	Yii::t('app','ADMINISTRATION_SETTINGS')=>array('index'),
	$model2->ID=>array('view','id'=>$model2->ID),
	Yii::t('app','UPDATE'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('view', 'id'=>$model2->ID)),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','UPDATE').' '.Yii::t('app','ADMINISTRATION_SETTINGS').' '.$model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>