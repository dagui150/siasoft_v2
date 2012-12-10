<?php
$this->breadcrumbs=array(
	'Clasific Adi Articulos'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar ClasificAdiArticulo', 'url'=>array('index')),
	array('label'=>'Crear ClasificAdiArticulo', 'url'=>array('create')),
	array('label'=>'Actualizar ClasificAdiArticulo', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar ClasificAdiArticulo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar ClasificAdiArticulo', 'url'=>array('admin')),
);
?>

<h1>Ver ClasificAdiArticulo #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ARTICULO',
		'VALOR',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
