<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Consecutivos'=>array('admin'),
	$model->DESCRIPCION,
);
?>

<h1>Ver Consecutivo "<?php echo $model->DESCRIPCION; ?>"</h1>
<BR>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'FORMATO_IMPRESION',
		'DESCRIPCION',
		'MASCARA',
		'SIGUIENTE_VALOR',
                array(
                    'name'=>'TODOS_USUARIOS',
                    'value'=>$model->TODOS_USUARIOS == 'S' ? 'Si' : 'No'
                ),
	),
)); ?>
