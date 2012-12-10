<?php
$this->breadcrumbs=array(
	'Clasific Adi Articulos',
);

$this->menu=array(
	array('label'=>'Crear ClasificAdiArticulo', 'url'=>array('create')),
	array('label'=>'Administrar ClasificAdiArticulo', 'url'=>array('admin')),
);
?>

<h1>Clasific Adi Articulos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
