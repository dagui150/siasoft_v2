<?php
/* @var $this TipoAusenciaController */
/* @var $data TipoAusencia */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('TIPO_AUSENCIA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->TIPO_AUSENCIA), array('view', 'id'=>$data->TIPO_AUSENCIA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('JUSTIFICADA')); ?>:</b>
	<?php echo CHtml::encode(TipoAusencia::getJustificada($data->JUSTIFICADA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAGO')); ?>:</b>
	<?php echo CHtml::encode(TipoAusencia::getPago($data->PAGO)); ?>
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