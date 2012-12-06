<?php
$this->breadcrumbs=array(
	'Dias Feriados'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List DiaFeriado', 'url'=>array('index')),
	array('label'=>'Create DiaFeriado', 'url'=>array('create')),
	array('label'=>'Update DiaFeriado', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete DiaFeriado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DiaFeriado', 'url'=>array('admin')),
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
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
