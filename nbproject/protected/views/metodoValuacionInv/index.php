<?php
$this->breadcrumbs=array(
	'Metodo Valuacion ',
);

?>

<h1>Metodo Valuacion Invs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
