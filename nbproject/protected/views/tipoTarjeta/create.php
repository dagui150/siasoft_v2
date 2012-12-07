<?php
$this->breadcrumbs=array(
	'Tipo Tarjetas'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List TipoTarjeta', 'url'=>array('index')),
	array('label'=>'Manage TipoTarjeta', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo Tarjeta</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>