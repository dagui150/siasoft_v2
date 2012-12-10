<?php $this->pageTitle=Yii::app()->name." - Tipos de Contrato";?>
<?php
/* @var $this TipoContratoController */
/* @var $model TipoContrato */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Contrato',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoContrato', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoContrato', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('tipo-contrato-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Tipos de Contrato</h1>
<div align="right">
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => '#myModal',
	'icon' => 'plus white',
        'htmlOptions'=>array('data-toggle'=>'modal')
)); 

?>
</div>


<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
	'id'=>'tipo-contrato-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'TIPO_CONTRATO',
		'NOMBRE',
		
		 array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
	),
)); ?>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Tipo de Contrato</h3>
    <p class="note"><?php echo Yii::t('app', 'FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app', 'ARE_REQUIRED'); ?>.</p>
</div>

<?php $this->renderPartial('_form', array('model2' => $model2)); ?>



<?php $this->endWidget(); ?>

