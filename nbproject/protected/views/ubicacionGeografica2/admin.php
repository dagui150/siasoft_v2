<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 2'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'List UbicacionGeografica2', 'url'=>array('index')),
	array('label'=>'Create UbicacionGeografica2', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ubicacion-geografica2-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Ubicacion Geografica 2</h1>

<?php echo CHtml::link(Yii::t('app','ADVANCED_SEARCH'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<div align="right">
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Listar',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('ubicacionGeografica2/index'),
	'icon' => 'list-alt white'
)); 

?>

<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Nuevo',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('ubicacionGeografica2/create'),
	'icon' => 'plus white',
	'url'=>'#myModal',
	'htmlOptions'=>array('data-toggle'=>'modal')
)); 

?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ubicacion-geografica2-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'UBICACION_GEOGRAFICA1',
		'NOMBRE',
		//'ACTIVO',
		//'CREADO_POR',
		//'CREADO_EL',
		/*
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Ubicacion Geografica 2</h3>
    
</div>

<div class="modal-body">
    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
</div>

<div class="modal-footer">

    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>