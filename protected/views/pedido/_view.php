<?php
/* @var $this PedidoController */
/* @var $model Pedido */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEDIDO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->PEDIDO), array('view', 'id'=>$data->PEDIDO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CLIENTE')); ?>:</b>
	<?php echo CHtml::encode($data->CLIENTE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BODEGA')); ?>:</b>
	<?php echo CHtml::encode($data->BODEGA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONDICION_PAGO')); ?>:</b>
	<?php echo CHtml::encode($data->CONDICION_PAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIVEL_PRECIO')); ?>:</b>
	<?php echo CHtml::encode($data->NIVEL_PRECIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_PEDIDO')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_PEDIDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_PROMETIDA')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_PROMETIDA); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_EMBARQUE')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_EMBARQUE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ORDEN_COMPRA')); ?>:</b>
	<?php echo CHtml::encode($data->ORDEN_COMPRA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FECHA_ORDEN')); ?>:</b>
	<?php echo CHtml::encode($data->FECHA_ORDEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO1')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO2')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO3')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO4')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO5')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO5); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COMENTARIOS_CXC')); ?>:</b>
	<?php echo CHtml::encode($data->COMENTARIOS_CXC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBSERVACIONES')); ?>:</b>
	<?php echo CHtml::encode($data->OBSERVACIONES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_MERCADERIA')); ?>:</b>
	<?php echo CHtml::encode($data->TOTAL_MERCADERIA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_ANTICIPO')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_ANTICIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_FLETE')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_FLETE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_SEGURO')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_SEGURO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO_DESCUENTO1')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO_DESCUENTO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO_DESCUENTO2')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO_DESCUENTO2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_DESCUENTO1')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_DESCUENTO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_DESCUENTO2')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_DESCUENTO2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('POR_DESCUENTO1')); ?>:</b>
	<?php echo CHtml::encode($data->POR_DESCUENTO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('POR_DESCUENTO2')); ?>:</b>
	<?php echo CHtml::encode($data->POR_DESCUENTO2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_IMPUESTO1')); ?>:</b>
	<?php echo CHtml::encode($data->TOTAL_IMPUESTO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOTAL_A_FACTURAR')); ?>:</b>
	<?php echo CHtml::encode($data->TOTAL_A_FACTURAR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REMITIDO')); ?>:</b>
	<?php echo CHtml::encode($data->REMITIDO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RESERVADO')); ?>:</b>
	<?php echo CHtml::encode($data->RESERVADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO')); ?>:</b>
	<?php echo CHtml::encode($data->ESTADO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CREADO_POR')); ?>:</b>
	<?php echo CHtml::encode($data->CREADO_POR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CREADO_EL')); ?>:</b>
	<?php echo CHtml::encode($data->CREADO_EL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTUALIZADO_POR')); ?>:</b>
	<?php echo CHtml::encode($data->ACTUALIZADO_POR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTUALIZADO_EL')); ?>:</b>
	<?php echo CHtml::encode($data->ACTUALIZADO_EL); ?>
	<br />

	*/ ?>

</div>