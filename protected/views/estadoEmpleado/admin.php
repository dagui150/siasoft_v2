<?php $this->pageTitle=Yii::app()->name." - Estados de Empleado";?>
<?php
/* @var $this EstadoEmpleadoController */
/* @var $model EstadoEmpleado */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Estados de Empleado',
);

$this->menu=array(
	array('label'=>'Listar Estados de Empleado', 'url'=>array('index')),
	array('label'=>'Crear Estados de Empleado', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('estado-empleado-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Estado Empleados</h1>



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
     'type'=>'striped bordered condensed',
	'id'=>'estado-empleado-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ESTADO_EMPLEADO',
		'DESCRIPCION',
		array(
                    'name'=>'PAGO',
                    'value'=>'EstadoEmpleado::getPago($data->PAGO)',
                    'filter'=>array('S'=>'Si','N'=>'No'),
                ),
            array(
                    'name'=>'TEMPORAL',
                    'value'=>'EstadoEmpleado::getTemporal($data->TEMPORAL)',
                    'filter'=>array('S'=>'Si','N'=>'No'),
                ),
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
		),
	),
)); ?>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Estado de Empleado</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

    <?php $this->renderPartial('_form', array('model2'=>$model2)); ?>
    
        
        
        <?php $this->endWidget(); ?>

