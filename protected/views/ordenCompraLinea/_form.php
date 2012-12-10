<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orden-compra-linea-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ORDEN_COMPRA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ORDEN_COMPRA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LINEA_NUM'); ?>
		<?php echo $form->textField($model,'LINEA_NUM'); ?>
		<?php echo $form->error($model,'LINEA_NUM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ARTICULO'); ?>
		<?php echo $form->textField($model,'ARTICULO',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ARTICULO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DESCRIPCION'); ?>
		<?php echo $form->textField($model,'DESCRIPCION',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'DESCRIPCION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BODEGA'); ?>
		<?php echo $form->textField($model,'BODEGA',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'BODEGA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_REQUERIDA'); ?>
		<?php echo $form->textField($model,'FECHA_REQUERIDA'); ?>
		<?php echo $form->error($model,'FECHA_REQUERIDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FACTURA'); ?>
		<?php echo $form->textField($model,'FACTURA',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'FACTURA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CANTIDAD_ORDENADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_ORDENADA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'CANTIDAD_ORDENADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UNIDAD_COMPRA'); ?>
		<?php echo $form->textField($model,'UNIDAD_COMPRA'); ?>
		<?php echo $form->error($model,'UNIDAD_COMPRA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PRECIO_UNITARIO'); ?>
		<?php echo $form->textField($model,'PRECIO_UNITARIO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'PRECIO_UNITARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PORC_DESCUENTO'); ?>
		<?php echo $form->textField($model,'PORC_DESCUENTO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'PORC_DESCUENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MONTO_DESCUENTO'); ?>
		<?php echo $form->textField($model,'MONTO_DESCUENTO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'MONTO_DESCUENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VALOR_IMPUESTO'); ?>
		<?php echo $form->textField($model,'VALOR_IMPUESTO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'VALOR_IMPUESTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CANTIDAD_RECIBIDA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_RECIBIDA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'CANTIDAD_RECIBIDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CANTIDAD_RECHAZADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_RECHAZADA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'CANTIDAD_RECHAZADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA'); ?>
		<?php echo $form->textField($model,'FECHA'); ?>
		<?php echo $form->error($model,'FECHA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OBSERVACION'); ?>
		<?php echo $form->textArea($model,'OBSERVACION',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'OBSERVACION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ESTADO'); ?>
		<?php echo $form->textField($model,'ESTADO',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'ESTADO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CREADO_POR'); ?>
		<?php echo $form->textField($model,'CREADO_POR',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'CREADO_POR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CREADO_EL'); ?>
		<?php echo $form->textField($model,'CREADO_EL'); ?>
		<?php echo $form->error($model,'CREADO_EL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ACTUALIZADO_POR'); ?>
		<?php echo $form->textField($model,'ACTUALIZADO_POR',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ACTUALIZADO_POR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ACTUALIZADO_EL'); ?>
		<?php echo $form->textField($model,'ACTUALIZADO_EL'); ?>
		<?php echo $form->error($model,'ACTUALIZADO_EL'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->