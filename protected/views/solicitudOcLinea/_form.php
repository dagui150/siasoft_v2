<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-oc-linea-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'SOLICITUD_OC'); ?>
		<?php echo $form->textField($model,'SOLICITUD_OC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'SOLICITUD_OC'); ?>
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
		<?php echo $form->labelEx($model,'CANTIDAD'); ?>
		<?php echo $form->textField($model,'CANTIDAD',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'CANTIDAD'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SALDO'); ?>
		<?php echo $form->textField($model,'SALDO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'SALDO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'COMENTARIO'); ?>
		<?php echo $form->textArea($model,'COMENTARIO',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'COMENTARIO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_REQUERIDA'); ?>
		<?php echo $form->textField($model,'FECHA_REQUERIDA'); ?>
		<?php echo $form->error($model,'FECHA_REQUERIDA'); ?>
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