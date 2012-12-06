<?php
$this->breadcrumbs=array(
	'Conf Ases'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','VIEW').' '.Yii::t('app','ADMINISTRATION_SETTINGS'); ?> #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'IMPUESTO1_DESC',
		'IMPUESTO2_DESC',
		'PATRON_CCOSTO',
		'SIMBOLO_MONEDA',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
