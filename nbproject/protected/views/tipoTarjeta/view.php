<?php
$this->breadcrumbs=array(
	'Tipo Tarjeta'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List TipoTarjeta', 'url'=>array('index')),
	array('label'=>'Create TipoTarjeta', 'url'=>array('create')),
	array('label'=>'Update TipoTarjeta', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete TipoTarjeta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoTarjeta', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo Tarjeta # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
