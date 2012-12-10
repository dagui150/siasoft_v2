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
		<?php echo $form->label($model,'BODEGA_DEFAULT'); ?>
		<?php echo $form->textField($model,'BODEGA_DEFAULT',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_SOLICITUD'); ?>
		<?php echo $form->textField($model,'ULT_SOLICITUD',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_ORDEN_COMPRA'); ?>
		<?php echo $form->textField($model,'ULT_ORDEN_COMPRA',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_EMBARQUE'); ?>
		<?php echo $form->textField($model,'ULT_EMBARQUE',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_SOLICITUD_M'); ?>
		<?php echo $form->textField($model,'ULT_SOLICITUD_M',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_ORDEN_COMPRA_M'); ?>
		<?php echo $form->textField($model,'ULT_ORDEN_COMPRA_M',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_EMBARQUE_M'); ?>
		<?php echo $form->textField($model,'ULT_EMBARQUE_M',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_DEVOLUCION'); ?>
		<?php echo $form->textField($model,'ULT_DEVOLUCION',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ULT_DEVOLUCION_M'); ?>
		<?php echo $form->textField($model,'ULT_DEVOLUCION_M',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USAR_RUBROS'); ?>
		<?php echo $form->textField($model,'USAR_RUBROS',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ORDEN_OBSERVACION'); ?>
		<?php echo $form->textArea($model,'ORDEN_OBSERVACION',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MAXIMO_LINORDEN'); ?>
		<?php echo $form->textField($model,'MAXIMO_LINORDEN'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'POR_VARIAC_COSTO'); ?>
		<?php echo $form->textField($model,'POR_VARIAC_COSTO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CP_EN_LINEA'); ?>
		<?php echo $form->textField($model,'CP_EN_LINEA',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'IMP1_AFECTA_DESCTO'); ?>
		<?php echo $form->textField($model,'IMP1_AFECTA_DESCTO',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FACTOR_REDONDEO'); ?>
		<?php echo $form->textField($model,'FACTOR_REDONDEO',array('size'=>28,'maxlength'=>28)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRECIO_DEC'); ?>
		<?php echo $form->textField($model,'PRECIO_DEC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CANTIDAD_DEC'); ?>
		<?php echo $form->textField($model,'CANTIDAD_DEC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PEDIDOS_SOLICITUD'); ?>
		<?php echo $form->textField($model,'PEDIDOS_SOLICITUD',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PEDIDOS_ORDEN'); ?>
		<?php echo $form->textField($model,'PEDIDOS_ORDEN',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PEDIDOS_EMBARQUE'); ?>
		<?php echo $form->textField($model,'PEDIDOS_EMBARQUE',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION_EMBARQUE'); ?>
		<?php echo $form->textArea($model,'DIRECCION_EMBARQUE',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DIRECCION_COBRO'); ?>
		<?php echo $form->textArea($model,'DIRECCION_COBRO',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO1_SOLNOM'); ?>
		<?php echo $form->textField($model,'RUBRO1_SOLNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO2_SOLNOM'); ?>
		<?php echo $form->textField($model,'RUBRO2_SOLNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO3_SOLNOM'); ?>
		<?php echo $form->textField($model,'RUBRO3_SOLNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO4_SOLNOM'); ?>
		<?php echo $form->textField($model,'RUBRO4_SOLNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO5_SOLNOM'); ?>
		<?php echo $form->textField($model,'RUBRO5_SOLNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO1_EMBNOM'); ?>
		<?php echo $form->textField($model,'RUBRO1_EMBNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO2_EMBNOM'); ?>
		<?php echo $form->textField($model,'RUBRO2_EMBNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO3_EMBNOM'); ?>
		<?php echo $form->textField($model,'RUBRO3_EMBNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO4_EMBNOM'); ?>
		<?php echo $form->textField($model,'RUBRO4_EMBNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO5_EMBNOM'); ?>
		<?php echo $form->textField($model,'RUBRO5_EMBNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO1_ORDNOM'); ?>
		<?php echo $form->textField($model,'RUBRO1_ORDNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO2_ORDNOM'); ?>
		<?php echo $form->textField($model,'RUBRO2_ORDNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO3_ORDNOM'); ?>
		<?php echo $form->textField($model,'RUBRO3_ORDNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO4_ORDNOM'); ?>
		<?php echo $form->textField($model,'RUBRO4_ORDNOM',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'RUBRO5_ORDNOM'); ?>
		<?php echo $form->textField($model,'RUBRO5_ORDNOM',array('size'=>15,'maxlength'=>15)); ?>
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