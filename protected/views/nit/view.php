<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','VIEW').' Nit';?>
<?php
/* @var $this NitController */
/* @var $model Nit */



$this->breadcrumbs=array(
	'Sistema'=>array('admin'),
	'Nits'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST'). 'Nit', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE'). 'Nit', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE'). 'Nit', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE'). 'Nit', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE'). 'Nit', 'url'=>array('admin')),
);
?>

<h1>Ver Nit <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'TIIPO_DOCUMENTO',
		'RAZON_SOCIAL',
		'ALIAS',
		'OBSERVACIONES',
            /*
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
