<?php
$this->breadcrumbs=array(
	'Zonas',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' Zona', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' Zona', 'url'=>array('admin')),
);
?>

<h1>Zonas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
