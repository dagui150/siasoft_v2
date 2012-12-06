<?php
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Clientes'=>array('admin'),
	$model->CLIENTE=>array('view','id'=>$model->CLIENTE),
	'Actualizar',
);

?>

<h1>Actualizar Cliente <?php echo $model->CLIENTE; ?></h1>

<?php echo $this->renderPartial('_form',
        array(
            'model'=>$model,
            'nit'=>$nit,
            'impuesto'=>$impuesto,
            'regimen'=>$regimen,
        )
     ); ?>