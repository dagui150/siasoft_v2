<?php
$this->breadcrumbs=array(
	'Condicion de Pagos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List CodicionPago', 'url'=>array('index')),
	array('label'=>'Manage CodicionPago', 'url'=>array('admin')),
);
?>

<h1>Crear Condicion de Pago</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>