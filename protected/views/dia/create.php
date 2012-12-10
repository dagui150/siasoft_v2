<?php
/* @var $this DiaController */
/* @var $model Dia */

$this->breadcrumbs=array(
	'Dias'=>array('index'),
	Yii::t('app','CREATE').'',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Dia', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' Dia', 'url'=>array('admin')),
);
?>

<h1>Create Dia</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>