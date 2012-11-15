<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Tipo Tarjeta',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' TipoTarjeta', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' TipoTarjeta', 'url'=>array('admin')),
);
?>

<h1>Tipo Tarjeta</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
