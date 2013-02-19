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
?>

<h1>Bodegas</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<?php 
if(isset($alerta)){
    Yii::app()->user->setFlash('info', $alerta);
 } 
 
if(isset($_GET['mensaje'])){ ?>
<div class="alert alert-<?php echo $_GET['tipo']; ?>"><a class="close" data-dismiss="alert">×</a><?php echo base64_decode($_GET['mensaje']); ?></div>
<?php } 
$this->widget('bootstrap.widgets.TbAlert');
?>

<div align="right">

    <?php $this->darBotonPdfExcel(array('bodega/excel')); ?>
    <?php $this->darBotonPdfExcel(array('bodega/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
    
</div>
<?php

     $this->widget('bootstrap.widgets.TbGridView', array(
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
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'afterDelete'=>$this->mensajeBorrar(),
		),

	),
)); ?>


<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Bodega</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
    <?php $this->endWidget(); ?>