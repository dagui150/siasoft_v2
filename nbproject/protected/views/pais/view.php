<?php
$this->breadcrumbs=array(
	Yii::t('app','COUNTRY')=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','COUNTRY'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','COUNTRY'), 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' '.Yii::t('app','COUNTRY'), 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' '.Yii::t('app','COUNTRY'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','COUNTRY'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','VIEW').' '.Yii::t('app','COUNTRY'); ?> #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'CODIGO_ISO',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADIO_EL',
	),
)); ?>
