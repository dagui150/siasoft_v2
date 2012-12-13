

<?php $this->pageTitle=Yii::app()->name.' - Nit';

$this->breadcrumbs=array(
	'Sistema'=>array('admin'),
	'Nits',
);

$this->menu=array(

    array('label'=>Yii::t('app','LIST'). 'Nit', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE'). 'Nit', 'url'=>array('create')),
	
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('nit-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Nits</h1>

<div align="right">
        <?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'EXCEL',
    'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('nit/excel'),
	'icon' => 'download-alt white'
)); 

?>
    
     <?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'PDF',
    'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('nit/pdf'),
	'icon' => 'download-alt white'
)); 

?>
    
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Nuevo',
        'type' => 'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'mini', // '', 'large', 'small' or 'mini'
        'url' => array('nit/create'),
        'icon' => 'plus white'
    ));
    ?>
</div>


<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
	'id'=>'nit-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'TIIPO_DOCUMENTO',
		'RAZON_SOCIAL',
		'ALIAS',
		'OBSERVACIONES',
		/*
                'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
            'class' => 'bootstrap.widgets.BootButtonColumn',
            'htmlOptions' => array('style' => 'width: 50px'),
        ),
	),
)); ?>

