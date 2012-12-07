<?php
$this->breadcrumbs=array(
	'Centro Costos'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List CentroCostos', 'url'=>array('index')),
	array('label'=>'Create CentroCostos', 'url'=>array('create')),
	array('label'=>'Update CentroCostos', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete CentroCostos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CentroCostos', 'url'=>array('admin')),
);
?>

<h1>Ver Centro de Costos # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'TIPO',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
