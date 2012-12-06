<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NOMBRE_ABREV')); ?>:</b>
	<?php echo CHtml::encode($data->NOMBRE_ABREV); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NIT')); ?>:</b>
	<?php echo CHtml::encode($data->NIT); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UBICACION_GEOGRAFICA1')); ?>:</b>
	<?php echo CHtml::encode($data->UBICACION_GEOGRAFICA1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UBICACION_GEOGRAFICA2')); ?>:</b>
	<?php echo CHtml::encode($data->UBICACION_GEOGRAFICA2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PAIS')); ?>:</b>
	<?php echo CHtml::encode($data->PAIS); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('DIRECCION')); ?>:</b>
	<?php echo CHtml::encode($data->DIRECCION); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO1')); ?>:</b>
	<?php echo CHtml::encode($data->TELEFONO1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TELEFONO2')); ?>:</b>
	<?php echo CHtml::encode($data->TELEFONO2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LOGO')); ?>:</b>
	<?php echo CHtml::encode($data->LOGO); ?>
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