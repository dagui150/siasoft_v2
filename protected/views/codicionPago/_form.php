<div class="form">
    <div>
<?php $form= $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'codicion-pago-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<?php echo $form->errorSummary($model2); ?>
        <table style="width: 400px;">
            <tr>
                <td>
                    <?php echo $form->textFieldRow($model2,'ID',array('size'=>4,'maxlength'=>4)); ?>
                </td>
                <td><?php echo $this->botonAyuda('CODIGO'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>
                </td>
                <td><?php echo $this->botonAyuda('DESCR_CP'); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->textFieldRow($model2,'DIAS_NETO'); ?>
                </td>
                <td><?php echo $this->botonAyuda('DIAS_CP'); ?></td>
            </tr>
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
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('admin'), 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal')));  ?>	        
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->