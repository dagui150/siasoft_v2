<?php
$this->breadcrumbs=array(
	'Orden Compra Líneas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar OrdenCompraLinea', 'url'=>array('index')),
	array('label'=>'Administrar OrdenCompraLinea', 'url'=>array('admin')),
);
?>

<h1>Crear OrdenCompraLinea</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>