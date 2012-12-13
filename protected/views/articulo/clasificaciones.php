<script>
    $(document).ready(function(){

            var nombreClase;
            var nombreCampoDependiente;
            var contador;
            $("#articulo-form").validate();
            
            $(".eliminarRegistro").live("click",eliminarRegistro)
            
            $(".tonces").live("change", function () {

                //Obtenemos el numero del campo
                contador = $(this).attr('id').split('_')[1];
                nombreClase = $(this).attr('id').split('_')[0];
                
                nombreCampoDependiente = nombreClase+'_'+contador+'_'+ 'VALOR';
                
                $.getJSON('<?php echo CController::createUrl('Articulo/cargar'); ?>&ClasificacionAdiValor='+$(this).attr('value'),
                      function(data)
                      {
                          
                            $('#'+nombreCampoDependiente).find('option').each(function(){ $(this).remove(); });
                            
                            $('#'+nombreCampoDependiente).append("<option value=''>Seleccione</option>");
                                                          
                            $.each(data, function(value, name) {
                                $('#'+nombreCampoDependiente).append("<option value='"+value+"'>"+name+"</option>");
                            });
                      });

        });
    });
    
    function eliminarRegistro(){
       var  idFila = $(this).attr('name');
       var eliminarOculto = $("#eliminar").val()
       var idCampo = $("#ClasificAdiArticulo_"+idFila+"_ID").val();
       
        eliminarOculto = eliminarOculto + idCampo +",";
        $("#eliminar").val(eliminarOculto);

    }
</script>

<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>

<table class="templateFrame table table-bordered" cellspacing="0">
     <thead>
           <tr>
               <td>
                   <?php echo $form->labelEx(ClasificacionAdiValor::model(),'CLASIFICACION') ?>
               </td>
               <td>
                   <?php echo $form->labelEx(ClasificAdiArticulo::model(),'VALOR') ?>
              </td>
              <td></td>
           </tr>
     </thead>
     <tfoot>
           <tr>
              <td colspan="4">
                    <div class="add" style="width: 80px;">
                           <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                 'buttonType'=>'button',
                                                 'type'=>'success',
                                                 'label'=>'Nuevo',
                                                 'icon'=>'plus white',
                                         )); 
                          ?>
                     </div>
                     <textarea class="template" rows="0" cols="0" style="display: none;">
                            <tr class="templateContent">
                                    <td>
                                        <?php echo CHtml::dropDownList('ClasificacionNuevo[{0}][CLASIFICACION]','',ClasificacionAdiValor::getClasiAdiValor(),array('style'=>'width:100px','prompt' => 'Seleccione','class' => 'tonces') ); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::dropDownList('ClasificacionNuevo[{0}][VALOR]','',array(),array('prompt'=>'Seleccione')); ?>
                                    </td>
                                    <td>
                                        <div class="remove">
                                               <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                         'buttonType'=>'button',
                                                         'type'=>'danger',
                                                         'label'=>'Eliminar',
                                                         'icon'=>'minus white',
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
     <tbody class="templateTarget">
            <?php 
                $linObligatorias = ClasificacionAdi::model()->findAllByAttributes(array('OBLIGATORIO'=>'S'));
                if(!$model->isNewRecord) { 
                    foreach($lineas as $i=>$person){ 
             ?>
                    <tr class="templateContent">
                        <td>
                                <?php echo $form->hiddenField($person,"[$i]ID");  ?>
                                <?php echo $form->textField(ClasificAdiArticulo::model(),"[$i]CLASIFICACION",array('disabled'=>true,'value'=>  ClasificacionAdiValor::darNombre($person->VALOR,false)));  ?>
                         </td>
                         <td>
                                <?php echo  $form->textField($person,"[$i]VALOR",array('readonly'=>true,'value'=>  ClasificacionAdiValor::darNombre($person->VALOR,true))); ?>
                         </td>
                         <td>
                             <div class="remove">
                                   <?php 
                                        $this->widget('bootstrap.widgets.BootButton', array(
                                             'buttonType'=>'button',
                                             'type'=>'danger',
                                             'label'=>'Eliminar',
                                             'icon'=>'minus white',
                                             'htmlOptions'=>array('id'=>'remover','class'=>'eliminarRegistro','name'=>$i)
                                         ));
                                        
                                    ?>
                              </div>
                        </td>
                   </tr>
           <?php 
              
                }
            }else{
                
                foreach($linObligatorias as $i=>$person): ?>
                   <tr class="templateContent">
                        <td>
                                <?php echo $form->textField($person,"[$i]NOMBRE",array('disabled'=>true));  ?>
                         </td>
                         <td>
                               <?php echo CHtml::dropDownList("ObligaClasificacionNuevo[$i][VALOR]",'',CHtml::listData(ClasificacionAdiValor::model()->findAll('CLASIFICACION = "'.$person->ID.'"'),'ID','VALOR'),array('empty'=>'Seleccione','class'=>'required')); ?>
                         </td>
                         <td>
                               <?php 
                                        $this->widget('bootstrap.widgets.BootButton', array(
                                             'buttonType'=>'button',
                                             'type'=>'danger',
                                             'label'=>'Eliminar',
                                             'icon'=>'minus white',
                                             'htmlOptions'=>array('disabled'=>true)
                                         ));
                                        
                              ?>
                        </td>
                   </tr>
                    
            <?php endforeach; 
            }
           ?>
                   
     </tbody>
     
</table>
<?php echo CHtml::hiddenField('eliminar'); ?>