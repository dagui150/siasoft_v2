<?php
if(isset($_GET['id'])){
    $js=Yii::app()->clientScript;

    $TEMP1="$(document).ready(function(){
        $('[alt$=";
    $TEMP2='"';
    $TEMP3="]').click();});";
    
    $js->registerScript('factura',$TEMP1.$TEMP2.$_GET['id'].$TEMP2.$TEMP3,
    
            
    CClientScript::POS_HEAD);   
}
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Facturas'
);
?>

<h1>Facturas</h1>


<div align="right">
<?php 
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('create'),
	'icon' => 'plus white'
)); 

?>
</div>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'factura-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'FACTURA',
		'CLIENTE',
		'BODEGA',
		'CONDICION_PAGO',
		'NIVEL_PRECIO',
		'PEDIDO',
		/*
		'FECHA_FACTURA',
		'FECHA_DESPACHO',
		'FECHA_ENTREGA',
		'ORDEN_COMPRA',
		'FECHA_ORDEN',
		'RUBRO1',
		'RUBRO2',
		'RUBRO3',
		'RUBRO4',
		'RUBRO5',
		'COMENTARIOS_CXC',
		'OBSERVACIONES',
		'TOTAL_MERCADERIA',
		'MONTO_ANTICIPO',
		'MONTO_FLETE',
		'MONTO_SEGURO',
		'MONTO_DESCUENTO1',
		'TOTAL_IMPUESTO1',
		'TOTAL_A_FACTURAR',
		'REMITIDO',
		'RESERVADO',
		'ESTADO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
		
            array(
                         'class'=>'CLinkColumn',
			 //'header'=>'FACTURAS',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/pdf.png',
			 'labelExpression'=>'$data->FACTURA',
			 'urlExpression'=>'Yii::app()->getController()->createUrl("/Factura/formatoPDF", array("id"=>$data->FACTURA))',
			 'htmlOptions'=>array('style'=>'text-align:center;','id'=>'hola'),
                         
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'PDF', 'target'=>'_blank'),
                ),
	),
)); ?>
