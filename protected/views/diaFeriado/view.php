<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Días Feriados";?><?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Días Feriados'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' DiaFeriado', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' DiaFeriado', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' DiaFeriado', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE').' DiaFeriado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' DiaFeriado', 'url'=>array('admin')),
);
?>

<h1>Ver Dia Feriado # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'TIPO',
		'DIA',
		'MES',
		'ANIO',
		'DESCRIPCION',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
