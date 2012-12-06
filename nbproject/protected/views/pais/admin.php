<?php
$this->breadcrumbs=array(
	Yii::t('app','COUNTRIES')=>array('admin'),
	Yii::t('app','MANAGE'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','COUNTRY'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','COUNTRY'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pais-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app','COUNTRIES'); ?></h1>

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
	'url' => array('pais/index'),
	'icon' => 'list-alt white'
)); 

?>

	<?php 

	$this->widget('bootstrap.widgets.BootButton', array(
		'label'=>'Nuevo',
		'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'size'=>'mini', // '', 'large', 'small' or 'mini'
		'icon' => 'plus white',
		'url'=>'#myModal',
		'htmlOptions'=>array('data-toggle'=>'modal')
	)); 

	?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pais-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'CODIGO_ISO',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		/*
		'ACTUALIZADO_POR',
		'ACTUALIZADIO_EL',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Pais</h3>
    
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