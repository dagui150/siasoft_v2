<?php
$this->breadcrumbs=array(
	'Articulo Multimedias'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar ArticuloMultimedia', 'url'=>array('index')),
	array('label'=>'Administrar ArticuloMultimedia', 'url'=>array('admin')),
);
?>

<h1>Crear Articulo Multimedia</h1>


<?php 

    
    echo $this->renderPartial('_form', 
            array(
                'model'=>$model,
		'articulo'=>$articulo,
		'barticulo'=>$barticulo,
            )
        );
  ?>