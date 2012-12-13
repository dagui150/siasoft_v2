<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Artículo Multimedias";?>
<?php
$this->breadcrumbs=array(
	'Artículo Multimedias'=>array('admin'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

?>

<h1>Actualizar Artículo Multimedia <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>