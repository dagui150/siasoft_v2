<?php $this->pageTitle=Yii::app()->name." - Impuestos";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Impuestos',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('impuesto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Impuestos</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('impuesto/excel')); ?>
    <?php $this->darBotonPdfExcel(array('impuesto/pdf'), false, 'PDF', 'danger'); ?>
    <?php //$this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'impuesto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'PROCENTAJE',
//		array(
//                    'class'=>'bootstrap.widgets.TbButtonColumn',
//                    'htmlOptions'=>array('style'=>'width: 50px'),
//                    'afterDelete'=>$this->mensajeBorrar(),
//		),
	),
)); ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Impuesto</h3>
    <p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
    <?php $this->endWidget(); ?>