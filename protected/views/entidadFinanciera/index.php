<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Entidad Financiera',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' EntidadFinanciera', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' EntidadFinanciera', 'url'=>array('admin')),
);
?>

<h1>Entidad Financiera</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
