<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','LIST').' Nit';?>
<?php
/* @var $this NitController */
/* @var $dataProvider CActiveDataProvider */



$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Nits',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE'). 'Nit', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE'). 'Nit', 'url'=>array('admin')),
);
?>

<h1>Nits</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
