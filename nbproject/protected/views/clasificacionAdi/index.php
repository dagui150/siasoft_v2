<?php
$this->breadcrumbs=array(
	'Clasificacion Adis',
);

?>

<h1>Clasificacion Adis</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
