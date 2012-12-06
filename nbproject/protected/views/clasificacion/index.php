<?php
$this->breadcrumbs=array(
	'Clasificacions',
);
?>

<h1>Clasificacions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
