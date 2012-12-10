<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'retencion-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <table>
        <tr>
            <td widht="20%">
                <?php echo $form->textFieldRow($model,'ID',array('size'=>4,'maxlength'=>4)); ?>
            </td>
            <td>
                <?php echo $form->textFieldRow($model,'NOMBRE',array('size'=>30,'maxlength'=>64)); ?>
            </td>
        </tr>
    </table>
    
    

          <table width="100%" border="0" cellspacing="0" cellpadding="10">
                 <tr>
                    <td><fieldset><legend>Modo de aplicaci&oacute;n</legend>
                    <?php echo $form->radioButtonListRow($model,'TIPO',array('R'=>'Aplicar al registrar','C'=>'Aplicar al cancelar')); ?>
                 </fieldset></td>
                 <td><fieldset><legend>Montos</legend>
                    <?php echo $form->textFieldRow($model,'PORCENTAJE',array('size'=>12,'maxlength'=>28, 'prepend'=>'%')); ?>
                    <br />
                    <?php echo $form->textFieldRow($model,'MONTO_MINIMO',array('size'=>16,'maxlength'=>28)); ?>		
                </fieldset></td>
                </tr>
                <tr>
                <td colspan="2"><fieldset><legend>Aplicar retenci&oacute;n a:</legend>
                <table>
                <tr>
                <td width = "50%"> <?php echo $form->checkBoxRow($model,'APLICA_MONTO').
                                    $form->checkBoxRow($model,'APLICA_SUBTOTAL').
                                    $form->checkBoxRow($model,'APLICA_SUB_DESC').'<td>
                <td width = "50%">'.$form->checkBoxRow($model,'APLICA_IMPUESTO1').
                                    $form->checkBoxRow($model,'APLICA_RUBRO1').
                                    $form->checkBoxRow($model,'APLICA_RUBRO2').'<td>
                </tr>
                </table>
                    
                    
               </fieldset></td>
               </tr>
            </table>'; ?> 
    
    
			<?php echo CHtml::activeHiddenField($model,'ACTIVO',array('value'=>'S')); ?>

	<div class="row-buttons" align="center">
                <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
                <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => '#', 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal')));  ?>	        
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->