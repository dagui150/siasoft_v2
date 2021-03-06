<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'type' => 'horizontal',
	'id'=>'tipo-documento-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        
                <?php echo $form->errorSummary($model2); ?>
                <table style="width: 400px;">
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'ID',array('size'=>10,'maxlength'=>10)); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('CODIGO_DOC'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('DESCR_DOC'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'MASCARA',array('size'=>20,'maxlength'=>20)); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('MASCARA_DOC'); ?></td>
                    </tr>
                </table>

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
            <?php $this->darBotonEnviar($model2->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(array('data-dismiss'=>'modal')); ?>
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->