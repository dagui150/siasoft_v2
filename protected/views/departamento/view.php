<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Dependencias";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Dependencias'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Departamento', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Departamento', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' Departamento', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' Departamento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' Departamento', 'url'=>array('admin')),
);
?>

<h1>Ver Dependencia <?php echo $model->ID; ?></h1>

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
