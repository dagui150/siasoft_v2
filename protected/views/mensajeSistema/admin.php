<?php $this->pageTitle=Yii::app()->name." - Mensajes del Sistema";?>
<?php
/* @var $this MensajeSistemaController */
/* @var $model MensajeSistema */

$this->breadcrumbs=array(
	'Mensaje Sistemas'=>array('admin'),
	'Mensaje Sistemas',
);

$this->menu=array(
        array('label'=>Yii::t('app','LIST').' MensajeSistema', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' MensajeSistema', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mensaje-sistema-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administración Mensaje Sistemas</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<br>
<div align="right">
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

<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'mensaje-sistema-grid',
        'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CODIGO',
		'TIPO',
		'MENSAJE',
		/*
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'afterDelete'=>$this->mensajeBorrar(),
		),
	),
)); 
 ?>

     <?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Mensaje</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
    
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
 <?php $this->endWidget(); ?>