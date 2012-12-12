<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ingreso-compra-linea-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'INGRESO_COMPRA'); ?>
		<?php echo $form->textField($model,'INGRESO_COMPRA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'INGRESO_COMPRA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LINEA_NUM'); ?>
		<?php echo $form->textField($model,'LINEA_NUM'); ?>
		<?php echo $form->error($model,'LINEA_NUM'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ORDEN_COMPRA_LINEA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA_LINEA'); ?>
		<?php echo $form->error($model,'ORDEN_COMPRA_LINEA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ARTICULO'); ?>
		<?php echo $form->textField($model,'ARTICULO',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ARTICULO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'BODEGA'); ?>
		<?php echo $form->textField($model,'BODEGA',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'BODEGA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CANTIDAD_ORDENADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_ORDENADA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'CANTIDAD_ORDENADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UNIDAD_ORDENADA'); ?>
		<?php echo $form->textField($model,'UNIDAD_ORDENADA'); ?>
		<?php echo $form->error($model,'UNIDAD_ORDENADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CANTIDAD_ACEPTADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_ACEPTADA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'CANTIDAD_ACEPTADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CANTIDAD_RECHAZADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_RECHAZADA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'CANTIDAD_RECHAZADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PRECIO_UNITARIO'); ?>
		<?php echo $form->textField($model,'PRECIO_UNITARIO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'PRECIO_UNITARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COSTO_FISCAL_UNITARIO'); ?>
		<?php echo $form->textField($model,'COSTO_FISCAL_UNITARIO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'COSTO_FISCAL_UNITARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ACTIVO'); ?>
		<?php echo $form->textField($model,'ACTIVO',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'ACTIVO'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->