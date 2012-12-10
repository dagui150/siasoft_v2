<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Tipos de Transacción'=>array('admin'),
	$model2->TIPO_TRANSACCION=>array('view','id'=>$model2->TIPO_TRANSACCION),
	'Actualizar',
);

?>

<h1>Actualizar Tipo de Transacción "<?php echo $model2->TIPO_TRANSACCION; ?>"</h1>

<?php echo $this->renderPartial('_form', 
        array(
		'model2'=>$model2,
		'subTipo'=>$subTipo,
		'cantidad'=>$cantidad,
	)
      ); ?>