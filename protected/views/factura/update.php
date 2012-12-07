<?php
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Facturas'=>array('admin'),
	$model->FACTURA=>array('view','id'=>$model->FACTURA),
	'Actualizar',
);

?>

<h1>Actualizar Factura <?php echo $model->FACTURA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>