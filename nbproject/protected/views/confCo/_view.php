<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BODEGA_DEFAULT')); ?>:</b>
	<?php echo CHtml::encode($data->BODEGA_DEFAULT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_SOLICITUD')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_SOLICITUD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_ORDEN_COMPRA')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_ORDEN_COMPRA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_EMBARQUE')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_EMBARQUE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_SOLICITUD_M')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_SOLICITUD_M); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_ORDEN_COMPRA_M')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_ORDEN_COMPRA_M); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_EMBARQUE_M')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_EMBARQUE_M); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_DEVOLUCION')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_DEVOLUCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ULT_DEVOLUCION_M')); ?>:</b>
	<?php echo CHtml::encode($data->ULT_DEVOLUCION_M); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('USAR_RUBROS')); ?>:</b>
	<?php echo CHtml::encode($data->USAR_RUBROS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ORDEN_OBSERVACION')); ?>:</b>
	<?php echo CHtml::encode($data->ORDEN_OBSERVACION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MAXIMO_LINORDEN')); ?>:</b>
	<?php echo CHtml::encode($data->MAXIMO_LINORDEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('POR_VARIAC_COSTO')); ?>:</b>
	<?php echo CHtml::encode($data->POR_VARIAC_COSTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CP_EN_LINEA')); ?>:</b>
	<?php echo CHtml::encode($data->CP_EN_LINEA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMP1_AFECTA_DESCTO')); ?>:</b>
	<?php echo CHtml::encode($data->IMP1_AFECTA_DESCTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FACTOR_REDONDEO')); ?>:</b>
	<?php echo CHtml::encode($data->FACTOR_REDONDEO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRECIO_DEC')); ?>:</b>
	<?php echo CHtml::encode($data->PRECIO_DEC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CANTIDAD_DEC')); ?>:</b>
	<?php echo CHtml::encode($data->CANTIDAD_DEC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEDIDOS_SOLICITUD')); ?>:</b>
	<?php echo CHtml::encode($data->PEDIDOS_SOLICITUD); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEDIDOS_ORDEN')); ?>:</b>
	<?php echo CHtml::encode($data->PEDIDOS_ORDEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PEDIDOS_EMBARQUE')); ?>:</b>
	<?php echo CHtml::encode($data->PEDIDOS_EMBARQUE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRECCION_EMBARQUE')); ?>:</b>
	<?php echo CHtml::encode($data->DIRECCION_EMBARQUE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRECCION_COBRO')); ?>:</b>
	<?php echo CHtml::encode($data->DIRECCION_COBRO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO1_SOLNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO1_SOLNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO2_SOLNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO2_SOLNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO3_SOLNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO3_SOLNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO4_SOLNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO4_SOLNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO5_SOLNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO5_SOLNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO1_EMBNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO1_EMBNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO2_EMBNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO2_EMBNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO3_EMBNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO3_EMBNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO4_EMBNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO4_EMBNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO5_EMBNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO5_EMBNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO1_ORDNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO1_ORDNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO2_ORDNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO2_ORDNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO3_ORDNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO3_ORDNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO4_ORDNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO4_ORDNOM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RUBRO5_ORDNOM')); ?>:</b>
	<?php echo CHtml::encode($data->RUBRO5_ORDNOM); ?>
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