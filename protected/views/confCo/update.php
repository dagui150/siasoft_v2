<?php
$this->breadcrumbs=array(
	'Configuracion Compras'=>array('admin'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'List ConfCo', 'url'=>array('index')),
	array('label'=>'Create ConfCo', 'url'=>array('create')),
	array('label'=>'View ConfCo', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage ConfCo', 'url'=>array('admin')),
);
?> 	

<h1>Configuracion de compras</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>