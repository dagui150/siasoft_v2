<?php $this->pageTitle=Yii::app()->name." - Zonas";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Zonas',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Zona', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' Zona', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('zona-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Zonas</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    
            <?php 

$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'EXCEL',
    'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('zona/excel'),
	'icon' => 'download-alt white'
)); 

?>
    
<?php 


$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'PDF',
    'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('zona/pdf'),
	'icon' => 'download-alt white'
)); 

?>

<?php 

$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'icon' => 'plus white',
	'url'=>'#myModal',
	'htmlOptions'=>array('data-toggle'=>'modal')
)); 

?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'zona-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'ID',
            array(
                'name'=>'PAIS',
                'value'=>'$data->pAIS->NOMBRE',
            ),
		'NOMBRE',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'htmlOptions'=>array('style'=>'width: 50px'),
                'afterDelete'=>$this->mensajeBorrar(),
            ),
        ),
)); ?>
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Zona</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>
    
</div>

    <?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
 
<?php $this->endWidget(); ?>