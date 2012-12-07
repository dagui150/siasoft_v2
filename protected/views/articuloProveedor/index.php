<?php
$this->breadcrumbs=array(
	'Artículo Proveedores',
);

?>

<h1>Artículo Proveedors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
