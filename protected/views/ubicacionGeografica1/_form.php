<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'type' => 'horizontal',
	'id'=>'ubicacion-geografica1-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

		<?php echo $form->textFieldRow($model2,'ID',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->dropDownListRow($model2,'PAIS', CHtml::listData(Pais::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione...')); ?>
		<?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>

	<div class="row">
		<?php
			echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S'));
			echo $form->error($model2,'ACTIVO'); 
		?>
	</div>


	<div class="row-buttons" align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->