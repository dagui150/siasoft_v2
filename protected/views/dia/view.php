<?php
/* @var $this DiaController */
/* @var $model Dia */

$this->breadcrumbs=array(
	'Dias'=>array('index'),
	$model->DIA,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Dia', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Dia', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' Dia', 'url'=>array('update', 'id'=>$model->DIA)),
	array('label'=>Yii::t('app','DELETE').' Dia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->DIA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' Dia', 'url'=>array('admin')),
);
?>

<h1>View Dia #<?php echo $model->DIA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'DIA',
		'NOMBRE',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
