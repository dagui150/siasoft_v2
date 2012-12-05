<script>
function completado(){
    $.fn.yiiGridView.update('bodega-grid');
}
</script>
<?php $this->pageTitle=Yii::app()->name." - Bodegas";?>

<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Bodegas',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Bodega', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Bodega', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bodega-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Bodegas</h1>
<br>
<?php 
if(isset($alerta)){
    Yii::app()->user->setFlash('info', $alerta);
 } 
 
if(isset($_GET['mensaje'])){ ?>
<div class="alert alert-<?php echo $_GET['tipo']; ?>"><a class="close" data-dismiss="alert">×</a><?php echo base64_decode($_GET['mensaje']); ?></div>
<?php } 
$this->widget('bootstrap.widgets.BootAlert');
?>

<div align="right">

<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'EXCEL',
    'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	//'url' => array('bodega/excel'),
    'url' => array('bodega/prueba'),
	'icon' => 'download-alt white'
)); 
?>
    
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'PDF',
    'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('bodega/pdf'),
	'icon' => 'download-alt white'
)); 

?>
    
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'icon' => 'plus white',
	'url'=>'#myModal',
	'htmlOptions'=>array('data-toggle'=>'modal')
)); 

?>
</div>
<?php

     $this->widget('bootstrap.widgets.BootGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'bodega-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'DESCRIPCION',
		array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>'Bodega::tipo($data->TIPO)',
                        'filter'=>array('C'=>'Consumo','V'=>'Ventas','N'=>'No Disponible',''=>'Todos'),
                    ),
		'TELEFONO',
		'DIRECCION',
		//'ACTIVO',
		/*
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
		),

	),
)); ?>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Bodega</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
    <?php $this->endWidget(); ?>