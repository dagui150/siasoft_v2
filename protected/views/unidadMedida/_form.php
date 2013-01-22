<script>
    $(document).ready(inicio);
    
    function inicio(){
        
        $('#UnidadMedida_TIPO').change(function(){
            
            $.getJSON('<?php echo $this->createUrl('cargarbase')?>&tipo='+$(this).val(),
                function(data){
                    $('#UnidadMedida_UNIDAD_BASE').val(data.ID);
                    $('#UNIDAD_BASE').val(data.NOMBRE);
                });
        });
    }

</script>
<div class="form ">
    <div class="modal-body sin-overflow">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'unidad-medida-form',
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
                                <?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>
                            </td>
                            <td><?php echo $this->botonAyuda('NOM_UNID_MED'); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $form->textFieldRow($model2,'ABREVIATURA',array('size'=>5,'maxlength'=>5)); ?>
                            </td>
                            <td><?php echo $this->botonAyuda('ABRE_UNID_MED'); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $form->dropDownListRow($model2,'TIPO',array(''=>'Seleccione','U'=>'Unidad','L'=>'Longitud','V'=>'Volumen','P'=>'Peso','S'=>'Servicio')); ?>
                            </td>
                            <td><?php echo $this->botonAyuda('TIPO_UNID_MED'); ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $form->hiddenField($model2,'UNIDAD_BASE'); ?>
                                 <div class="control-group ">
                                        <?php echo $form->labelEx($model2,'UNIDAD_BASE',array('class'=>'control-label')); ?>
                                        <div class="controls">   
                                             <?php echo CHtml::textField('UNIDAD_BASE',!$model2->isNewRecord ? $model2->uNIDADBASE->NOMBRE : '',array('disabled'=>true)); ?>
                                             <?php echo $form->error($model2,'UNIDAD_BASE');?>
                                        </div>
                                </div>
                            </td>
                            <td>
                                <?php echo $this->botonAyuda('UBASE_UNID_MED'); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php echo $form->textFieldRow($model2,'EQUIVALENCIA'); ?>
                            </td>
                            <td>
                                <?php echo $this->botonAyuda('EQUI_UNID_MED'); ?>
                            </td>
                        </tr>
                    </table>

                        <div class="row">
                                <?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
                                <?php echo $form->error($model2,'ACTIVO'); ?>
                        </div>
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