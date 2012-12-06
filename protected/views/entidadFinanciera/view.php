<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Entidad Financiera";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Entidad Financiera'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' EntidadFinanciera', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' EntidadFinanciera', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' EntidadFinanciera', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' EntidadFinanciera', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' EntidadFinanciera', 'url'=>array('admin')),
);
?>

<h1>Ver Entidad Financiera # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NIT',
		'DESCRIPCION',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
