<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'metodo-valuacion-inv-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

	
	<?php echo $form->errorSummary($model2); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model2,'ID',array('size'=>10,'maxlength'=>10)); ?>

		<?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>

	</div>

	<div class="row">
		<?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
		<?php echo $form->error($model2,'ACTIVO'); ?>
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
			/*$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>'Cancelar',
						//'buttonType'=>'submit',
						'type'=>'action',
						'icon'=>'remove', 
						'url'=>array('admin'), 
					)
			);*/
			
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->