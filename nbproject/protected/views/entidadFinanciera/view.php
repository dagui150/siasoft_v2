<?php
$this->breadcrumbs=array(
	'Entidad Financiera'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List EntidadFinanciera', 'url'=>array('index')),
	array('label'=>'Create EntidadFinanciera', 'url'=>array('create')),
	array('label'=>'Update EntidadFinanciera', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete EntidadFinanciera', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EntidadFinanciera', 'url'=>array('admin')),
);
?>

<h1>Ver Entidad Financiera # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NIT',
		'DESCRIPCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
