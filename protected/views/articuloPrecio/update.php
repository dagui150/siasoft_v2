<?php
$this->breadcrumbs=array(
	'Articulo Precios'=>array('admin'),
);
?>

<h1>Precios de articulos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'precios'=>$precios, 'articulo'=>$articulo, 'cargar'=>$cargar)); ?>