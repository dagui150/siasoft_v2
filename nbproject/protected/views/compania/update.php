<?php
$this->breadcrumbs=array(
	Yii::t('app','COMPANIES')=>array('admin'),
	$model->ID=>array('view','id'=>$model->ID),
	Yii::t('app','UPDATE'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','COMPANY'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','COMPANY'), 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' '.Yii::t('app','COMPANY'), 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','COMPANY'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','UPDATE').' '.Yii::t('app','COMPANY'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>