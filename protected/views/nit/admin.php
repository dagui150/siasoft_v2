

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
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('nit/excel')); ?>
    <?php $this->darBotonPdfExcel(array('nit/pdf'), false, 'PDF', 'danger'); ?>
    <?php $this->darBotonNuevo(array('nit/create'),false,'mini'); ?>

</div>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
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
                    'class' => 'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions' => array('style' => 'width: 50px'),
                    'afterDelete'=>$this->mensajeBorrar(),
        ),
	),
)); ?>

