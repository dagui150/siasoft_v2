<?php
$this->breadcrumbs=array(
	'Condicion de Pagos',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' CodicionPago', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' CodicionPago', 'url'=>array('admin')),
);
?>

<h1>Condicion de Pagos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
