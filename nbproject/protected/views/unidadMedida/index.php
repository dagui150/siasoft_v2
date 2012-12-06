<?php
$this->breadcrumbs=array(
	'Unidad Medidas',
);

?>

<h1>Unidad Medidas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
