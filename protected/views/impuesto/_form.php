<div class="form">
    <div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'impuesto-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model2); ?>

	<div class="row">
                <table style="width: 400px;">
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'ID',array('size'=>4,'maxlength'=>4)); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('CODIGO'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'PROCENTAJE',array('maxlength'=>28, 'prepend'=>'%')); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
            
		
		<?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
		<?php echo $form->error($model2,'ACTIVO'); ?>
	
        </div>
    </div>
	<?php if($model2->isNewRecord): ?>
        <div class="modal-footer" align="center">
        <?php endif ?>

        <?php if(!$model2->isNewRecord): ?>
        <div class="row-buttons" align="center">
            <?php endif ?>
            <?php $this->darBotonEnviar($model2->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(array('data-dismiss'=>'modal')); ?>
        </div>
        
<?php $this->endWidget(); ?>

</div><!-- form -->