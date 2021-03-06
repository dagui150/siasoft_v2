<?php $this->pageTitle=Yii::app()->name." - Tipo de Tarjeta";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Tipo de Tarjeta',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoTarjeta', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoTarjeta', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tipo-tarjeta-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Tipo Tarjeta</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('tipoTarjeta/excel')); ?>
    <?php $this->darBotonPdfExcel(array('tipoTarjeta/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'tipo-tarjeta-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		'DESCRIPCION',
		/*'ACTIVO',
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

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Tipo Tarjeta</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
    <?php $this->endWidget(); ?>