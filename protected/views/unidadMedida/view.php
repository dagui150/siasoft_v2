<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Unidades de Medida";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Unidades de Medida'=>array('admin'),
	$model->NOMBRE,
);
?>

<h1>Ver UnidadMedida "<?php echo $model->NOMBRE; ?>"</h1>
<br>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'NOMBRE',
		'ABREVIATURA',
                array(
                    'name'=>'TIPO',
                    'value'=>$model->darTipo($model->TIPO)
                ),
                array(
                    'name'=>'UNIDAD_BASE',
                    'label'=>'Unidad Base',
                    'value'=>isset($model->unidadMedidas->NOMBRE) ? $model->unidadMedidas->NOMBRE :'No Asignado'
                ),
		'EQUIVALENCIA',
	),
)); ?>
