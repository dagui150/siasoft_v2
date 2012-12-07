<script>
function obtenerSeleccion(){
    var idcategoria = $.fn.yiiGridView.getSelection('ingreso-compra-grid');
    $('#check').val(idcategoria);
}

function cargando(){
    $("#cargando").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
}

function completado(){
    $.fn.yiiGridView.update('ingreso-compra-grid');
}

function reescribir(){
    $('.close').click();
    $('#alert').remove();
    $('#form-cargado').slideDown('slow');
    $('#boton-cargado').remove();   
    $.fn.yiiGridView.update('ingreso-compra-grid');
}

$(document).ready(function(){
    $("#continuar").click(function (e) {
    $.ajax({
        'beforeSend':cargando(),
        'url':'<?php echo $this->createUrl('/IngresoCompra/aplicar') ?>&pasar='+$('#check').val(),
        'cache':false,
        'success':function(html){jQuery("#cargando").html(html)}});
    });
});

function buscar(){}
</script>
<?php $this->pageTitle=Yii::app()->name." - Ingreso Compras";?>
<?php
/* @var $this IngresoCompraController */
/* @var $model IngresoCompra */
if(!ConfCo::darConf())
     $this->redirect(array('/confCo/create'));
$this->breadcrumbs=array(
	'Ingreso Compras'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' IngresoCompra', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' IngresoCompra', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ingreso-compra-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Ingreso de Compras</h1>
<br />
<div id="mensaje"></div>
<div align="right">
    
    <?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array()); ?>
    <?php echo CHtml::HiddenField('check',''); ?>
    
      
<?php 
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Cancelar',
        'buttonType'=>'ajaxSubmit',
        'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini', // '', 'large', 'small' or 'mini'
        'url' => array('cancelar'),
        'icon' => 'remove white',
        'ajaxOptions'=>array(
            'type'=>'POST',
            'update'=>'#mensaje',
            'complete'=>'completado()',
        ),
        'htmlOptions'=>array('confirm'=>'¿Está seguro que desea cancelar este(os) ingreso(s)?', 'id'=>'cancelar'),
    ));
?>
    
<?php 
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Recibir',
        'buttonType'=>'ajaxSubmit',
        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini', // '', 'large', 'small' or 'mini'
        'icon' => 'share-alt white',
        'url' => array('listar'),
        'ajaxOptions'=>array(
            'type'=>'POST',
            'update'=>'#respuesta',
            'complete'=>'completado()',
        ),
        'htmlOptions'=>array('onclick'=>'$("#advertencia").modal();')
    ));
?>
    
<?php
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Nuevo',
        'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini', // '', 'large', 'small' or 'mini'
            'url' => array('ingresoCompra/create'),
            'icon' => 'plus white',
    )); 
    $this->endWidget(); 
?>
    
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'ingreso-compra-grid',
        'selectableRows'=>2,
        'selectionChanged'=>'obtenerSeleccion',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array('class'=>'CCheckBoxColumn'),
		'INGRESO_COMPRA',
                array(
                    'name'=>'PROVEEDOR',
                    'type'=>'text',
                    'filter' => CHtml::listData(Proveedor::model()->findAll(), 'PROVEEDOR', 'NOMBRE'),
                    'value'=>'$data->pROVEEDOR->NOMBRE'
                ),
		//'PROVEEDOR',
		'FECHA_INGRESO',
		//'TIENE_FACTURA',
                array(
                    'name'=>'ESTADO',
                    'header'=>'Estado',
                    'filter'=>array('P'=>'Planeado','R'=>'Recibido','C'=>'Cancelado'),
                    'value'=>'IngresoCompra::estado($data->ESTADO)',
                ),
                //'ESTADO',
                'APLICADO_POR',
		'APLICADO_EL',
		/*
                'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'NOTAS',
		'ESTADO',
		'CANCELADO_POR',
		'CANCELADO_EL',
		'CREADO_POR',
		'CREADO_EL',
		'MODIFICADO_POR',
		'MODIFICADO_EL',
		*/
            array(
                         'class'=>'CLinkColumn',
			 //'header'=>'Bodegas',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/pdf.png',
			 //'labelExpression'=>'$data->ID',
			 'urlExpression'=>'CController::createUrl("/ingresoCompra/formatoPDF", array("id"=>$data->INGRESO_COMPRA))',
			 'htmlOptions'=>array('style'=>'text-align:center;'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'PDF', 'target'=>'_blank'),
                ),
	),
        
)); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'advertencia')); ?>
        
<div class="modal-header"><a class="close" data-dismiss="modal">&times;</a></div>
<div id="cargando">
        <?php $this->renderPartial('_aplicar'); ?>
    </div>
 <?php $this->endWidget(); ?>