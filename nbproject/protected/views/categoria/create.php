<?php
$this->breadcrumbs=array(
	'Categorias'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List Categoria', 'url'=>array('index')),
	array('label'=>'Manage Categoria', 'url'=>array('admin')),
);
?>

<h1>Crear Categoria</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>