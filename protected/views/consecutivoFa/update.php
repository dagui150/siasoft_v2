<?php
$this->breadcrumbs=array(
    'Facturación'=>array('admin'),
	'Consecutivos'=>array('admin'),
	$model->CODIGO_CONSECUTIVO=>array('view','id'=>$model->CODIGO_CONSECUTIVO),
	'Actualizar',
);

?>

<h1>Actualizar Consecutivo "<?php echo $model->CODIGO_CONSECUTIVO; ?>"</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>