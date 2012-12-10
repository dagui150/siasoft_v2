<?php
$this->breadcrumbs=array(
	'Formato Impresions',
);

$this->menu=array(
	array('label'=>'Crear FormatoImpresion', 'url'=>array('create')),
	array('label'=>'Administrar FormatoImpresion', 'url'=>array('admin')),
);
?>

<h1>Formato Impresions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
