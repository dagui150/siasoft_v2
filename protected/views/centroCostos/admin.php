<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Centro de Costos',
);

$this->menu=array(
	array('label'=>'List CentroCostos', 'url'=>array('index')),
	array('label'=>'Create CentroCostos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('centro-costos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Centro de Costos</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    
    <?php $this->darBotonPdfExcel(array('centroCostos/excel')); ?>
    <?php $this->darBotonPdfExcel(array('centroCostos/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>

</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'centro-costos-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'DESCRIPCION',
		array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>'CentroCostos::tipo($data->TIPO)',
                        'filter'=>array('G'=>'Gasto','I'=>'Ingreso','A'=>'Ambos'),
                    ),
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
    <h3>Crear Centro de Costos</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

<?php echo $this->renderPartial('_form', array('model2'=>$model2, 'config'=>$config)); ?>

<?php $this->endWidget(); ?>