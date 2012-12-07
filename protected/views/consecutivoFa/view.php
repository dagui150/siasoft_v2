<?php
$this->breadcrumbs=array(
        'Facturación'=>array('admin'),
	'Consecutivos'=>array('admin'),
	$model->CODIGO_CONSECUTIVO,
);
?>

<h1>Ver Consecutivo "<?php echo $model->CODIGO_CONSECUTIVO; ?>"</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CODIGO_CONSECUTIVO',
                array(
                    'name'=>'FORMATO_IMPRESION',
                    'label'=>'Formato de Impresión',
                    'value'=>isset($model->fORMATOIMPRESION->NOMBRE) ? $model->fORMATOIMPRESION->NOMBRE : ""
                ),
		'DESCRIPCION',
                array(
                    'name'=>'TIPO',
                    'value'=>$model->TIPO == 'N' ? 'Numérico' : 'Alfanumérico'
                ),
		'LONGITUD',
		'VALOR_CONSECUTIVO',
		'MASCARA',
                array(
                    'name'=>'USA_DESPACHOS',
                    'value'=>$model->USA_DESPACHOS == '1' ? 'Si' : 'No'
                ),
                array(
                    'name'=>'USA_ESQUEMA_CAJAS',
                    'value'=>$model->USA_ESQUEMA_CAJAS == '1' ? 'Si' : 'No'
                ),
		'VALOR_MAXIMO',
		'NUMERO_COPIAS',
		'ORIGINAL',
		'RESOLUCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
	),
)); ?>
