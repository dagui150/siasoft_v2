<?php
/* @var $this CargoController */
/* @var $data Cargo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CARGO')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CARGO), array('view', 'id'=>$data->CARGO)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DESCRIPCION')); ?>:</b>
	<?php echo CHtml::encode($data->DESCRIPCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SALARIO_MINIMO')); ?>:</b>
	<?php echo CHtml::encode($data->SALARIO_MINIMO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SALARIO_INTERMEDIO1')); ?>:</b>
	<?php echo CHtml::encode($data->SALARIO_INTERMEDIO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SALARIO_INTERMEDIO2')); ?>:</b>
	<?php echo CHtml::encode($data->SALARIO_INTERMEDIO2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SALARIO_MAXIMO')); ?>:</b>
	<?php echo CHtml::encode($data->SALARIO_MAXIMO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SALARIO_ACTUAL')); ?>:</b>
	<?php echo CHtml::encode($data->SALARIO_ACTUAL); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('FUNCIONES')); ?>:</b>
	<?php echo CHtml::encode($data->FUNCIONES); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOTAS')); ?>:</b>
	<?php echo CHtml::encode($data->NOTAS); ?>
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