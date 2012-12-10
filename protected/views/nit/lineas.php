<script>
    $(document).ready(function (){
        $('.eliminaLinea').click(function(){
            var  idFila = $(this).attr('name');
            var eliminarOculto = $("#eliminarLinea").val()
            var idCampo = $("#NitLinea_"+idFila+"_ID").val();
            eliminarOculto = eliminarOculto + idCampo +",";
            $("#eliminarLinea").val(eliminarOculto);
        });
    });
</script>

<div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">


<table class="templateFrame table table-bordered" cellspacing="0" >
    <thead>
        <tr>
            <td><strong>Tipo de Documento</strong></td>
            <td><strong>Numero Documento</strong></td>
            <td><strong>Razón Social</strong></td>
            <td><strong>Alias</strong></td>
            <td><strong>Observaciones</strong></td>
            <td style="width:80px"></td>
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
                        'size' => 'small',
                    ));
                    ?>
                </div>
                <textarea class="template" rows="0" cols="0" style="display: none;">
                                <tr class="templateContent">
                                
                                    <td> <?php echo CHtml::dropDownList('LineaNueva[{0}][TIIPO_DOCUMENTO]', '', CHtml::listData(TipoDocumento::model()->findAll(),'ID','DESCRIPCION'), array('empty'=>'Seleccione...','class'=>'tipos')); ?></td>
                                    <td> <?php echo CHtml::textField('LineaNueva[{0}][ID]', ''); ?></td>
                                    <td> <?php echo CHtml::textField('LineaNueva[{0}][RAZON_SOCIAL]', ''); ?> </td>
                                    <td> <?php echo CHtml::textField('LineaNueva[{0}][ALIAS]', ''); ?> </td>
                                    <td> <?php echo CHtml::textField('LineaNueva[{0}][OBSERVACIONES]', ''); ?> </td>

                                    <td>
                                        <div class="remove" style="width:80px">
                                            <?php
                                            $this->widget('bootstrap.widgets.BootButton', array(
                                                'type' => 'danger',
                                                'icon' => 'minus white',
                                                'label' => 'Eliminar',
                                                'size' => 'small',
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
        $concepto = $model->isNewRecord ? array() : $tablaNits;
        foreach ($concepto as $i => $concep):
            ?>
            <tr class="templateContent">
            
                <td>
                                   
                    
                    <?php echo CHtml::activeDropDownList($concep, "[$i]TIIPO_DOCUMENTO", CHtml::listData(TipoDocumento::model()->findAll(),'ID','DESCRIPCION')); ?>                          
                </td>
                
                <td>
                    <?php echo CHtml::activetextField($concep, "[$i]ID"); ?> 
                    
                </td>
                
                <td>
                    <?php echo CHtml::activetextField($concep, "[$i]RAZON_SOCIAL"); ?>
                </td>
                
                <td>
                    <?php echo CHtml::activetextField($concep, "[$i]ALIAS"); ?>
                </td>
                
                <td>
                    <?php echo CHtml::activetextField($concep, "[$i]OBSERVACIONES"); ?>
                </td>
                
                <td>
                    <div class="remove">
                        <?php
                        $this->widget('bootstrap.widgets.BootButton', array(
                            'type' => 'danger',
                            'icon' => 'minus white',
                            'label' => 'Eliminar',
                            'htmlOptions' => array('class' => 'eliminaLinea', 'name' => $i,)
                        ));
                        ?>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
        <?php echo CHtml::hiddenField('eliminarLinea', ''); ?>    
    </tbody>
</table>
    
    </div>