<?php
$this->breadcrumbs=array(
	'Impuestos'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('impuesto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Impuestos</h1>
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
	'id'=>'impuesto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'PROCENTAJE',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
                                'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
)); ?>
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Impuesto</h3>
    <p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
    <?php $this->endWidget(); ?>