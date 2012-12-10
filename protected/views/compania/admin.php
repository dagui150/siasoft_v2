<?php
$this->breadcrumbs=array(
	Yii::t('app','COMPANIES')=>array('admin'),
	Yii::t('app','MANAGE'),
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' '.Yii::t('app','COMPANY'), 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' '.Yii::t('app','COMPANY'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('compania-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('app','COMPANIES'); ?></h1>

<div align = "right">
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Listar',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('compania/index'),
	'icon' => 'list-alt white'
)); 

?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'compania-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'NOMBRE_ABREV',
		'NIT',
		'UBICACION_GEOGRAFICA1',
		'UBICACION_GEOGRAFICA2',
		/*
		'PAIS',
		'DIRECCION',
		'TELEFONO1',
		'TELEFONO2',
		'LOGO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'template'=>'{view}',
		),
	),
)); ?>
