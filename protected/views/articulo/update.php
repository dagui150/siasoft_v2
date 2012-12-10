<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Articulos'=>array('admin'),
	$model->NOMBRE=>array('view','id'=>$model->ARTICULO),
	'Actualizar',
);

?>

<h1>Actualizar Articulo "<?php echo $model->NOMBRE; ?>"</h1>

<?php echo $this->renderPartial('_form2', 
            array(
                'model'=>$model,
                'conf'=>$conf,
                'lineas'=>$lineas,
                'tipo'=>$tipo,
                'bodega'=>$bodega,
                'impuesto'=>$impuesto,
                'retencion'=>$retencion,
             )
      ); ?>