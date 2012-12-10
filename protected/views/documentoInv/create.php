<?php

Yii::import('application.extensions.bootstrap.widgets.*');

$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Documentos'=>array('admin'),
	'Crear',
);

?>

<h1>Crear Documento</h1>

<?php echo $this->renderPartial('_form',
        array(
            'model'=>$model,
            'modelLi'=>$modelLi,
            'bodega'=>$bodega,
            'articulo'=>$articulo,
            'ruta'=>$ruta,
        )
     ); ?>