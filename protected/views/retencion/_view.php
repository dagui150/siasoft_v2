<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PORCENTAJE')); ?>:</b>
	<?php echo CHtml::encode($data->PORCENTAJE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MONTO_MINIMO')); ?>:</b>
	<?php echo CHtml::encode($data->MONTO_MINIMO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO')); ?>:</b>
	<?php echo CHtml::encode($data->TIPO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APLICA_MONTO')); ?>:</b>
	<?php echo CHtml::encode($data->APLICA_MONTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APLICA_SUBTOTAL')); ?>:</b>
	<?php echo CHtml::encode($data->APLICA_SUBTOTAL); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('APLICA_SUB_DESC')); ?>:</b>
	<?php echo CHtml::encode($data->APLICA_SUB_DESC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APLICA_IMPUESTO1')); ?>:</b>
	<?php echo CHtml::encode($data->APLICA_IMPUESTO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APLICA_RUBRO1')); ?>:</b>
	<?php echo CHtml::encode($data->APLICA_RUBRO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('APLICA_RUBRO2')); ?>:</b>
	<?php echo CHtml::encode($data->APLICA_RUBRO2); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTUALIZADO_POR')); ?>:</b>
	<?php echo CHtml::encode($data->ACTUALIZADO_POR); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTUALIZADO_EL')); ?>:</b>
	<?php echo CHtml::encode($data->ACTUALIZADO_EL); ?>
	<br />

	*/ ?>

</div>