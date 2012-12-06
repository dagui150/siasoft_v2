<?php $this->pageTitle=Yii::app()->name." - Artículo Multimedias";?>
<?php
$this->breadcrumbs=array(
	'Artículo Multimedias',
);

?>

<h1>Artículo Multimedias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
