<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Retenciones";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Retenciones'=>array('admin'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'Listar Retención', 'url'=>array('index')),
	array('label'=>'Crear Retención', 'url'=>array('create')),
	array('label'=>'Actualizar Retención', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Eliminar Retención', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Esta seguro que desea eliminar?')),
	array('label'=>'Administrar Retención', 'url'=>array('admin')),
);
?>

<h1>Ver Retención #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'PORCENTAJE',
		'MONTO_MINIMO',
		'TIPO',
		'APLICA_MONTO',
		'APLICA_SUBTOTAL',
		'APLICA_SUB_DESC',
		'APLICA_IMPUESTO1',
		'APLICA_RUBRO1',
		'APLICA_RUBRO2',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
