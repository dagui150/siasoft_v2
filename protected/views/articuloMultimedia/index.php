<?php
$this->breadcrumbs=array(
	'Articulo Multimedias',
);

?>

<h1>Articulo Multimedias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
