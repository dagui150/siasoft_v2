<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMPUESTO1_DESC')); ?>:</b>
	<?php echo CHtml::encode($data->IMPUESTO1_DESC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IMPUESTO2_DESC')); ?>:</b>
	<?php echo CHtml::encode($data->IMPUESTO2_DESC); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PATRON_CCOSTO')); ?>:</b>
	<?php echo CHtml::encode($data->PATRON_CCOSTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SIMBOLO_MONEDA')); ?>:</b>
	<?php echo CHtml::encode($data->SIMBOLO_MONEDA); ?>
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