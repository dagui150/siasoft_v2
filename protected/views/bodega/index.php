<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Bodegas',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' Bodega', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' Bodega', 'url'=>array('admin')),
);
?>

<h1>Bodegas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
