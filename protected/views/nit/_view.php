<?php
/* @var $this NitController */
/* @var $data Nit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIIPO_DOCUMENTO')); ?>:</b>
	<?php echo CHtml::encode($data->TIIPO_DOCUMENTO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('RAZON_SOCIAL')); ?>:</b>
	<?php echo CHtml::encode($data->RAZON_SOCIAL); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ALIAS')); ?>:</b>
	<?php echo CHtml::encode($data->ALIAS); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('OBSERVACIONES')); ?>:</b>
	<?php echo CHtml::encode($data->OBSERVACIONES); ?>
	<br />

        <?php /*
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