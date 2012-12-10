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

<h1>Configuracion de compras</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>