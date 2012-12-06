<div class="form">

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'impuesto-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),	
)); ?>

	<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

	<?php echo $form->errorSummary($model2); ?>

		<?php echo $form->textFieldRow($model2,'id',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->textFieldRow($model2,'nombre',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->textFieldRow($model2,'procentaje',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo CHtml::activeHiddenField($model2,'activo',array('value'=>'S')); ?>

	<div class="row-buttons" align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->