<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-orden-co-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
		<?php echo $form->error($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SOLICITUD_OC'); ?>
		<?php echo $form->textField($model,'SOLICITUD_OC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'SOLICITUD_OC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SOLICITUD_OC_LINEA'); ?>
		<?php echo $form->textField($model,'SOLICITUD_OC_LINEA'); ?>
		<?php echo $form->error($model,'SOLICITUD_OC_LINEA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ORDEN_COMPRA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'ORDEN_COMPRA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ORDEN_COMPRA_LINEA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA_LINEA'); ?>
		<?php echo $form->error($model,'ORDEN_COMPRA_LINEA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DECIMA'); ?>
		<?php echo $form->textField($model,'DECIMA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'DECIMA'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->