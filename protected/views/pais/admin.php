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

<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'pais-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'CODIGO_ISO',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADIO_EL',
		*/

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