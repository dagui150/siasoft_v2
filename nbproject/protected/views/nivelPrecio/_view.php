<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESQUEMA_TRABAJO')); ?>:</b>
	<?php echo CHtml::encode($data->ESQUEMA_TRABAJO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CONDICION_PAGO')); ?>:</b>
	<?php echo CHtml::encode($data->CONDICION_PAGO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTIVO')); ?>:</b>
	<?php echo CHtml::encode($data->ACTIVO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CREADO_POR')); ?>:</b>
	<?php echo CHtml::encode($data->CREADO_POR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CREADO_EL')); ?>:</b>
	<?php echo CHtml::encode($data->CREADO_EL); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTUALIZADO_POR')); ?>:</b>
	<?php echo CHtml::encode($data->ACTUALIZADO_POR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTUALIZADO_EL')); ?>:</b>
	<?php echo CHtml::encode($data->ACTUALIZADO_EL); ?>
	<br />

	*/ ?>

</div>