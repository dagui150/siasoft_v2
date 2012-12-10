<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formato-impresion-form',
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
		<?php echo $form->labelEx($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'NOMBRE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'OBSERVACION'); ?>
		<?php echo $form->textArea($model,'OBSERVACION',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'OBSERVACION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MODULO'); ?>
		<?php echo $form->textField($model,'MODULO',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'MODULO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SUBMODULO'); ?>
		<?php echo $form->textField($model,'SUBMODULO',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'SUBMODULO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RUTA'); ?>
		<?php echo $form->textField($model,'RUTA',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'RUTA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TIPO'); ?>
		<?php echo $form->textField($model,'TIPO',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'TIPO'); ?>
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