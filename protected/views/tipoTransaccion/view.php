<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Tipos de Transacción";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Tipos de Transacción'=>array('admin'),
	$model->TIPO_TRANSACCION,
);
?>

<h1>Ver TipoTransaccion #<?php echo $model->TIPO_TRANSACCION; ?></h1>
<BR>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TIPO_TRANSACCION',
		'NOMBRE',
                array(
                    'name'=>'tRANSACCIONBASE.NOMBRE',
                    'label'=>'Transacción Base'
                ),
                array(
                    'name'=>'TRANSACCION_FIJA',
                    'value'=>$model->TRANSACCION_FIJA == 'S' ? 'Si' : 'No'
                ),
	),
)); ?>
