<?php
/* @var $this EstadoEmpleadoController */
/* @var $data EstadoEmpleado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ESTADO_EMPLEADO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ESTADO_EMPLEADO), array('view', 'id'=>$data->ESTADO_EMPLEADO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ACTIVO')); ?>:</b>
	<?php echo CHtml::encode($data->ACTIVO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAGO')); ?>:</b>
	<?php echo CHtml::encode(EstadoEmpleado::getPago($data->PAGO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TEMPORAL')); ?>:</b>
	<?php echo CHtml::encode(EstadoEmpleado::getTemporal($data->TEMPORAL)); ?>
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