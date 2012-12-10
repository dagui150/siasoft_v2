<?php
$this->breadcrumbs=array(
	'Tipo Documento',
);

$this->menu=array(
	array('label'=>'Create TipoDocumento', 'url'=>array('create')),
	array('label'=>'Manage TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Tipo Documento</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
