<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Articulos'=>array('admin'),
	'Crear',
);

?>

<h1>Crear Articulo</h1>

<?php 
        echo $this->renderPartial('_form',
                                array(
                                      'model'=>$model,
                                      'tipo'=>$tipo,
                                      'conf'=>$conf,
                                      'bodega'=>$bodega,
                                      'impuesto'=>$impuesto,
                                      'retencion'=>$retencion,
                                     )
        );
        
?>