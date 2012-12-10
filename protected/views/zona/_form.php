<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'type' => 'horizontal',
	'id'=>'zona-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
 
	<?php echo $form->errorSummary($model2); ?>

		<?php echo $form->dropDownListRow($model2,'PAIS', CHtml::listData(Pais::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione...')); ?>
		<?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>

	<div class="row">
		<?php
			echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S'));
			echo $form->error($model2,'ACTIVO'); 
		?>
	</div>
    </div>
	<div class="modal-footer" align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => '#', 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal')));  ?>	
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->