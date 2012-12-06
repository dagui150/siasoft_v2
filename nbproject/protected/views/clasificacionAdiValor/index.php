<?php
$this->breadcrumbs=array(
	'Clasificacion Adi Valors',
);

?>

<h1>Clasificacion Adi Valors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
