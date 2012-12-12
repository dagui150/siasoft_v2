<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'SOLICITUD_OC'); ?>
		<?php echo $form->textField($model,'SOLICITUD_OC',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEPARTAMENTO'); ?>
		<?php echo $form->textField($model,'DEPARTAMENTO',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_SOLICITUD'); ?>
		<?php echo $form->textField($model,'FECHA_SOLICITUD'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_REQUERIDA'); ?>
		<?php echo $form->textField($model,'FECHA_REQUERIDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AUTORIZADA_POR'); ?>
		<?php echo $form->textField($model,'AUTORIZADA_POR',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_AUTORIZADA'); ?>
		<?php echo $form->textField($model,'FECHA_AUTORIZADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRIORIDAD'); ?>
		<?php echo $form->textField($model,'PRIORIDAD',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LINEAS_NO_ASIG'); ?>
		<?php echo $form->textField($model,'LINEAS_NO_ASIG'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COMENTARIO'); ?>
		<?php echo $form->textArea($model,'COMENTARIO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANCELADA_POR'); ?>
		<?php echo $form->textField($model,'CANCELADA_POR',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_CANCELADA'); ?>
		<?php echo $form->textField($model,'FECHA_CANCELADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO1'); ?>
		<?php echo $form->textField($model,'RUBRO1',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO2'); ?>
		<?php echo $form->textField($model,'RUBRO2',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO3'); ?>
		<?php echo $form->textField($model,'RUBRO3',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO4'); ?>
		<?php echo $form->textField($model,'RUBRO4',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO5'); ?>
		<?php echo $form->textField($model,'RUBRO5',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ESTADO'); ?>
		<?php echo $form->textField($model,'ESTADO',array('size'=>1,'maxlength'=>1)); ?>
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
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->