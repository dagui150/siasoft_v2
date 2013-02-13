<div class="form">
    <div>
<?php $form= $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'centro-costos-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        
            <?php echo $form->errorSummary($model2); ?>
                <?php $mask = $config->PATRON_CCOSTO; ?>
        <table style="width: 400px;">
                    <tr>
                        <td>
                            <div class="control-group "><label for="CentroCostos_ID" class="control-label required">Codigo <span class="required">*</span></label><div class="controls"> 
                           <?php $this->widget('CMaskedTextField', array(
                                'model' => $model2,
                                'attribute' => 'ID',
                    'mask' => $mask, 
                   'htmlOptions'=>array('readonly'=>$model2->isNewRecord ? false : true),
                            ));
                            ?>
                           </div></div>
                        </td>
                        <td><?php echo $this->botonAyuda('CODIGO_CC'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php //echo $form->textFieldRow($model2,'ID',array('size'=>25,'maxlength'=>25)); ?>
                            <?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('DESCR_CC'); ?></td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->dropDownListRow($model2, 'TIPO', array('G'=>'Gasto','I'=>'Ingreso', 'A' => 'Ambos')); ?>
                        </td>
                        <td><?php echo $this->botonAyuda('TIPO_CC'); ?></td>
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