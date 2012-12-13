<?php
$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Dependencias',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' Departamento', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' Departamento', 'url'=>array('admin')),
);
?>

<h1>Dependencias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
