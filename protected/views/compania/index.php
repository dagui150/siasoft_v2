<?php
$this->breadcrumbs=array(
	Yii::t('app','COMPANIES'),
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','COMPANY'), 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','COMPANY'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','COMPANIES'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
