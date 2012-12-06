<?php
$this->breadcrumbs=array(
	'Tipo Documentos'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List TipoDocumento', 'url'=>array('index')),
	array('label'=>'Create TipoDocumento', 'url'=>array('create')),
	array('label'=>'Update TipoDocumento', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete TipoDocumento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo Documento # <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DESCRIPCION',
		'MASCARA',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
