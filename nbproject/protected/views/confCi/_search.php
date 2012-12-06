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
		<?php echo $form->label($model,'COSTOS_DEC'); ?>
		<?php echo $form->textField($model,'COSTOS_DEC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EXISTENCIAS_DEC'); ?>
		<?php echo $form->textField($model,'EXISTENCIAS_DEC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PESOS_DEC'); ?>
		<?php echo $form->textField($model,'PESOS_DEC'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COSTO_FISCAL'); ?>
		<?php echo $form->textField($model,'COSTO_FISCAL',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COSTO_COMPARATIVO'); ?>
		<?php echo $form->textField($model,'COSTO_COMPARATIVO',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'COSTO_INGR_DEFAULT'); ?>
		<?php echo $form->textField($model,'COSTO_INGR_DEFAULT',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UNIDAD_PESO'); ?>
		<?php echo $form->textField($model,'UNIDAD_PESO',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UNIDAD_VOLUMEN'); ?>
		<?php echo $form->textField($model,'UNIDAD_VOLUMEN',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EXIST_EN_TOTALES'); ?>
		<?php echo $form->textField($model,'EXIST_EN_TOTALES',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CLASIF_1'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLASIF_1',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CLASIF_2'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLASIF_2',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CLASIF_3'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLASIF_3',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CLASIF_4'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLASIF_4',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CLASIF_5'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLASIF_5',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NOMBRE_CLASIF_6'); ?>
		<?php echo $form->textField($model,'NOMBRE_CLASIF_6',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'INTEGRACION_CONTA'); ?>
		<?php echo $form->textField($model,'INTEGRACION_CONTA',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USA_CODIGO_BARRAS'); ?>
		<?php echo $form->textField($model,'USA_CODIGO_BARRAS',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LINEAS_MAX_TRANS'); ?>
		<?php echo $form->textField($model,'LINEAS_MAX_TRANS'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USA_UNIDADES_DIST'); ?>
		<?php echo $form->textField($model,'USA_UNIDADES_DIST',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ASISTENCIA_AUTOMAT'); ?>
		<?php echo $form->textField($model,'ASISTENCIA_AUTOMAT',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USA_CODIGO_EAN13'); ?>
		<?php echo $form->textField($model,'USA_CODIGO_EAN13',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USA_CODIGO_EAN8'); ?>
		<?php echo $form->textField($model,'USA_CODIGO_EAN8',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USA_CODIGO_UCC12'); ?>
		<?php echo $form->textField($model,'USA_CODIGO_UCC12',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'USA_CODIGO_UCC8'); ?>
		<?php echo $form->textField($model,'USA_CODIGO_UCC8',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EAN13_REGLA_LOCAL'); ?>
		<?php echo $form->textField($model,'EAN13_REGLA_LOCAL',array('size'=>18,'maxlength'=>18)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EAN8_REGLA_LOCAL'); ?>
		<?php echo $form->textField($model,'EAN8_REGLA_LOCAL',array('size'=>3,'maxlength'=>3)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'UCC12_REGLA_LOCAL'); ?>
		<?php echo $form->textField($model,'UCC12_REGLA_LOCAL',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'PRIORIDAD_BUSQUEDA'); ?>
		<?php echo $form->textField($model,'PRIORIDAD_BUSQUEDA',array('size'=>1,'maxlength'=>1)); ?>
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