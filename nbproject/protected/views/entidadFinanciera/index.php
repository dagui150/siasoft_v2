<?php
$this->breadcrumbs=array(
	'Entidad Financiera',
);

$this->menu=array(
	array('label'=>'Create EntidadFinanciera', 'url'=>array('create')),
	array('label'=>'Manage EntidadFinanciera', 'url'=>array('admin')),
);
?>

<h1>Entidad Financiera</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
