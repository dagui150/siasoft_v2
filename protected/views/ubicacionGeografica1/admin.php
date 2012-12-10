<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 1'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'List UbicacionGeografica1', 'url'=>array('index')),
	array('label'=>'Create UbicacionGeografica1', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ubicacion-geografica1-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Departamento</h1>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'ubicacion-geografica1-grid',
        'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'PAIS',
		'NOMBRE',
		//'ACTIVO',
		//'CREADO_POR',
		//'CREADO_EL',
		/*
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Ubicacion Geografica 1</h3>
    
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