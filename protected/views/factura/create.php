<?php
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Facturas'=>array('admin'),
	'Crear',
);

?>

<h1>Crear Factura</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'linea'=>$linea, 'cliente'=>$cliente, 'articulo'=>$articulo, 'conf'=>$conf, 'ruta'=>$ruta,'ruta2'=>$ruta2,)); ?>