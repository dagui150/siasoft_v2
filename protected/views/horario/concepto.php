<script>
    $(document).ready(function (){
        $('.eliminaConcepto').click(function(){
            var  idFila = $(this).attr('name');
            var eliminarOculto = $("#eliminarConcepto").val()
            var idCampo = $("#HorarioConcepto_"+idFila+"_ID").val();
            eliminarOculto = eliminarOculto + idCampo +",";
            $("#eliminarConcepto").val(eliminarOculto);
        });
    });
</script>

<table class="templateFrame table table-bordered" cellspacing="0">
    <thead>
        <tr>
            <td><strong>Dia</strong></td>
            <td><strong>Hora Inicio</strong></td>
            <td><strong>Hora Fin</strong></td>
            <td></td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="4">
                <div class="add" style='width: 80px;'>
                    <?php
                    $this->widget('bootstrap.widgets.BootButton', array(
                        'type' => 'success',
                        'label' => 'Nuevo',
                        'icon' => 'plus white',
                    ));
                    ?>
                </div>
                <textarea class="template" rows="0" cols="0" style="display: none;">
                                <tr class="templateContent">
                                
                                    <td><?php echo CHtml::dropDownList('ConceptoNuevo[{0}][DIA]', '', CHtml::listData(Dia::model()->findAll(), 'DIA', 'NOMBRE')); ?></td>
                                    <td> <?php echo CHtml::textField('ConceptoNuevo[{0}][INICIO]', ''); ?></td>
                                    <td> <?php echo CHtml::textField('ConceptoNuevo[{0}][FIN]', ''); ?> </td>
                                    <td>
                                        <div class="remove">
                                            <?php
                                            $this->widget('bootstrap.widgets.BootButton', array(
                                                'type' => 'danger',
                                                'icon' => 'minus white',
                                                'label' => 'Eliminar',
                                            ));
                                            ?>
                                        </div>
                                            <input type="hidden" class="rowIndex" value="{0}" />
                                    </td>
                                </tr>
                </textarea>
            </td>
        </tr>
    </tfoot>
    <tbody id="body-nuevo" class="templateTarget">
        <?php
        $concepto = $model->isNewRecord ? array() : $tablaConceptos;
        foreach ($concepto as $i => $concep):
            ?>
            <tr class="templateContent">
            
                <td>
                    <?php echo CHtml::activeHiddenField($concep, "[$i]ID"); ?>                
                    <input type="hidden" class="horarioIndex" value='<?php echo $i ?>' />
                    <?php echo CHtml::activeDropDownList($concep, "[$i]DIA", CHtml::listData(Dia::model()->findAll(), 'DIA', 'NOMBRE')); ?>                          
                </td>
                
                <td>
                    <?php echo CHtml::activetextField($concep, "[$i]HORA_INICIO"); ?>
                </td>
                
                <td>
                    <?php echo CHtml::activetextField($concep, "[$i]HORA_FIN"); ?>
                </td>
                
                <td>
                    <div class="remove">
                        <?php
                        $this->widget('bootstrap.widgets.BootButton', array(
                            'type' => 'danger',
                            'icon' => 'minus white',
                            'label' => 'Eliminar',
                            'htmlOptions' => array('class' => 'eliminaConcepto', 'name' => $i,)
                        ));
                        ?>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
        <?php echo CHtml::hiddenField('eliminarConcepto', ''); ?>    
    </tbody>
</table>