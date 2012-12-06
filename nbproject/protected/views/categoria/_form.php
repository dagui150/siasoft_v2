<div class="form">

<?php 
	$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'categoria-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),	
)); ?>

			<?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>
            <?php echo $form->dropDownListRow($model2, 'TIPO', array('C'=>'Cliente','P'=>'Proveedor')); ?>
            <?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>

	<div class="row-buttons" align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->