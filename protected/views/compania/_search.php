<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_ABREV'); ?>
		<?php echo $form->textField($model,'NOMBRE_ABREV',array('size'=>60,'maxlength'=>64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NIT'); ?>
		<?php echo $form->textField($model,'NIT',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UBICACION_GEOGRAFICA1'); ?>
		<?php echo $form->textField($model,'UBICACION_GEOGRAFICA1',array('size'=>2,'maxlength'=>2)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UBICACION_GEOGRAFICA2'); ?>
		<?php echo $form->textField($model,'UBICACION_GEOGRAFICA2',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PAIS'); ?>
		<?php echo $form->textField($model,'PAIS',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION'); ?>
		<?php echo $form->textField($model,'DIRECCION',array('size'=>60,'maxlength'=>256)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TELEFONO1'); ?>
		<?php echo $form->textField($model,'TELEFONO1',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TELEFONO2'); ?>
		<?php echo $form->textField($model,'TELEFONO2',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LOGO'); ?>
		<?php echo $form->textField($model,'LOGO',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CREADO_POR'); ?>
		<?php echo $form->textField($model,'CREADO_POR',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CREADO_EL'); ?>
		<?php echo $form->textField($model,'CREADO_EL'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ACTUALIZADO_POR'); ?>
		<?php echo $form->textField($model,'ACTUALIZADO_POR',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ACTUALIZADO_EL'); ?>
		<?php echo $form->textField($model,'ACTUALIZADO_EL'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app','SEARCH')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->