<?php
$this->breadcrumbs=array(
	'Dia Feriados'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List DiaFeriado', 'url'=>array('index')),
	array('label'=>'Manage DiaFeriado', 'url'=>array('admin')),
);
?>

<h1>Crear Dia Feriado</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>