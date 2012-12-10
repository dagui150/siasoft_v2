<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Consecutivos'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

?>

<h1>Actualizar Consecutivo  <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', 
            array(
                'model2'=>$model2,
		'tipos'=>$tipos,
		'usuarios'=>$usuarios,
            )
     ); 
?>