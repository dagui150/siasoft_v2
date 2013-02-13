<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'type' => 'horizontal',
	'id'=>'zona-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
 
	<?php echo $form->errorSummary($model2); ?>

		<table style="width: 200px">
                <tr>
                    <td>
                        <?php echo $form->dropDownListRow($model2,'PAIS', CHtml::listData(Pais::model()->findAll('ACTIVO = "S"'),'ID','NOMBRE'),array('empty'=>'Seleccione...')); ?>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>
                    </td>
                    <td><?php echo $this->botonAyuda('NOM_ZONA'); ?></td>
                </tr>
                </table>

	<div class="row">
		<?php
			echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S'));
			echo $form->error($model2,'ACTIVO'); 
		?>
	</div>
    </div>
	<div class="modal-footer" align="center">
            <?php $this->darBotonEnviar($model2->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(array('data-dismiss'=>'modal')); ?>
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->