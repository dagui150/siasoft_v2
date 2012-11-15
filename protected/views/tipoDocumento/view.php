<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Tipos de Documento";?>
<?php
$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Tipos de Documento'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoDocumento', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoDocumento', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' TipoDocumento', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' TipoDocumento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo Documento # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'MASCARA',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
