<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 2'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' UbicacionGeografica2', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' UbicacionGeografica2', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' UbicacionGeografica2', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' UbicacionGeografica2', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' UbicacionGeografica2', 'url'=>array('admin')),
);
?>

<h1>Ver Ubicacion Geografica 2 # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'UBICACION_GEOGRAFICA1',
		'NOMBRE',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
