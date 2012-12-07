<?php
$this->breadcrumbs=array(
	Yii::t('app','ADMINISTRATION_SETTINGS')=>array('admin'),
	Yii::t('app','CREATE'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Configuracion de Administracion', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' Configuracion de Administracion', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','CREATE').' '. Yii::t('app','ADMINISTRATION_SETTINGS'); ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>