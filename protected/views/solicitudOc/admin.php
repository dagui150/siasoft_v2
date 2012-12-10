<script>
function obtenerSeleccion(){

    var idcategoria = $.fn.yiiGridView.getSelection('solicitud-oc-grid');
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
    
    accion = $("#cancelar");
    accion.click(cancelar);
    
    accion = $("#autorizar");
    accion.click(autorizar);
    
    accion = $("#rever");
    accion.click(reversar);
}

function cancelar(){
    var id = $('#check').get(0).value;
    $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/Cancelar'); ?>&buscar='+id,
            function (data){
                $("#fade").fadeIn(1500);
                $.fn.yiiGridView.update('solicitud-oc-grid');
                $("#success").addClass("alert alert-success");
                $("#success").text(data.exito + " solicitudes se cancelaron con exito.");
                $("#info").addClass("alert alert-info");
                $("#info").text(data.info + " solicitudes ya se encontraban con estado cancelado.");
                $("#warning").addClass("alert alert-warning");
                $("#warning").text("0 Advertencias");  
                $("#error").addClass("alert alert-error");
                $("#error").text(data.error + " solicitudes no pudieron ser canceladas.");                  
            });
}

function autorizar(){
    var id = $('#check').get(0).value;
    
    $.getJSON(
        '<?php echo $this->createUrl('solicitudOc/Autorizar'); ?>&buscar='+id,
        function (data){
                $("#fade").fadeIn(1500);
                $.fn.yiiGridView.update('solicitud-oc-grid');
                $("#success").addClass("alert alert-success");
                $("#success").text(data.exito + " solicitudes se autorizaron con exito.");
                $("#info").addClass("alert alert-info");
                $("#info").text(data.info + " solicitudes se encontraban con estado autorizar.");
                $("#warning").addClass("alert alert-warning");
                $("#warning").text(data.advertencia + " solicitudes se encontraban con estado cancelar por tanto no se pueden autorizar.");
                $("#error").addClass("alert alert-error");
                $("#error").text(data.error + " solicitudes no pudieron ser autorizadas.");
        }
    );
}

function reversar(){
    var id = $('#check').get(0).value;
    $.getJSON(
        '<?php echo $this->createUrl('solicitudOc/Reversar'); ?>&buscar='+id,
        function (data){
                $("#fade").fadeIn(1500);
                $.fn.yiiGridView.update('solicitud-oc-grid');
                $("#success").addClass("alert alert-success");
                $("#success").text(data.exito + " solicitudes se reversaron con exito.");
                $("#info").addClass("alert alert-info");
                $("#info").text(data.info + " solicitudes se encontraban con estado planeada.");
                $("#warning").addClass("alert alert-warning");
                $("#warning").text(data.advertencia + " solicitudes se encontraban con estado cancelar o asignado por tanto no se pueden reversar.");
                $("#error").addClass("alert alert-error");
                $("#error").text(data.error + " solicitudes no pudieron ser reversadas.");
        });
}
</script>
<?php
$this->breadcrumbs=array(
	'Solicitudes'=>array('admin'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOc', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOc', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('solicitud-oc-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Solicitudes</h1>
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
	'url' => array('solicitudOc/create'),
	'icon' => 'plus white',
)); 

?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'solicitud-oc-grid',
        'selectableRows'=>2,
        'selectionChanged'=>'obtenerSeleccion',
        'dataProvider'=>$model->search(),
	'filter'=>$model,
        
	'columns'=>array(
                array('class'=>'CCheckBoxColumn',
                    'htmlOptions'=>array('onclick'=>'ocultarMensajes()')),
		'SOLICITUD_OC',
		'FECHA_SOLICITUD',
		'FECHA_REQUERIDA',
		'AUTORIZADA_POR',
                'FECHA_AUTORIZADA',
		'ESTADO',
		/*
                'FECHA_AUTORIZADA',
		'PRIORIDAD',
		'LINEAS_NO_ASIG',
		'COMENTARIO',
		'CANCELADA_POR',
		'FECHA_CANCELADA',
		'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
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
)); 
 ?>
<?php echo CHtml::HiddenField('check',''); ?>