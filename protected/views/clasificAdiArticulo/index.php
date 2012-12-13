<?php
$this->breadcrumbs=array(
	'Clasific Adi Artículos',
);

$this->menu=array(
	array('label'=>'Crear ClasificAdiArticulo', 'url'=>array('create')),
	array('label'=>'Administrar ClasificAdiArticulo', 'url'=>array('admin')),
);
?>

<h1>Clasific Adi Artículos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
