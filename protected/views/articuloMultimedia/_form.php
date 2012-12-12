<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'articulo-multimedia-form',
	'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                            'validateOnSubmit'=>true,
        ),
        'type'=>'horizontal',
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>
        
	<div class="row">
		<?php echo $form->textFieldRow($model,'ARTICULO',array('size'=>20,'maxlength'=>20)); ?>
                            
		<?php echo $form->textFieldRow($model,'TIPO',array('size'=>3,'maxlength'=>3)); ?>
	
		<?php echo $form->textFieldRow($model,'UBICACION',array('size'=>60,'maxlength'=>128)); ?>
	
		<?php echo $form->textFieldRow($model,'NOMBRE',array('size'=>60,'maxlength'=>64)); ?>

		<?php echo $form->textAreaRow($model,'DESCRIPCION',array('rows'=>6, 'cols'=>50)); ?>
	
		<?php echo $form->textFieldRow($model,'ORDEN'); ?>

		<?php echo CHtml::activeHiddenField($model,'ACTIVO',array('value'=>'S')); ?>

                <div class="row buttons" align ="center" style="margin: 0 0 0 -132px">
                        <?php 
                                $this->widget('bootstrap.widgets.BootButton', array(
                                            'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
                                            'buttonType'=>'submit',
                                            'type'=>'primary',
                                            'icon'=>$model->isNewRecord ? 'ok-circle white' : 'pencil white',
                                    )
                                );
                        ?>
               </div>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->