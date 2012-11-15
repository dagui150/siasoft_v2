<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Nivel de Precios";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Nivel de Precios'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' NivelPrecio', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' NivelPrecio', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' NivelPrecio', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' NivelPrecio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' NivelPrecio', 'url'=>array('admin')),
);
?>

<h1>Ver Nivel Precio # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'ESQUEMA_TRABAJO',
		'CONDICION_PAGO',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
