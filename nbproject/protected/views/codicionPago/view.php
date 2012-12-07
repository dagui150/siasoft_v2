<?php
$this->breadcrumbs=array(
	'Condicion Pagos'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List CodicionPago', 'url'=>array('index')),
	array('label'=>'Create CodicionPago', 'url'=>array('create')),
	array('label'=>'Update CodicionPago', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete CodicionPago', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CodicionPago', 'url'=>array('admin')),
);
?>

<h1>Ver Condicion de Pago # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'DIAS_NETO',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
