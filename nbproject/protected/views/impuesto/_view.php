<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('procentaje')); ?>:</b>
	<?php echo CHtml::encode($data->procentaje); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activo')); ?>:</b>
	<?php echo CHtml::encode($data->activo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creado_por')); ?>:</b>
	<?php echo CHtml::encode($data->creado_por); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creado_el')); ?>:</b>
	<?php echo CHtml::encode($data->creado_el); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('actualizado_por')); ?>:</b>
	<?php echo CHtml::encode($data->actualizado_por); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('actualizado_el')); ?>:</b>
	<?php echo CHtml::encode($data->actualizado_el); ?>
	<br />

	*/ ?>

</div>