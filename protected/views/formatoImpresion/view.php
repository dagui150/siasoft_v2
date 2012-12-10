<?php
$this->breadcrumbs=array(
	'Formato Impresions'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar FormatoImpresion', 'url'=>array('index')),
	array('label'=>'Crear FormatoImpresion', 'url'=>array('create')),
	array('label'=>'Actualizar FormatoImpresion', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar FormatoImpresion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar FormatoImpresion', 'url'=>array('admin')),
);
?>

<h1>Ver FormatoImpresion #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'OBSERVACION',
		'MODULO',
		'SUBMODULO',
		'RUTA',
		'TIPO',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
