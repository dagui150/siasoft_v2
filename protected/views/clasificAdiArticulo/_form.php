<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'clasific-adi-articulo-form',
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
		<?php echo $form->labelEx($model,'ARTICULO'); ?>
		<?php echo $form->textField($model,'ARTICULO',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ARTICULO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'VALOR'); ?>
		<?php echo $form->textField($model,'VALOR'); ?>
		<?php echo $form->error($model,'VALOR'); ?>
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