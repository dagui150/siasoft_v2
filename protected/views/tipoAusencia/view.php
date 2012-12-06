<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Tipos de Ausencias";?>
<?php
/* @var $this TipoAusenciaController */
/* @var $model TipoAusencia */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Ausencias'=>array('admin'),
	$model->TIPO_AUSENCIA,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoAusencia', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoAusencia', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' TipoAusencia', 'url'=>array('update', 'id'=>$model->TIPO_AUSENCIA)),
	array('label'=>Yii::t('app','DELETE').' TipoAusencia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TIPO_AUSENCIA),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' TipoAusencia', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo de Ausencia <?php echo $model->TIPO_AUSENCIA; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TIPO_AUSENCIA',
		'NOMBRE',
		array(
                    'name'=>'JUSTIFICADA',
                    'value'=>  TipoAusencia::getJustificada($model->JUSTIFICADA),
                ),
            array(
                    'name'=>'PAGO',
                    'value'=>  TipoAusencia::getPago($model->PAGO),
                ),
	),
)); ?>
