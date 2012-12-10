<?php
$this->breadcrumbs=array(
	'Centro Costos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List CentroCostos', 'url'=>array('index')),
	array('label'=>'Manage CentroCostos', 'url'=>array('admin')),
);
?>

<h1>Crear Centro de Costos</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2, 'config'=>$config,)); ?>