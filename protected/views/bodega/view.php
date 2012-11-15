<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Bodegas";?>

<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Bodegas'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Bodega', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Bodega', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' Bodega', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' Bodega', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' Bodega', 'url'=>array('admin')),
);
?>

<h1>Ver Bodega # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'TIPO',
		'TELEFONO',
		'DIRECCION',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
