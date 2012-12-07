<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ORDEN_COMPRA'); ?>
		<?php echo $form->textField($model,'ORDEN_COMPRA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PROVEEDOR'); ?>
		<?php echo $form->textField($model,'PROVEEDOR',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA'); ?>
		<?php echo $form->textField($model,'FECHA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'BODEGA'); ?>
		<?php echo $form->textField($model,'BODEGA',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DEPARTAMENTO'); ?>
		<?php echo $form->textField($model,'DEPARTAMENTO',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_COTIZACION'); ?>
		<?php echo $form->textField($model,'FECHA_COTIZACION'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_OFRECIDA'); ?>
		<?php echo $form->textField($model,'FECHA_OFRECIDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_REQUERIDA'); ?>
		<?php echo $form->textField($model,'FECHA_REQUERIDA'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_REQ_EMBARQUE'); ?>
		<?php echo $form->textField($model,'FECHA_REQ_EMBARQUE'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRIORIDAD'); ?>
		<?php echo $form->textField($model,'PRIORIDAD',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CONDICION_PAGO'); ?>
		<?php echo $form->textField($model,'CONDICION_PAGO',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION_EMBARQUE'); ?>
		<?php echo $form->textField($model,'DIRECCION_EMBARQUE',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION_COBRO'); ?>
		<?php echo $form->textField($model,'DIRECCION_COBRO',array('size'=>60,'maxlength'=>250)); ?>
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
		<?php echo $form->label($model,'COMENTARIO_CXP'); ?>
		<?php echo $form->textField($model,'COMENTARIO_CXP',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'INSTRUCCIONES'); ?>
		<?php echo $form->textField($model,'INSTRUCCIONES',array('size'=>60,'maxlength'=>250)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'OBSERVACIONES'); ?>
		<?php echo $form->textArea($model,'OBSERVACIONES',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PORC_DESCUENTO'); ?>
		<?php echo $form->textField($model,'PORC_DESCUENTO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MONTO_FLETE'); ?>
		<?php echo $form->textField($model,'MONTO_FLETE',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MONTO_SEGURO'); ?>
		<?php echo $form->textField($model,'MONTO_SEGURO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MONTO_ANTICIPO'); ?>
		<?php echo $form->textField($model,'MONTO_ANTICIPO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TIPO_PRORRATEO_OC'); ?>
		<?php echo $form->textField($model,'TIPO_PRORRATEO_OC',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'TOTAL_A_COMPRAR'); ?>
		<?php echo $form->textField($model,'TOTAL_A_COMPRAR',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USUARIO_CANCELA'); ?>
		<?php echo $form->textField($model,'USUARIO_CANCELA',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FECHA_CANCELA'); ?>
		<?php echo $form->textField($model,'FECHA_CANCELA'); ?>
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