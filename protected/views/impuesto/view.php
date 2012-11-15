<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Impuestos";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Impuestos'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar Impuesto', 'url'=>array('index')),
	array('label'=>'Crear Impuesto', 'url'=>array('create')),
	array('label'=>'Actualizar Impuesto', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar Impuesto', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar Impuesto', 'url'=>array('admin')),
);
?>

<h1>Ver Impuesto #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'PROCENTAJE',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
