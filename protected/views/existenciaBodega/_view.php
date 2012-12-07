<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ARTICULO')); ?>:</b>
	<?php echo CHtml::encode($data->ARTICULO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BODEGA')); ?>:</b>
	<?php echo CHtml::encode($data->BODEGA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXISTENCIA_MINIMA')); ?>:</b>
	<?php echo CHtml::encode($data->EXISTENCIA_MINIMA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EXISTENCIA_MAXIMA')); ?>:</b>
	<?php echo CHtml::encode($data->EXISTENCIA_MAXIMA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PUNTO_REORDEN')); ?>:</b>
	<?php echo CHtml::encode($data->PUNTO_REORDEN); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CANT_DISPONIBLE')); ?>:</b>
	<?php echo CHtml::encode($data->CANT_DISPONIBLE); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CANT_RESERVADA')); ?>:</b>
	<?php echo CHtml::encode($data->CANT_RESERVADA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CANT_REMITIDA')); ?>:</b>
	<?php echo CHtml::encode($data->CANT_REMITIDA); ?>
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