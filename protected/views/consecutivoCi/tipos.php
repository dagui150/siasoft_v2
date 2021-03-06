<script>
$(document).ready(inicio);

function inicio(){
    
	$(".tonces").live("change", dependiente);
        $("#nuevo").live("click", agregar);
        $(".eliminarRegistro").live("click", eliminarRegistro);
}
function dependiente () {
        var nombreCampoDependiente;
        //Obtenemos el numero del campo
        nombreCampoDependiente = 'ConsecCiTipoTrans_TIPO_TRANSACCION';
        $('#valor').val($(this).attr('value'));
            
        $.post('<?php echo Yii::app()->getController()->createUrl('consecutivoCi/cargartransaccion'); ?>', { Base: $(this).attr('value') },
		  function(data){
                        $('select[id$=' + nombreCampoDependiente + '] > option').remove();
                        $('#' + nombreCampoDependiente).append(data);
		  }
        );
            
        $(".templateTarget").html('');   
        $("#nuevo").attr('disabled',false);   
        $("#cambia").val(1);   
}
function agregar(){
        var cont = $('body').find('.rowIndex').max();
        var valor = $("#valor").val();
            
        $('#ConsecCiTipoTransNuevo_'+cont+'_TRANSACCION_BASE').val(valor);
            
        $('select[id$=ConsecCiTipoTransNuevo_'+cont+'_TIPO_TRANSACCION] > option').remove();
        $('#ConsecCiTipoTrans_TIPO_TRANSACCION option').clone().appendTo('#ConsecCiTipoTransNuevo_'+cont+'_TIPO_TRANSACCION');
            
        add();
        $("#label").slideDown('fast');  
}
function eliminar(){
    var cuentaLineas = $('#contador').val();
    if (cuentaLineas <= '0'){
        $('#remover').removeClass('remove');
    }
    else{
        cuentaLineas = parseInt(cuentaLineas, 10) - 1;
        $('#contador').val(cuentaLineas);
    }
}
function add(){
    var cuentaLineas = $('#contador').val();
    
    if (cuentaLineas < '0'){
        $('#contador').val(1);
        $('#remover').addClass('remove');
    }
    else{
        cuentaLineas = parseInt(cuentaLineas, 10) + 1;
        $('#contador').val(cuentaLineas);
    }
}
function eliminarRegistro(){
    idFila = $(this).attr('name');
    eliminarOculto = $("#eliminar").val()
    idCampo = $("#ConsecCiTipoTrans_"+idFila+"_ID").val();
    
    
    eliminarOculto = eliminarOculto + idCampo +",";
    $("#eliminar").val(eliminarOculto);
    
}


</script>
<?php 
    $id_tipo = '';
    if($tipos !== ''){
        foreach($tipos as $var){
            $id_tipo = $var->tIPOTRANSACCION->TRANSACCION_BASE;
        }
    }
?>
<table>
    <thead>
                   <tr>
                       <td>
                           <?php echo $form->labelEx(TipoTransaccion::model(),'TRANSACCION_BASE') ?>
                       </td>
                       <td></td>
                  </tr>
    </thead>
    <tr>
          <td>
              <?php 
                    echo CHtml::dropDownList('ConsecCiTipoTrans_TRANSACCION_BASE','',CHtml::listData(TipoTransaccion::model()->findAll(),'TIPO_TRANSACCION','NOMBRE'),
                                            array(
                                                'style'=>'width:100px',
                                                'prompt' => 'Seleccione',
                                                'class' => 'tonces',
                                                'options'=>$model2->isNewRecord ? array() : 
                                                    array(
                                                        $id_tipo=>array('selected'=>'selected')
                                                )
                                            )
                        );
              ?>
          </td>
          <td>
              <div style="display: none;">
                  <?php echo CHtml::dropDownList('ConsecCiTipoTrans_TIPO_TRANSACCION','',$model2->isNewRecord ? array() : CHtml::ListData(TipoTransaccion::model()->findAll('TRANSACCION_BASE = "'.$id_tipo.'"'),'TIPO_TRANSACCION','NOMBRE'),array('prompt'=>'Seleccione')); ?>
              </div>
          </td>
          <input type="hidden" value="0" id="contador" />
          <?php echo CHtml::hiddenField('valor',$model2->isNewRecord ? '' : $id_tipo); ?>
          <?php echo CHtml::hiddenField('cambia',0); ?>
  </tr>
</table>

<?php if(!$model2->isNewRecord) :?>
    <div class="complex">
            <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                    <thead>
                       <tr>
                           <td></td>
                           <td>
                                <?php echo $form->labelEx(ConsecCiTipoTrans::model(),'TIPO_TRANSACCION') ?>
                           </td>
                      </tr>
                    </thead>
                    <tbody class="templateTarget">
                        <?php foreach($tipos as $i=>$person): ?>
                            <tr class="templateContent">
                                <td>
                                    <?php echo CHtml::textField('TRANSACCION_BASE',$id_tipo,array('disabled'=>true,'style'=>'width:100px')); ?>
                                    <?php echo $form->hiddenField($person,"[$i]ID",''); ?>
                                </td>
                                <td>
                                    <?php echo  $form->dropDownList($person,"[$i]TIPO_TRANSACCION",CHtml::ListData(TipoTransaccion::model()->findAll('TRANSACCION_BASE = "'.$id_tipo.'"'),'TIPO_TRANSACCION','NOMBRE'),array('prompt'=>'Seleccione')); ?>
                                </td>
                                <td>
                                     <div class="remove" style="width: 85px;">
                                         <?php $this->darBotonDeleteLinea('Eliminar',array('class'=>'eliminarRegistro','name'=>$i)); ?>
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
                
                    <thead>
                       <tr>
                           <td></td>
                           <td>
                               <?php if($model2->isNewRecord) :?>
                                  <span id="label" style="display: none">
                                       <?php echo $form->labelEx(ConsecCiTipoTrans::model(),'TIPO_TRANSACCION') ?>
                                  </span>
                               <?php endif;?>
                           </td>
                      </tr>
                    </thead>
                <tfoot>
                    <tr>
                        <td colspan="4">
                             <div class="add" style="width: 85px;" >
                                 <?php $this->darBotonAddLinea('Nuevo',array('id'=>'nuevo','disabled'=>$model2->isNewRecord ? true : false)); ?>
                            </div>
                            <textarea class="template" rows="0" cols="0" style="display:none;">
                                <tr class="templateContent">
                                    <td>
                                        <?php echo CHtml::textField('ConsecCiTipoTransNuevo[{0}][TRANSACCION_BASE]','',array('disabled'=>true,'style'=>'width:100px','prompt' => 'Seleccione','class' => 'tonces',)); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::dropDownList('ConsecCiTipoTransNuevo[{0}][TIPO_TRANSACCION]','',array(),array('prompt'=>'Seleccione')); ?>
                                    </td>
                                    <td>
                                        <div class="remove" style="width: 85px;">
                                            <?php $this->darBotonDeleteLinea('Eliminar',array('id'=>'remover','onclick'=>'eliminar()')); ?>
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
                        $persons = array();
                        
                        foreach($persons as $i=>$person):
                   ?>
                        <tr class="templateContent">
                            <td>
                                <?php 
                                    if($model2->isNewRecord)
                                        echo $form->textField($person,"[$i]TRANSACCION_BASE",array('disabled'=>true,'style'=>'width:100px')); 
                                    else
                                        echo CHtml::textField('TRANSACCION_BASE',$id_tipo,array('disabled'=>true,'style'=>'width:100px'));
                                ?>
                            </td>
                            <td>
                                <?php echo  $form->dropDownList($person,"[$i]TIPO_TRANSACCION",$model2->isNewRecord ? array() : CHtml::ListData(TipoTransaccion::model()->findAll('TRANSACCION_BASE = "'.$id_tipo.'"'),'TIPO_TRANSACCION','NOMBRE'),array('prompt'=>'Seleccione')); ?>
                            </td>
                            <td>
                                 <div class="remove"  style="width: 85px;">
                                     <?php $this->darBotonDeleteLinea('Eliminar',array('id'=>'remover','onclick'=>'eliminar()',)); ?>
                                 </div>
                            </td>
                       </tr>
                   <?php  endforeach ?>
               </tbody>
            </table>
        </div><!--panel-->
</div><!--complex-->
