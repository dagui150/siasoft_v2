<?php
$this->breadcrumbs=array(
	'Entidad Financiera'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List EntidadFinanciera', 'url'=>array('index')),
	array('label'=>'Manage EntidadFinanciera', 'url'=>array('admin')),
);
?>

<h1>Crear Entidad Financiera</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2,  'nit'=>$nit,)); ?>