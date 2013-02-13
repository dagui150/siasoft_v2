<div class="form">
    <div>
<?php 
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'categoria-form',
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
                    <?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>
                </td>
                <td>
                    <?php echo $this->botonAyuda('DESCR_CATEGORIA'); ?>
                </td>
            </tr>
            <tr>
                <td>
                    <?php echo $form->dropDownListRow($model2, 'TIPO', array('C'=>'Cliente','P'=>'Proveedor')); ?>
                </td>
                <td>
                    <?php //echo $this->botonAyuda('Pruebas Boton Ayuda'); ?>
                </td>
            </tr>
        </table>
        <?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
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