<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'clasificacion-adi-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model2); ?>

	<div class="modal-body sin-overflow">
            
                <table style="width: 400px;">
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'ID',array('maxlength'=>12)); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('CODIGO'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('CLAS_NOM'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->radioButtonListRow($model2,'OBLIGATORIO',array('S'=>'Si','N'=>'No')); ?>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'POSICION'); ?>
                        </td>
                        <td></td>
                    </tr>
                </table>

		<div class="row">
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
            <?php $this->darBotonCancelar(array('data-dismiss'=>'modal'), $model2->isNewRecord ? '#' : array('admin')); ?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->