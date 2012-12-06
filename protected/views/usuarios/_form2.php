<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'usuarios-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model2); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model2,'USERNAME',array('size'=>28,'maxlength'=>28,'disabled'=>'true')); ?>

		<?php echo $form->passwordFieldRow($model2,'PASS',array('size'=>28,'maxlength'=>28)); ?>

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
		<?php
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>'Cancelar',
						//'buttonType'=>'submit',
						'type'=>'action',
						'icon'=>'remove', 
						'url'=>array('admin'), 
					)
			);
			
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->