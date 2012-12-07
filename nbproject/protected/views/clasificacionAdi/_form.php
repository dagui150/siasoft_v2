<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'clasificacion-adi-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model2); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model2,'ID',array('maxlength'=>12)); ?>

		<?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>

		<?php echo $form->textFieldRow($model2,'POSICION'); ?>

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