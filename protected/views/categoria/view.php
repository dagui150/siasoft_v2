<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Categorías";?>

<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Categorías'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Categoria', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Categoria', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' Categoria', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' Categoria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' Categoria', 'url'=>array('admin')),
);
?>

<h1>Ver Categoria # <?php echo $model->ID; ?></h1>

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
