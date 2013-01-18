<?php $this->pageTitle=Yii::app()->name." - Entidad Financiera";?>
<?php
$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Entidad Financiera',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' EntidadFinanciera', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' EntidadFinanciera', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('entidad-financiera-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Entidades Financieras</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('entidadFinanciera/excel')); ?>
    <?php $this->darBotonPdfExcel(array('entidadFinanciera/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'entidad-financiera-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NIT',
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
    <h3>Crear Entidad financiera</h3>
    
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2, 'nit'=>$nit)); ?>
    <?php $this->endWidget(); ?>
