<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Tipos de Ausencias";?>
<?php
/* @var $this TipoAusenciaController */
/* @var $model TipoAusencia */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Ausencias'=>array('admin'),
	$model2->TIPO_AUSENCIA=>array('view','id'=>$model2->TIPO_AUSENCIA),
	'Actualizar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoAusencia', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoAusencia', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' TipoAusencia', 'url'=>array('view', 'id'=>$model2->TIPO_AUSENCIA)),
	array('label'=>Yii::t('app','MANAGE').' TipoAusencia', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tipo de Ausencia <?php echo $model2->TIPO_AUSENCIA; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>