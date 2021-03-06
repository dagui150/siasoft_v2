<?php
/* @var $this PedidoController */
/* @var $model Pedido */

$this->breadcrumbs=array(
	'Pedidos'=>array('admin'),
	'Pedidos',
);
?>

<h1>Pedidos</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
<?php 

$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Nuevo',
    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'mini', // '', 'large', 'small' or 'mini'
	'url' => array('pedido/create'),
	'icon' => 'plus white'
)); 

?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'pedido-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'PEDIDO',
		'CLIENTE',
		'BODEGA',
                array(
                    'name'=>'CONDICION_PAGO',
                    'header'=>'Condicion de pago',
                    'value'=>'$data->cONDICIONPAGO->DESCRIPCION'
                ),
                array(
                    'name'=>'NIVEL_PRECIO',
                    'header'=>'Tipo de precio',
                    'value'=>'$data->nIVELPRECIO->DESCRIPCION'
                ),
		'FECHA_PEDIDO',
		/*
		'FECHA_PROMETIDA',
		'FECHA_EMBARQUE',
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
		'TIPO_DESCUENTO1',
		'TIPO_DESCUENTO2',
		'MONTO_DESCUENTO1',
		'MONTO_DESCUENTO2',
		'POR_DESCUENTO1',
		'POR_DESCUENTO2',
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
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'template'=>'{update}',
                    'afterDelete'=>$this->mensajeBorrar(),
		),
            array(
                         'class'=>'CLinkColumn',
			 //'header'=>'Pedidos',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/pdf.png',
			 //'labelExpression'=>'$data->ID',
			 'urlExpression'=>'Yii::app()->getController()->createUrl("/Pedido/formatoPDF", array("id"=>$data->PEDIDO))',
			 'htmlOptions'=>array('style'=>'text-align:center;'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'PDF', 'target'=>'_blank'),
                ),
	),
)); ?>
