<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Existencias en Bodegas";?>
<?php
$this->breadcrumbs=array(
	'Existencias en Bodegas'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar ExistenciaBodega', 'url'=>array('index')),
	array('label'=>'Crear ExistenciaBodega', 'url'=>array('create')),
	array('label'=>'Actualizar ExistenciaBodega', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar ExistenciaBodega', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar ExistenciaBodega', 'url'=>array('admin')),
);
?>

<h1>Ver Existencias en Bodegas #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ARTICULO',
		'BODEGA',
		'EXISTENCIA_MINIMA',
		'EXISTENCIA_MAXIMA',
		'PUNTO_REORDEN',
		'CANT_DISPONIBLE',
		'CANT_RESERVADA',
		'CANT_REMITIDA',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
