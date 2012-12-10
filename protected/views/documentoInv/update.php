<?php
Yii::import('application.extensions.bootstrap.widgets.*');
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Documentos'=>array('admin'),
	$model->DOCUMENTO_INV=>array('view','id'=>$model->DOCUMENTO_INV),
	'Actualizar',
);
?>

<h1>Actualizar Documento "<?php echo $model->DOCUMENTO_INV; ?>"</h1>

<?php echo $this->renderPartial('_form',
        array(
            'model'=>$model,
            'modelLi'=>$modelLi,
            'modelLinea'=>$modelLinea,
            'countLineas'=>$countLineas,
            'bodega'=>$bodega,
            'articulo'=>$articulo,
            'ruta'=>$ruta,
        )
     ); ?>