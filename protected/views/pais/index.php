<?php
$this->breadcrumbs=array(
	'Paises',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','COUNTRY'), 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' '.Yii::t('app','COUNTRY'), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','COUNTRIES'); ?></h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
