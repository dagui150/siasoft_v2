<?php
$this->breadcrumbs=array(
	'Unidad Medidas'=>array('index'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('unidad-medida-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<h1>Unidades de Medida</h1>

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
	'url' => array('index'),
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
<?php 
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'unidad-medida-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'ID',
			'NOMBRE',
			'ABREVIATURA',
			'TIPO',
			'UNIDAD_BASE',
			'EQUIVALENCIA',
			/*
			'ACTIVO',
			'CREADO_POR',
			'CREADO_EL',
			'ACTUALIZADO_POR',
			'ACTUALIZADO_EL',
			*/
			array(
				'class'=>'CButtonColumn',
			),
		),
	));
	$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Unidad</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
	 
	<div class="modal-body">
		<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'label'=>'Cerrar',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
		)); ?>
	</div>
 
<?php $this->endWidget(); ?>
