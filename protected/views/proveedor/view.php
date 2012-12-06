<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Proveedor";?>
<?php
$this->breadcrumbs=array(
	'Proveedor'=>array('admin'),
	$model->PROVEEDOR,
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Proveedor', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Proveedor', 'url'=>array('create')),
	array('label'=>Yii::t('app','UPDATE').' Proveedor', 'url'=>array('update', 'id'=>$model->PROVEEDOR)),
	array('label'=>Yii::t('app','DELETE').' Proveedor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->PROVEEDOR),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app','MANAGE').' Proveedor', 'url'=>array('admin')),
);
?>

<h1>Ver Proveedor # <?php echo $model->PROVEEDOR; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'PROVEEDOR',
		'CATEGORIA',
		'NOMBRE',
		'ALIAS',
		'CONTACTO',
		'CARGO',
		'DIRECCION',
		'EMAIL',
		'FECHA_INGRESO',
		'TELEFONO1',
		'TELEFONO2',
		'FAX',
		'NIT',
		'CONDICION_PAGO',
		/*'ACTIVO',
		'ORDEN_MINIMA',
		'DESCUENTO',
		'TASA_INTERES_MORA',*/
	),
)); ?>
