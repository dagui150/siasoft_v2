<?php
/* @var $this DiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dias',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' Dia', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' Dia', 'url'=>array('admin')),
);
?>

<h1>Dias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
