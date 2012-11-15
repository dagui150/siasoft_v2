<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Centro de Costos";?><?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Centro de Costos'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' CentroCostos', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' CentroCostos', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' CentroCostos', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' CentroCostos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' CentroCostos', 'url'=>array('admin')),
);
?>

<h1>Ver Centro de Costos # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'TIPO',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
