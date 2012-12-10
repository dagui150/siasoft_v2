<div class="form">

<?php $form= $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'conf-as-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
		<?php echo $form->textFieldRow($model2,'IMPUESTO1_DESC',array('size'=>10,'maxlength'=>10)); ?>
		<?php //echo $form->textFieldRow($model2,'IMPUESTO2_DESC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->textFieldRow($model2,'PATRON_CCOSTO',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->textFieldRow($model2,'SIMBOLO_MONEDA',array('size'=>3,'maxlength'=>3)); ?>
	
	<div class="row-buttons" align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('site/index'), 'icon' => 'remove'));  ?>	
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->