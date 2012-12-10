<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Estados de Empleado";?>
<?php
/* @var $this EstadoEmpleadoController */
/* @var $model EstadoEmpleado */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Estados de Empleado'=>array('admin'),
	$model->ESTADO_EMPLEADO,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' EstadoEmpleado', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' EstadoEmpleado', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' EstadoEmpleado', 'url'=>array('update', 'id'=>$model->ESTADO_EMPLEADO)),
	array('label'=>Yii::t('app','DELETE').' EstadoEmpleado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ESTADO_EMPLEADO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' EstadoEmpleado', 'url'=>array('admin')),
);
?>

<h1>Visualizar Estado de empleado <?php echo $model->ESTADO_EMPLEADO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ESTADO_EMPLEADO',
		'DESCRIPCION',
		array(
                    'name'=>'PAGO',
                    'value'=>EstadoEmpleado::getPago($model->PAGO),
                ),
            array(
                    'name'=>'TEMPORAL',
                    'value'=>EstadoEmpleado::getTemporal($model->TEMPORAL),
                ),
	),
)); ?>
