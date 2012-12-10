<?php
$this->breadcrumbs=array(
	'Clasific Adi Articulos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ClasificAdiArticulo', 'url'=>array('index')),
	array('label'=>'Administrar ClasificAdiArticulo', 'url'=>array('admin')),
);
?>

<h1>Crear ClasificAdiArticulo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>