<?php
$this->breadcrumbs=array(
	'Nivel Precio'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List NivelPrecio', 'url'=>array('index')),
	array('label'=>'Create NivelPrecio', 'url'=>array('create')),
	array('label'=>'Update NivelPrecio', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete NivelPrecio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage NivelPrecio', 'url'=>array('admin')),
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
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
