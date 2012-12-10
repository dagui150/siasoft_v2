<script>
    $(document).ready(inicio);

    function inicio(){
        $(".eliminarCantidad").live("click", eliminarCantidad);
        $("#TipoTransaccion_TRANSACCION_BASE").change(mostrar);
        //$("#nuevo").click(habilitarEliminar);
    }
    function mostrar(){
        id = $(this).attr('value');
         
        $('#btn-nuevo').slideDown('fast');
        $('#nuevo').css('display','block');
        
        switch(id){
            case 'APRO':
                enviarJSON(id);
            break;
            case 'COMP':
                enviarJSON(id);
            break;
            case 'CONS':
                habilidar();
            break;
            case 'COST':
                $('#contenidoNuevo').html('');
                $('#nuevo').css('display','none');
                $("#mensaje").addClass('alert alert-info');
                $("#mensaje").html('<strong>Tipo de Transaccion Costo no afecta ninguna cantidad</strong>');
            break;
            case 'ENSA':
                habilidar();
            break;
            case 'FISI':
                habilidar();
            break;
            case 'MISC':
                habilidar();
            break;
            case 'PROD':
                habilidar();
            break;
            case 'RESE':
                enviarJSON(id);
            break;
            case 'TRAS':
                habilidar();
            break;
            case 'VENC':
                enviarJSON(id);
            break;
            case 'VENT':
                enviarJSON(id);
            break;
        }
    }
    //habilitar() se encarga de habilitar el boton nuevo y eliminar para seleccionar las cantidades necesarias
     
    function habilidar(){
        $("#mensaje").html('');
        $("#mensaje").removeClass('alert alert-info');
        
        $('#contenidoNuevo').html('');
        
    }
    
    /*
     *enviarJSON() se en carga de enviar el id seleccionado y revisar que cantidades 
     *tiene asociadas y mostrarlas en pantalla sin poder editarlas ni eliminarlas
    */
    function enviarJSON(id){
        contador = 0;
        var nombre;
        
        $("#mensaje").html('');
        $("#mensaje").removeClass('alert alert-info');
        
        $.getJSON('<?php echo CController::createUrl('tipoTransaccion/cargarcantidad');?>&id='+id,
		  function(data){
                        $('#contenidoNuevo').html('');
                        $.each(data, function(key, tipo) {
                            $.getJSON('<?php echo CController::createUrl('tipoTransaccion/cargarcantidad');?>&cantidad='+tipo.CANTIDAD,
                                      function(data){
                                          nombre = data.NOMBRE;
                                          
                                          $('#nuevo').click();
                                          
                                          $('#CantidadNuevo_'+contador+'_CANTIDAD').find('option').each(function(){ $(this).remove(); });

                                          $('#CantidadNuevo_'+contador+'_CANTIDAD').append("<option value='"+tipo.CANTIDAD+"'>"+nombre+"</option>");
                                          
                                          $('#CantidadNuevo_'+contador+'_CANTIDAD').attr("readonly",true);
                                          
                                          $("#remueve_"+contador).removeClass('remove');
                                          
                                          contador++;
                                      }
                            );
                        });
                        $('#nuevo').css('display','none');
		  }
        ).error(function(jqXHR, textStatus, errorThrown) {
            $("#respuesta").html(jqXHR.responseText);
        });
        
    }
    function eliminarCantidad(){
        idFila = $(this).attr('name');
        eliminarOculto = $("#eliminarCantidad").val()
        idCampo = $("#TipoTransaccionCantidad_"+idFila+"_ID").val();


        eliminarOculto = eliminarOculto + idCampo +",";
        $("#eliminarCantidad").val(eliminarOculto);

    }
</script>
<?php if($model2->isNewRecord) :?>
    <div id="mensaje" class="alert alert-info">
            <i><strong>Por favor Seleccione Transaccion base</strong><i>
    </div>
<?php endif; ?>

<?php if(!$model2->isNewRecord) :?>
    <div class="complex">
            <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                    <thead class="templateHead">
                       <tr>
                           <td>
                               <?php echo $form->labelEx(TipoTransaccionCantidad::model(),'CANTIDAD') ?>
                           </td>
                      </tr>
                    </thead>
                    <tbody class="templateTarget">
                        <?php foreach($cantidad as $i=>$person): ?>
                            <tr class="templateContent">
                            
                            <td>
                                <?php echo  $form->dropDownList($person,"[$i]CANTIDAD",CHtml::listData(TipoCantidadArticulo::model()->findAll(),'ID','NOMBRE'),array('disabled'=>$model2->getCantidad($model2->TRANSACCION_BASE))); ?>
                                <?php echo $form->hiddenField($person,"[$i]ID",''); ?>
                            </td>
                                <td>
                                     <div class="remove">
                                          <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'buttonType'=>'button',
                                                            'type'=>'danger',
                                                            'label'=>'Eliminar',
                                                            'icon'=>'minus white',
                                                            'htmlOptions'=>array('class'=>'eliminarCantidad','name'=>$i,'disabled'=>$model2->getCantidad($model2->TRANSACCION_BASE))

                                                ));
                                          ?>
                                          
                                     </div>
                                </td>
                           </tr>
                       <?php  endforeach ?>
                   </tbody>
                </table>
                <?php echo CHtml::hiddenField('eliminarCantidad','' ); ?>
            </div><!--panel-->
    </div><!--complex-->
<?php endif; ?>
    
<div id="respuesta"></div>   
    
<div class="complex" >
        <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                <thead class="templateHead">
                   <tr>
                       <td>
                           <?php if($model2->isNewRecord) :?>
                                  <?php echo $form->labelEx(TipoTransaccionCantidad::model(),'CANTIDAD') ?>
                           <?php endif;?>
                           <?php if(!$model2->isNewRecord) :?>
                                  <span id="label" style="<?php echo $cantidad ? 'display: none' : '';?>">
                                       <?php echo $form->labelEx(TipoTransaccionCantidad::model(),'CANTIDAD') ?>
                                  </span>
                           <?php endif;?>
                       </td>
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="4">
                             <div id="nuevo" class="add" style='width: 80px;<?php if($model2->isNewRecord) echo 'display: none';?>'>
                                  
                                   <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                 'buttonType'=>'button',
                                                 'type'=>'success',
                                                 'label'=>'Nuevo',
                                                 'icon'=>'plus white',
                                                 'htmlOptions'=>array('id'=>'btn-nuevo','disabled'=>$model2->getCantidad($model2->TRANSACCION_BASE))
                                         )); 
                                   ?>
                            </div>
                            <textarea class="template" rows="0" cols="0" style="display: none; width: 30px;">
                                <tr class="templateContent">
                                   
                                    <td>
                                        <?php echo CHtml::dropDownList('CantidadNuevo[{0}][CANTIDAD]','',CHtml::listData(TipoCantidadArticulo::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione')); ?>
                                    </td>
                                    <td>
                                        <div id='remueve_<?php echo '{0}';?>' class="remove">
                                               <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                         'buttonType'=>'button',
                                                         'type'=>'danger',
                                                         'label'=>'Eliminar',
                                                         'icon'=>'minus white',
                                                         //'htmlOptions'=>array('disabled'=>false, 'name'=>'{0}')
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
                <tbody id="contenidoNuevo" class="templateTarget">
                    <?php $persons = array(); foreach($persons as $i=>$person): ?>
                        <tr class="templateContent">
                            
                            <td>
                                <?php echo  $form->textField($person,"[$i]CANTIDAD"); ?>
                            </td>
                            <td>
                                 <div id="remueve_<?echo $i;?>" class="remove">
                                      <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                        'buttonType'=>'button',
                                                        'type'=>'danger',
                                                        'label'=>'Eliminar',
                                                        'icon'=>'minus white',
                                                        //'htmlOptions'=>array('id'=>'remueve','disabled'=>false, 'name'=> $i)
                                            ));
                                      ?>
                                 </div>
                            </td>
                       </tr>
                   <?php  endforeach ?>
               </tbody>
            </table>
        </div><!--panel-->
</div><!--complex-->