<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'nit-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

		<?php echo $form->dropDownListRow($model2,'TIIPO_DOCUMENTO', CHtml::listData(TipoDocumento::model()->findAll(),'ID','DESCRIPCION'),
		array('empty'=>'Seleccione...',		
			'ajax'=>array(
				'type' => 'POST',
				'url' => CController::createUrl('mascara'),
				'update' => '#Nit_ID'
				)
				
		)); ?>
		<?php echo $form->textFieldRow($model2,'ID',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->textFieldRow($model2,'RAZON_SOCIAL',array('maxlength'=>128)); ?>
		<?php echo $form->textFieldRow($model2,'ALIAS',array('maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model2,'OBSERVACIONES'); ?>
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