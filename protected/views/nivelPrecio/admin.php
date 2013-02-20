<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Nivel de Precios',
);

$this->menu=array(
	array('label'=>'List NivelPrecio', 'url'=>array('index')),
	array('label'=>'Create NivelPrecio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('nivel-precio-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Nivel de Precios</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('nivelPrecio/excel')); ?>
    <?php $this->darBotonPdfExcel(array('nivelPrecio/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'nivel-precio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'DESCRIPCION',
		
                array(
                        'name'=>'ESQUEMA_TRABAJO',
                        'header'=>'Esquema de trabajo',
                        'value'=>'NivelPrecio::tipo($data->ESQUEMA_TRABAJO)',
                        'filter'=>array('NORM'=>'Normal','MULT'=>'Multiplicador', 'MARG' => 'Margen'),
                    ),
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
    <h3>Crear Nivel de Precio</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
<?php $this->endWidget(); ?>