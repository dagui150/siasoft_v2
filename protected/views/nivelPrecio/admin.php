<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Nivel de Precios',
);

$this->menu=array(
	array('label'=>'List NivelPrecio', 'url'=>array('index')),
	array('label'=>'Create NivelPrecio', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('nivel-precio-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Nivel de Precios</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php 

		$this->widget('bootstrap.widgets.BootButton', array(
		'label'=>'EXCEL',
		'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'size'=>'mini', // '', 'large', 'small' or 'mini'
		'url' => array('nivelPrecio/excel'),
		'icon' => 'download-alt white'
		)); 

	?>
    
             <?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'PDF',
    'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('nivelPrecio/pdf'),
	'icon' => 'download-alt white'
)); 

?>
        
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
	'id'=>'nivel-precio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'DESCRIPCION',
		
                array(
                        'name'=>'ESQUEMA_TRABAJO',
                        'header'=>'Esquema de trabajo',
                        'value'=>'NivelPrecio::tipo($data->ESQUEMA_TRABAJO)',
                        'filter'=>array('NORM'=>'Normal','MULT'=>'Multiplicador', 'MARG' => 'Margen', 'MARK' => 'Markup'),
                    ),
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'afterDelete'=>$this->mensajeBorrar(),
		),
	),
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Nivel de Precio</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
<?php $this->endWidget(); ?>