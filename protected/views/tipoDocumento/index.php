<?php
$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Tipos de Documento',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' TipoDocumento', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Tipo Documento</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
