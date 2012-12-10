<script>
$(document).ready(inicio);

function inicio(){
    $(".eliminarRegistro").live("click", eliminarRegistro);
}
function eliminarRegistro(){
    idFila = $(this).attr('name');
    eliminarOculto = $("#eliminar").val()
    idCampo = $("#SubtipoTransaccion_"+idFila+"_ID").val();
    
    
    eliminarOculto = eliminarOculto + idCampo +",";
    $("#eliminar").val(eliminarOculto);
    
}


</script>
<?php if(!$model2->isNewRecord) :?>
    <?php echo $form->hiddenField($model2,'TRANSACCION_FIJA') ?>
    <div class="complex">
            <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                    <thead class="templateHead">
                       <tr>
                           <td>
                               <?php echo $form->labelEx(SubtipoTransaccion::model(),'NOMBRE') ?>
                           </td>
                      </tr>
                    </thead>
                    <tbody class="templateTarget">
                        <?php foreach($subTipo as $i=>$person): ?>
                            <tr class="templateContent">
                            
                            <td>
                                <?php echo  $form->textField($person,"[$i]NOMBRE"); ?>
                                <?php echo $form->hiddenField($person,"[$i]ID",''); ?>
                            </td>
                                <td>
                                     <div class="remove">
                                          <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'buttonType'=>'button',
                                                            'type'=>'danger',
                                                            'label'=>'Eliminar',
                                                            'icon'=>'minus white',
                                                            'htmlOptions'=>array('class'=>'eliminarRegistro','name'=>$i)

                                                ));
                                          ?>
                                          
                                     </div>
                                </td>
                           </tr>
                       <?php  endforeach ?>
                   </tbody>
                </table>
                <?php echo CHtml::hiddenField('eliminar','' ); ?>
            </div><!--panel-->
    </div><!--complex-->
<?php endif; ?>
    
    
<div class="complex">
        <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                <thead class="templateHead">
                   <tr>
                       <td>
                           <?php if($model2->isNewRecord) :?>
                                  <?php echo $form->labelEx(SubtipoTransaccion::model(),'NOMBRE') ?>
                           <?php endif;?>
                           <?php if(!$model2->isNewRecord) :?>
                                  <span id="label" style="<?php echo $subTipo ? 'display: none' : '';?>">
                                       <?php echo $form->labelEx(SubtipoTransaccion::model(),'NOMBRE') ?>
                                  </span>
                           <?php endif;?>
                       </td>
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
                            <textarea class="template" rows="0" cols="0" style="display: none; width: 30px;">
                                <tr class="templateContent">
                                   
                                    <td>
                                        <?php echo CHtml::textField('SubtipoTransaccionNuevo[{0}][NOMBRE]','',array()); ?>
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
                    <?php $persons = array(); foreach($persons as $i=>$person): ?>
                        <tr class="templateContent">
                            
                            <td>
                                <?php echo  $form->textField($person,"[$i]NOMBRE"); ?>
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
                            </td>
                       </tr>
                   <?php  endforeach ?>
               </tbody>
            </table>
        </div><!--panel-->
</div><!--complex-->