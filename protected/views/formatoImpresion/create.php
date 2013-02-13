<?php
/* @var $this FormatoImpresionController */
/* @var $model FormatoImpresion */
?>

<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','CREATE').' FormatoImpresion';?>
<?php

$this->breadcrumbs=array(
	'Sistema'=>array('admin'),
	'Administración de Reportes'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST'). 'FormatoImpresion', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE'). 'FormatoImpresion', 'url'=>array('admin')),
);
?>

<h1>Crear Formato de Impresion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>