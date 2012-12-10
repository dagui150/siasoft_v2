<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Zonas";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Zonas'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Zona', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Zona', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' Zona', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' Zona', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' Zona', 'url'=>array('admin')),
);
?>

<h1>Ver Zona # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'pAIS.NOMBRE',
		'NOMBRE',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
