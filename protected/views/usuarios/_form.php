<script>
$(document).ready(function(){
   $(".espacio").keypress(function(event){
       if ( event.which == 32 ) {
            return false;
       }
      //$("#loescrito").html(event.which + ": " + String.fromCharCode(event.which))
   });
})
</script>

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
		<?php echo $form->textFieldRow($model2,'USERNAME',array('class'=>'espacio','size'=>28,'maxlength'=>28,'style'=>'text-transform: lowercase')); ?>
                 <div id="loescrito"></div>
		<?php echo $form->passwordFieldRow($model2,'PASS',array('class'=>'espacio','size'=>28,'maxlength'=>28)); ?>

	</div>

	<div class="row">
		<?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
		<?php echo $form->error($model2,'ACTIVO'); ?>
	</div>

	<div class="row">
		<?php echo CHtml::activeHiddenField($model2,'CREADO_POR',array('value'=>Yii::app()->user->name)); ?>
		<?php echo $form->error($model2,'CREADO_POR'); ?>
	</div>
	
	<div class="row">		
		<?php echo CHtml::activeHiddenField($model2,'CREADO_EL',array('value'=>date("Y.m.d H:i:s"))); ?>
		<?php echo $form->error($model2,'CREADO_EL'); ?>
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