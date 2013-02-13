<?php $this->pageTitle=Yii::app()->name." - Días Feriados";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Días Feriados',
);

?>

<h1>Días Feriados</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('diaFeriado/excel')); ?>
    <?php $this->darBotonPdfExcel(array('diaFeriado/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'dia-feriado-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
		array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>'DiaFeriado::tipo($data->TIPO)',
                        'filter'=>array('F'=>'Fijo','V'=>'Variable'),
                    ),
		'DIA',
		'MES',
		'ANIO',
		'DESCRIPCION',
		/*
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

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Día feriado</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>

<?php $this->endWidget(); ?>