<?php
/* @var $this DiaController */
/* @var $model Dia */

$this->breadcrumbs=array(
	'Dias'=>array('index'),
	$model->DIA=>array('view','id'=>$model->DIA),
	'Update',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Dia', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Dia', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' Dia', 'url'=>array('view', 'id'=>$model->DIA)),
	array('label'=>Yii::t('app','MANAGE').' Dia', 'url'=>array('admin')),
);
?>

<h1>Update Dia <?php echo $model->DIA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>