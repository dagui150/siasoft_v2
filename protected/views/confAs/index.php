<?php
$this->breadcrumbs=array(
	Yii::t('app','ADMINISTRATION_SETTINGS'),
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' ConfAs', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' ConfAs', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','ADMINISTRATION_SETTINGS'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
