<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Documento";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Documentos'=>array('admin'),
	$model->DOCUMENTO_INV,
);
?>

<h1>Ver Documento "<?php echo $model->DOCUMENTO_INV; ?>"</h1>
<?php 
if (isset($_GET['men'])){
    SBaseController::mensaje($_GET['men']);
}
?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'DOCUMENTO_INV',
		'CONSECUTIVO',
		'FECHA_DOCUMENTO',
		'REFERENCIA',
		'ESTADO',
		/*'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',*/
	),
)); ?>
