<?php $this->pageTitle=Yii::app()->name." - Impuestos";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Impuestos',
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
<?php 
if (isset($_GET['men'])){
    SBaseController::mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    
    	<?php 

		$this->widget('bootstrap.widgets.BootButton', array(
		'label'=>'EXCEL',
		'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'size'=>'mini', // '', 'large', 'small' or 'mini'
		'url' => array('impuesto/excel'),
		'icon' => 'download-alt white'
		)); 

	?>
    
     <?php 

    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'PDF',
        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('impuesto/pdf'),
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
                    'afterDelete'=>SBaseController::mensajeBorrar(),
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