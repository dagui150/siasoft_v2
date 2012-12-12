<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ORDEN_COMPRA_LINEA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA_LINEA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ORDEN_COMPRA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LINEA_NUM'); ?>
		<?php echo $form->textField($model,'LINEA_NUM'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ARTICULO'); ?>
		<?php echo $form->textField($model,'ARTICULO',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DESCRIPCION'); ?>
		<?php echo $form->textField($model,'DESCRIPCION',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BODEGA'); ?>
		<?php echo $form->textField($model,'BODEGA',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_REQUERIDA'); ?>
		<?php echo $form->textField($model,'FECHA_REQUERIDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FACTURA'); ?>
		<?php echo $form->textField($model,'FACTURA',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANTIDAD_ORDENADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_ORDENADA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UNIDAD_COMPRA'); ?>
		<?php echo $form->textField($model,'UNIDAD_COMPRA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRECIO_UNITARIO'); ?>
		<?php echo $form->textField($model,'PRECIO_UNITARIO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PORC_DESCUENTO'); ?>
		<?php echo $form->textField($model,'PORC_DESCUENTO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MONTO_DESCUENTO'); ?>
		<?php echo $form->textField($model,'MONTO_DESCUENTO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'VALOR_IMPUESTO'); ?>
		<?php echo $form->textField($model,'VALOR_IMPUESTO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANTIDAD_RECIBIDA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_RECIBIDA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANTIDAD_RECHAZADA'); ?>
		<?php echo $form->textField($model,'CANTIDAD_RECHAZADA',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA'); ?>
		<?php echo $form->textField($model,'FECHA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OBSERVACION'); ?>
		<?php echo $form->textArea($model,'OBSERVACION',array('rows'=>6, 'cols'=>50)); ?>
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