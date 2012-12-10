<?php
$this->breadcrumbs=array(
	'Entidad Financiera'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'List EntidadFinanciera', 'url'=>array('index')),
	array('label'=>'Create EntidadFinanciera', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('entidad-financiera-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Entidades Financieras</h1>

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
	'id'=>'entidad-financiera-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NIT',
		'DESCRIPCION',
		/*'ACTIVO',
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
    <h3>Crear Entidad financiera</h3>
    
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2, 'nit'=>$nit)); ?>
    <?php $this->endWidget(); ?>
