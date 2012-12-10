<?php
$this->breadcrumbs=array(
	'Inventario'=>array('articulo/admin'),
	'Existencia Bodegas'=>array('create', 'id'=>$model->ARTICULO),
	'Actualizar',
);
?>

<h1>Actualizar ExistenciaBodega </h1>

<?php echo $this->renderPartial('_form', array(
            'model'=>$model,
            'model2'=>$model2,
            'articulo'=>$articulo,
            'barticulo'=>$barticulo,
            'bodega'=>$bodega,
    )); ?>