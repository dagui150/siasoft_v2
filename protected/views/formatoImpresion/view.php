<?php
/* @var $this FormatoImpresionController */
/* @var $model FormatoImpresion */
?>

<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','VIEW').' FormatoImpresion';?>

<?php
$this->breadcrumbs=array(
	'Sistema'=>array('admin'),
	'Administración de Reportes'=>array('admin'),
	$model->ID,
);

$this->menu=array(
		array('label'=>Yii::t('app','LIST'). 'FormatoImpresion', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE'). 'FormatoImpresion', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE'). 'FormatoImpresion', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','DELETE'). 'FormatoImpresion', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE'). 'FormatoImpresion', 'url'=>array('admin')),
);
?>

<h1>Ver Formato de Impresion <?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'NOMBRE',
		'OBSERVACION',
                array(
                    'name'=>'MODULO',
                    'value'=>FormatoImpresion::getModulo($model->MODULO),
                ),
		'SUBMODULO',
		'RUTA',
		'TIPO',
            /*
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
             * 
             */
	),
)); ?>
