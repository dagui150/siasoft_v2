<?php
$this->breadcrumbs=array(
	Yii::t('app','COMPANIES')=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','COMPANY'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','COMPANY'), 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' '.Yii::t('app','COMPANY'), 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' '.Yii::t('app','COMPANY'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','COMPANY'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','VIEW').' '.Yii::t('app','COMPANY'); ?> #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'NOMBRE_ABREV',
		'NIT',
		'uBICACIONGEOGRAFICA1.NOMBRE',
		'uBICACIONGEOGRAFICA2.NOMBRE',
		'pAIS.NOMBRE',
		'DIRECCION',
		'TELEFONO1',
		'TELEFONO2',
		'LOGO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
