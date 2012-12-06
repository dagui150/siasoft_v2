<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'unidad-medida-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

		<?php echo $form->errorSummary($model2); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>

		<?php echo $form->textFieldRow($model2,'ABREVIATURA',array('size'=>5,'maxlength'=>5)); ?>

		<?php echo $form->dropDownListRow($model2,'TIPO',array(''=>'Seleccione','L'=>'Longitud','V'=>'Volumen','P'=>'Peso')); ?>

		<?php echo $form->dropDownListRow($model2,'UNIDAD_BASE',CHtml::ListData(UnidadMedida::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione')); ?>

		<?php echo $form->textFieldRow($model2,'EQUIVALENCIA'); ?>

		<div class="row">
			<?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
			<?php echo $form->error($model2,'ACTIVO'); ?>
		</div>
	</div>

	<div class="row buttons" align="center">
		<?php
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar',
						'buttonType'=>'submit',
						'type'=>'primary',
						'icon'=>'ok-circle white', 
					)
			);
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->