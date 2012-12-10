<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'type' => 'horizontal',
	'id'=>'tipo-documento-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

                <?php echo $form->errorSummary($model2); ?>
		<?php echo $form->textFieldRow($model2,'ID',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>
		<?php echo $form->textFieldRow($model2,'MASCARA',array('size'=>20,'maxlength'=>20)); ?>

	<div class="row">
		<?php
			echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S'));
			echo $form->error($model2,'ACTIVO'); 
		?>
	</div>
    </div>
	<?php if($model2->isNewRecord): ?>
        <div class="modal-footer" align="center">
        <?php endif ?>

        <?php if(!$model2->isNewRecord): ?>
        <div class="row-buttons" align="center">
        <?php endif ?>
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => '#', 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal')));  ?>	        
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->