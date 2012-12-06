<?php
/* @var $this HorarioController */
/* @var $data Horario */
?>

<div class="view">
   


	<b><?php echo CHtml::encode($data->getAttributeLabel('HORARIO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->HORARIO), array('view', 'id'=>$data->HORARIO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOLERA_ENTRADA')); ?>:</b>
	<?php echo CHtml::encode($data->TOLERA_ENTRADA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TOLERA_SALIDA')); ?>:</b>
	<?php echo CHtml::encode($data->TOLERA_SALIDA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REDONDEO_ENTRADA')); ?>:</b>
	<?php echo CHtml::encode($data->REDONDEO_ENTRADA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('REDONDEO_SALIDA')); ?>:</b>
	<?php echo CHtml::encode($data->REDONDEO_SALIDA); ?>
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