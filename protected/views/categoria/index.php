<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Categorías',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' Categoria', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' Categoria', 'url'=>array('admin')),
);
?>

<h1>Categorías</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
