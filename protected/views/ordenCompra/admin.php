<script>
function obtenerSeleccion(){
    var idcategoria = $.fn.yiiGridView.getSelection('orden-compra-grid');
    $('#check').val(idcategoria);
}

function completado(){
    $.fn.yiiGridView.update('orden-compra-grid');
}

$(document).ready(inicio)

function inicio(){

}
</script>
<?php $this->pageTitle=Yii::app()->name." - Orden Compras";?>
<?php
if(!ConfCo::darConf())
     $this->redirect(array('/confCo/create'));
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
<?php 
if (isset($_GET['men'])){
    SBaseController::mensaje($_GET['men']);
}
?>
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
        'htmlOptions'=>array('confirm'=>'¿Está seguro que desea cancelar esta(s) solicitud(es)?', 'id'=>'cancelar'),
    ));
    ?>
    
<?php 
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Cerrar',
        'buttonType'=>'ajaxSubmit',
        'type'=>'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini', // '', 'large', 'small' or 'mini'
        'url' => array('cerrar'),
        'icon' => 'ban-circle white',
        'ajaxOptions'=>array(
            'type'=>'POST',
            'update'=>'#mensaje',
            'complete'=>'completado()',
        ),
        'htmlOptions'=>array('id'=>'cerrar'),
    ));
    ?>
    
        <?php 
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Autorizar',
        'buttonType'=>'ajaxSubmit',
        'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini', // '', 'large', 'small' or 'mini'
        'url' => array('autorizar'),
        'icon' => 'ok white',
        'ajaxOptions'=>array(
            'type'=>'POST',
            'update'=>'#mensaje',
            'complete'=>'completado()',
        ),
        'htmlOptions'=>array('id'=>'autorizar'),
    ));
    ?>
    
   <?php 
    $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Rev Autorización',
        'buttonType'=>'ajaxSubmit',
        'type'=>'info', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini', // '', 'large', 'small' or 'mini'
        'url' => array('reversar'),
        'icon' => 'arrow-left white',
        'ajaxOptions'=>array(
            'type'=>'POST',
            'update'=>'#mensaje',
            'complete'=>'completado()',
        ),
        'htmlOptions'=>array('id'=>'rever'),
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
		array(
                    'name'=>'PROVEEDOR',
                    'type'=>'text',
                    'filter' => CHtml::listData(Proveedor::model()->findAll(), 'PROVEEDOR', 'NOMBRE'),
                    'value'=>'$data->pROVEEDOR->NOMBRE'
                ),
		'FECHA',
                array(
                    'name'=>'ESTADO',
                    'header'=>'Estado',
                    'filter'=>array('P'=>'Planeado','R'=>'Recibido','C'=>'Cancelado'),
                    'value'=>'OrdenCompra::estado($data->ESTADO)',
                ),	
                array(
                    'name'=>'DEPARTAMENTO',
                    'header'=>'Departamento',
                    'value'=>'$data->dEPARTAMENTO->DESCRIPCION'
                ),
		//'DEPARTAMENTO',
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
                array(
                         'class'=>'CLinkColumn',
			 //'header'=>'Bodegas',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/pdf.png',
			 //'labelExpression'=>'$data->ID',
			 'urlExpression'=>'CController::createUrl("/OrdenCompra/formatoPDF", array("id"=>$data->ORDEN_COMPRA))',
			 'htmlOptions'=>array('style'=>'text-align:center;'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'PDF', 'target'=>'_blank'),
                ),
	),
)); ?>
 <?php $this->endWidget(); ?>