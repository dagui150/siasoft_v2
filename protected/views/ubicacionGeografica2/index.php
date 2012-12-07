<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 2',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' UbicacionGeografica2', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' UbicacionGeografica2', 'url'=>array('admin')),
);
?>

<h1>Ubicacion Geografica 2</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
