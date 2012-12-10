<?php
$this->breadcrumbs=array(
	Yii::t('app','COUNTRIES')=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	Yii::t('app','UPDATE'),
);


?>

<h1><?php echo Yii::t('app','UPDATE').' '.Yii::t('app','COUNTRY').' '.$model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>