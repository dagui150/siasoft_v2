<?php
$this->breadcrumbs=array(
	'Configuracion Compras'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List ConfCo', 'url'=>array('index')),
	array('label'=>'Manage ConfCo', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>