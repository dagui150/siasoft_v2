<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'clasificacion-adi-valor-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

	

	<?php echo $form->errorSummary($model2); ?>

	<div class="modal-body">
                
                <table style="width: 400px;">
                    <tr>
                        <td>
                            <?php echo $form->dropDownListRow($model2,'CLASIFICACION',CHtml::ListData(ClasificacionAdi::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione')); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('CLAS_ADI_VAL_CLAS'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'VALOR',array('maxlength'=>12)); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('CLAS_ADI_VAL_VAL'); ?></td>
                    </tr>
                </table>


	</div>

	<?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>

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