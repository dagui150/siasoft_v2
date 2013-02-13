<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Tipo de Tarjeta";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Tipo de Tarjeta'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoTarjeta', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoTarjeta', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' TipoTarjeta', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' TipoTarjeta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' TipoTarjeta', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo Tarjeta # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
