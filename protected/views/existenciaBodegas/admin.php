<?php $this->pageTitle=Yii::app()->name." - Existencias en Bodegas";?>
<?php
$this->breadcrumbs=array(
        'Bodegas'=>array('bodega/inventario'),
	'Inventario de Bodega'=>array('admin', 'id'=>$bodega),
	$bodega,
);

$this->menu=array(
        array('label'=>Yii::t('app','LIST').' ExistenciaBodegas', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' ExistenciaBodegas', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('existencia-bodega-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Inventario de Bodegas "<?php echo $bodega.' - '.$bbodega->DESCRIPCION?>"</h1>
<?php 
if (isset($_GET['men'])){
    SBaseController::mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<br>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'existencia-bodega-grid',
	'dataProvider'=>$model2->search2($bodega),
	'filter'=>$model2,
	'columns'=>array(
		//'ID',
		'ARTICULO',
		'BODEGA',
		'EXISTENCIA_MINIMA',
		'EXISTENCIA_MAXIMA',
		'PUNTO_REORDEN',
		'CANT_DISPONIBLE',
		'CANT_RESERVADA',
		'CANT_REMITIDA',
		/*
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'afterDelete'=>SBaseController::mensajeBorrar(),
		),
		*/
	),
)); ?>

<?php
//$this->renderPartial('nuevo', array('form'=>$form, 'linea'=>$linea, 'model'=>$model),true);
?>
