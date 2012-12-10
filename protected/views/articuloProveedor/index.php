<?php
$this->breadcrumbs=array(
	'Articulo Proveedores',
);

?>

<h1>Articulo Proveedors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
