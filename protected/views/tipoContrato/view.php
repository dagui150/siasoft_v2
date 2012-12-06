<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Tipos de Contrato";?>
<?php
/* @var $this TipoContratoController */
/* @var $model TipoContrato */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Contrato'=>array('admin'),
	$model->TIPO_CONTRATO,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoContrato', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoContrato', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' TipoContrato', 'url'=>array('update', 'id'=>$model->TIPO_CONTRATO)),
	array('label'=>Yii::t('app','DELETE').' TipoContrato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->TIPO_CONTRATO),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' TipoContrato', 'url'=>array('admin')),
);
?>

<h1>Ver Tipo de Contrato <?php echo $model->TIPO_CONTRATO; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'TIPO_CONTRATO',
		'NOMBRE',
	),
)); ?>
