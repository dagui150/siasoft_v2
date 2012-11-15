<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Artículo Multimedias";?>
<?php
$this->breadcrumbs=array(
	'Artículo Multimedias'=>array('admin'),
	$model->ID,
);

?>

<h1>Ver ArticuloMultimedia #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'ARTICULO',
		'TIPO',
		'UBICACION',
		'NOMBRE',
		'DESCRIPCION',
		'ORDEN',
            /*
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
             * 
             */
	),
)); ?>
