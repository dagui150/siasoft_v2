<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('INGRESO_COMPRA_LINEA')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->INGRESO_COMPRA_LINEA), array('view', 'id'=>$data->INGRESO_COMPRA_LINEA)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('INGRESO_COMPRA')); ?>:</b>
	<?php echo CHtml::encode($data->INGRESO_COMPRA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LINEA_NUM')); ?>:</b>
	<?php echo CHtml::encode($data->LINEA_NUM); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ORDEN_COMPRA_LINEA')); ?>:</b>
	<?php echo CHtml::encode($data->ORDEN_COMPRA_LINEA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ARTICULO')); ?>:</b>
	<?php echo CHtml::encode($data->ARTICULO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BODEGA')); ?>:</b>
	<?php echo CHtml::encode($data->BODEGA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CANTIDAD_ORDENADA')); ?>:</b>
	<?php echo CHtml::encode($data->CANTIDAD_ORDENADA); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('UNIDAD_ORDENADA')); ?>:</b>
	<?php echo CHtml::encode($data->UNIDAD_ORDENADA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CANTIDAD_ACEPTADA')); ?>:</b>
	<?php echo CHtml::encode($data->CANTIDAD_ACEPTADA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CANTIDAD_RECHAZADA')); ?>:</b>
	<?php echo CHtml::encode($data->CANTIDAD_RECHAZADA); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PRECIO_UNITARIO')); ?>:</b>
	<?php echo CHtml::encode($data->PRECIO_UNITARIO); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('COSTO_FISCAL_UNITARIO')); ?>:</b>
	<?php echo CHtml::encode($data->COSTO_FISCAL_UNITARIO); ?>
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