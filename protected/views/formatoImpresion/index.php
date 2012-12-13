<?php
/* @var $this FormatoImpresionController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','LIST').' FormatoImpresion';?>

    <?php

$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Administración de Reportes',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE'). 'FormatoImpresion', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE'). 'FormatoImpresion', 'url'=>array('admin')),
);
?>

<h1>Administración de Reportes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
