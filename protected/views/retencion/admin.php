<?php $this->pageTitle=Yii::app()->name." - Retenciones";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Retenciones',
);

$this->menu=array(
	array('label'=>'Listar Retención', 'url'=>array('index')),
	array('label'=>'Crear Retención', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('retencion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Retenciones</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('retencion/excel')); ?>
    <?php $this->darBotonPdfExcel(array('retencion/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo(array('retencion/create'),false,'mini'); ?>
</div>

<?php  $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'retencion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'PORCENTAJE',
		'MONTO_MINIMO',
		//'TIPO',
		//'APLICA_MONTO',
		/*
		'APLICA_SUBTOTAL',
		'APLICA_SUB_DESC',
		'APLICA_IMPUESTO1',
		'APLICA_RUBRO1',
		'APLICA_RUBRO2',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'afterDelete'=>$this->mensajeBorrar(),
		),
	),
)); ?>