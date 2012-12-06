<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Condición de Pago";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Condición de Pago'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' CodicionPago', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' CodicionPago', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' CodicionPago', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' CodicionPago', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' CodicionPago', 'url'=>array('admin')),
);
?>

<h1>Ver Condición de Pago # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'DIAS_NETO',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
