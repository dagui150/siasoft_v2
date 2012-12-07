<?php $this->pageTitle=Yii::app()->name." - Formato Impresion";?>
<?php
/* @var $this FormatoImpresionController */
/* @var $model FormatoImpresion */



$this->breadcrumbs=array(
	'Sistema'=>array('admin'),
	'Administración de Reportes',
);

$this->menu=array(
    array('label'=>Yii::t('app','LIST'). 'FormatoImpresion', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE'). 'FormatoImpresion', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('formato-impresion-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administración de Reportes</h1>

<div align="right">
    <?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label' => 'Nuevo',
        'type' => 'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size' => 'mini', // '', 'large', 'small' or 'mini'
        'url' => '#myModal',
        'icon' => 'plus white',
		'htmlOptions'=>array('data-toggle'=>'modal')
    ));
    ?>
</div>


<?php $this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
	'id'=>'formato-impresion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'NOMBRE',
		'OBSERVACION',
                array(
                    'name'=>'MODULO',
                    'value'=>'FormatoImpresion::getModulo($data->MODULO)',
                ),
		'SUBMODULO',
		'RUTA',
		/*
		'TIPO',
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




<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Crear Formato de Impresion</h3>
    <p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class='required'> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.
</p>
</div>

<?php $this->renderPartial('_form', array('model2'=>$model2)); ?>
 
<?php $this->endWidget(); ?>




