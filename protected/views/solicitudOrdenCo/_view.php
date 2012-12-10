<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SOLICITUD_OC')); ?>:</b>
	<?php echo CHtml::encode($data->SOLICITUD_OC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SOLICITUD_OC_LINEA')); ?>:</b>
	<?php echo CHtml::encode($data->SOLICITUD_OC_LINEA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ORDEN_COMPRA')); ?>:</b>
	<?php echo CHtml::encode($data->ORDEN_COMPRA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ORDEN_COMPRA_LINEA')); ?>:</b>
	<?php echo CHtml::encode($data->ORDEN_COMPRA_LINEA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DECIMA')); ?>:</b>
	<?php echo CHtml::encode($data->DECIMA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTIVO')); ?>:</b>
	<?php echo CHtml::encode($data->ACTIVO); ?>
	<br />

	<?php /*
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