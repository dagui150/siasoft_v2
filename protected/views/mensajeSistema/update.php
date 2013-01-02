<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Mensaje";?>

<?php
/* @var $this MensajeSistemaController */
/* @var $model MensajeSistema */

$this->breadcrumbs=array(
        'Mensaje Sistemas'=>array('admin'),
	'Mensaje Sistemas'=>array('admin'),
	$model2->CODIGO=>array('view','id'=>$model2->CODIGO),
	'Actualizar',
);
?>

<h1>Actualizar Mensaje <?php echo $model2->CODIGO; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>