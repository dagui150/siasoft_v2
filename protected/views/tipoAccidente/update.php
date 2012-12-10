<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Tipos de Accidentes";?>
<?php
/* @var $this TipoAccidenteController */
/* @var $model TipoAccidente */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Accidentes'=>array('admin'),
	$model2->TIPO_ACCIDENTE=>array('view','id'=>$model2->TIPO_ACCIDENTE),
	'Actualizar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoAccidente', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoAccidente', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' TipoAccidente', 'url'=>array('view', 'id'=>$model2->TIPO_ACCIDENTE)),
	array('label'=>Yii::t('app','MANAGE').' TipoAccidente', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tipo de Accidente <?php echo $model2->TIPO_ACCIDENTE; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>