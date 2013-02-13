<div class="form">
    <div class="modal-body sin-overflow">
<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'bodega-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),	
)); ?>
        <?php echo $form->errorSummary($model2); ?>
                <table style="width: 400px;">
                    <tr>



        <table width="100%" border='1'>

            <tr>
                <td width="2%" ><?php echo $form->textFieldRow($model2, 'ID', array('size' => 4, 'maxlength' => 4, 'disabled' => $model2->isNewRecord ? false : true)); ?></td>
                <td><?php echo $this->botonAyuda('CODIGO_BODEGA'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->textAreaRow($model2, 'DESCRIPCION'); ?></td>
                <td><?php echo $this->botonAyuda('DESCR_BODEGA'); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->dropDownListRow($model2, 'TIPO', array('C' => 'Consumo', 'V' => 'Ventas', 'N' => 'No Disponible')); ?></td>
                <td><?php //echo $this->botonAyuda('Pruebas Boton Ayuda'); ?> </td>
            </tr>
            <tr>
                <td><?php echo $form->textFieldRow($model2, 'TELEFONO', array('maxlength' => 20)); ?></td>
            </tr>
            <tr>
                <td><?php echo $form->textFieldRow($model2, 'DIRECCION', array('maxlength' => 128)); ?></td>
            </tr>
        </table>

        <?php echo CHtml::activeHiddenField($model2, 'ACTIVO', array('value' => 'S')); ?>


        </div>
        <div>
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