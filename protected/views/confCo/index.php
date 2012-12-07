<?php
$this->breadcrumbs=array(
	'Configuración Compras',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' ConfCo', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' ConfCo', 'url'=>array('admin')),
);
?>

<h1>Configuración de Compras</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
