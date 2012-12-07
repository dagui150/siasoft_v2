<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Artículo Proveedores";?>
<?php
$this->breadcrumbs=array(
	'Artículo Proveedores'=>array('admin'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

?>

<h1>Actualizar ArticuloProveedor <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>