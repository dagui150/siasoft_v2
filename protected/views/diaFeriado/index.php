<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Días Feriados',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' DiaFeriado', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' DiaFeriado', 'url'=>array('admin')),
);
?>

<h1>Dias Feriados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
