<?php
/* @var $this IngresoCompraLineaController */
/* @var $model IngresoCompraLinea */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'INGRESO_COMPRA_LINEA'); ?>
		<?php echo $form->textField($model,'INGRESO_COMPRA_LINEA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'INGRESO_COMPRA'); ?>
		<?php echo $form->textField($model,'INGRESO_COMPRA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LINEA_NUM'); ?>
		<?php echo $form->textField($model,'LINEA_NUM'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ORDEN_COMPRA_LINEA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA_LINEA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ARTICULO'); ?>
		<?php echo $form->textField($model,'ARTICULO',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BODEGA'); ?>
		<?php echo $form->textField($model,'BODEGA',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANTIDAD_ORDENADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_ORDENADA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UNIDAD_ORDENADA'); ?>
		<?php echo $form->textField($model,'UNIDAD_ORDENADA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANTIDAD_ACEPTADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_ACEPTADA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANTIDAD_RECHAZADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_RECHAZADA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRECIO_UNITARIO'); ?>
		<?php echo $form->textField($model,'PRECIO_UNITARIO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COSTO_FISCAL_UNITARIO'); ?>
		<?php echo $form->textField($model,'COSTO_FISCAL_UNITARIO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ACTIVO'); ?>
		<?php echo $form->textField($model,'ACTIVO',array('size'=>1,'maxlength'=>1)); ?>
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
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->