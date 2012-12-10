<script>
function obtenerSeleccion(){

    var idcategoria = $.fn.yiiGridView.getSelection('orden-compra-grid');
    $('#check').val(idcategoria);
}

function ocultarMensajes(){
    $("#fade").fadeOut(1500, function(){
        //$("#success").removeClass("alert alert-success");
    $("#success").text("");
    //$("#info").removeClass("alert alert-info");
    $("#info").text("");
    //$("#warning").removeClass("alert alert-info");
    $("#warning").text("");
    //$("#error").removeClass("alert alert-error");
    $("#error").text("");
    });
}

$(document).ready(inicio)

function inicio(){
    var accion;
    var a = 0;
    
    accion = $("#cancelar");
    accion.click(cancelar);
    
    accion = $("#autorizar");
    accion.click(autorizar);
    
    accion = $("#rever");
    accion.click(reversar);
    
    accion = $("#cerrar");
    accion.click(cerrar);
}

function cancelar(){
    var id = $('#check').get(0).value;
    $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/Cancelar'); ?>&buscar='+id,
            function (data){
                $("#fade").fadeIn(1500);
                $.fn.yiiGridView.update('orden-compra-grid');
                $("#success").addClass("alert alert-success");
                $("#success").text(data.exito + " ordenes se cancelaron con exito.");
                $("#info").addClass("alert alert-info");
                $("#info").text(data.info + " ordenes ya se encontraban con estado cancelado.");
                $("#warning").addClass("alert alert-warning");
                $("#warning").text("0 Advertencias");  
                $("#error").addClass("alert alert-error");
                $("#error").text(data.error + " ordenes no pudieron ser canceladas.");             
            });
}

function cerrar(){
    var id = $('#check').get(0).value;
    $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/Cerrar'); ?>&buscar='+id,
            function (data){
                $("#fade").fadeIn(1500);
                $.fn.yiiGridView.update('orden-compra-grid');
                $("#success").addClass("alert alert-success");
                $("#success").text(data.exito + " ordenes se cerraron con exito.");
                $("#info").addClass("alert alert-info");
                $("#info").text(data.info + " ordenes ya se encontraban con estado cerrado.");
                $("#warning").addClass("alert alert-warning");
                $("#warning").text("0 Advertencias");                
                $("#error").addClass("alert alert-error");
                $("#error").text(data.error + " ordenes no pudieron ser cerradas.");             
            });
}

function autorizar(){
    var id = $('#check').get(0).value;
    $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/Autorizar'); ?>&buscar='+id,
            function (data){
                $("#fade").fadeIn(1500);
                $.fn.yiiGridView.update('orden-compra-grid');
                $("#success").addClass("alert alert-success");
                $("#success").text(data.exito + " ordenes se autorizaron con exito.");
                $("#info").addClass("alert alert-info");
                $("#info").text(data.info + " ordenes ya se encontraban con estado autorizado o no asignado.");
                $("#warning").addClass("alert alert-warning");
                $("#warning").text(data.advertencia + " ordenes se encontraban en estado cancelar o cerrada por tanto no se puede autorizar.");
                $("#error").addClass("alert alert-error");
                $("#error").text(data.error + " ordenes no pudieron ser autorizadas.");             
            });
}

function reversar(){
    var id = $('#check').get(0).value;
    $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/Reversar'); ?>&buscar='+id,
            function (data){
                $("#fade").fadeIn(1500);
                $.fn.yiiGridView.update('orden-compra-grid');
                $("#success").addClass("alert alert-success");
                $("#success").text(data.exito + " ordenes se reversaron con exito.");
                $("#info").addClass("alert alert-info");
                $("#info").text(data.info + " ordenes ya se encontraban en estado planeado, por lo tanto no se pueden reversar.");
                $("#warning").addClass("alert alert-warning");
                $("#warning").text(data.advertencia + " ordenes se encontraban en estado autorizado, cerrado o cancelado, por lo tanto no se pueden reversar.");
                $("#error").addClass("alert alert-error");
                $("#error").text(data.error + " ordenes no pudieron ser reversadas.");             
            });
}
</script>
<?php
$this->breadcrumbs=array(
	'Orden Compras'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar OrdenCompra', 'url'=>array('index')),
	array('label'=>'Crear OrdenCompra', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('orden-compra-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Ordenes de Compras</h1>

<div id="fade">
    <div id="success"></div>
    <div id="info"></div>
    <div id="warning"></div>
    <div id="error"></div>
</div>

<div align="right">
    
<?php 
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Cancelar',
            'type'=>'danger', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini', // '', 'large', 'small' or 'mini'
            'url'=>'',
            'htmlOptions'=>array('id' => 'cancelar'),
            'icon' => 'remove white'
        )); 

    ?>
    
    <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Cerrar',
            'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini', // '', 'large', 'small' or 'mini'
            'url'=>'',
            'htmlOptions'=>array('id' => 'cerrar'),
            'icon' => 'ban-circle white'
        )); 

    ?>
    
        <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Autorizar',
            'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini', // '', 'large', 'small' or 'mini'
            'url'=>'',
            'htmlOptions'=>array('id' => 'autorizar'),
            'icon' => 'ok white'
        )); 

    ?>
    
            <?php 
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Rev Autorización',
            'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini', // '', 'large', 'small' or 'mini'
            'url'=>'',
            'htmlOptions'=>array('id' => 'rever'),
            'icon' => 'arrow-left white'
        )); 

    ?>
    
<?php 

$this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('ordenCompra/create'),
	'icon' => 'plus white'
)); 

?>
</div>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'orden-compra-grid',
        'selectableRows'=>2,
        'selectionChanged'=>'obtenerSeleccion',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array('class'=>'CCheckBoxColumn',
                      'htmlOptions'=>array('onclick'=>'ocultarMensajes()')),
		'ORDEN_COMPRA',
		'PROVEEDOR',
		'FECHA',
                'ESTADO',		
		'DEPARTAMENTO',
		'FECHA_COTIZACION',
		/*
		'FECHA_OFRECIDA',
		'FECHA_REQUERIDA',
		'FECHA_REQ_EMBARQUE',
		'PRIORIDAD',
		'CONDICION_PAGO',
		'DIRECCION_EMBARQUE',
		'DIRECCION_COBRO',
		'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'COMENTARIO_CXP',
		'INSTRUCCIONES',
		'OBSERVACIONES',
		'PORC_DESCUENTO',
		'MONTO_FLETE',
		'MONTO_SEGURO',
		'MONTO_ANTICIPO',
		'TIPO_PRORRATEO_OC',
		'TOTAL_A_COMPRAR',
		'USUARIO_CANCELA',
		'FECHA_CANCELA',
		'BODEGA',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'template'=>'{update}',
		),
	),
)); ?>
<?php echo CHtml::HiddenField('check',''); ?>