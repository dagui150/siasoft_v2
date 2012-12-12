<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'PROVEEDOR'); ?>
		<?php echo $form->textField($model,'PROVEEDOR',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CATEGORIA'); ?>
		<?php echo $form->textField($model,'CATEGORIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ALIAS'); ?>
		<?php echo $form->textField($model,'ALIAS',array('size'=>60,'maxlength'=>80)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CONTACTO'); ?>
		<?php echo $form->textField($model,'CONTACTO',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CARGO'); ?>
		<?php echo $form->textField($model,'CARGO',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION'); ?>
		<?php echo $form->textArea($model,'DIRECCION',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EMAIL'); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_INGRESO'); ?>
		<?php echo $form->textField($model,'FECHA_INGRESO'); ?>
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
		<?php echo $form->label($model,'FAX'); ?>
		<?php echo $form->textField($model,'FAX',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NIT'); ?>
		<?php echo $form->textField($model,'NIT',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CONDICION_PAGO'); ?>
		<?php echo $form->textField($model,'CONDICION_PAGO',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ACTIVO'); ?>
		<?php echo $form->textField($model,'ACTIVO',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ORDEN_MINIMA'); ?>
		<?php echo $form->textField($model,'ORDEN_MINIMA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCUENTO'); ?>
		<?php echo $form->textField($model,'DESCUENTO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TASA_INTERES_MORA'); ?>
		<?php echo $form->textField($model,'TASA_INTERES_MORA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->