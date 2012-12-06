<?php
/* @var $this DiaController */
/* @var $model Dia */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'dia-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'DIA'); ?>
		<?php echo $form->textField($model,'DIA'); ?>
		<?php echo $form->error($model,'DIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'NOMBRE'); ?>
	</div>

   <?php echo CHtml::activeHiddenField($model,'ACTIVO',array('value'=>'S')); ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->