<?php
$this->breadcrumbs=array(
	'Proveedor',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' Proveedor', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' Proveedor', 'url'=>array('admin')),
);
?>

<h1>Proveedor</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
