<script>
    $(document).ready(inicio);
    
    function inicio(){
        $("#ConsecutivoCi_TODOS_USUARIOS_1").click(mostrar);
        $("#ConsecutivoCi_TODOS_USUARIOS_0").click(quitar);
        $(".eliminarUsuario").click(eliminarUsuario);
        
    }
    function eliminarUsuario(){
        idFila = $(this).attr('name');
        eliminarOculto = $("#eliminarUsuario").val()
        idCampo = $("#ConsecCiUsuario_"+idFila+"_ID").val();

        eliminarOculto = eliminarOculto + idCampo +",";
        $("#eliminarUsuario").val(eliminarOculto);

    }
    function mostrar(){
        $(".complex").slideDown('slow');
    }
    function quitar(){
        $(".complex").slideUp('slow');
    }
</script>

<input type="hidden" value="0" id="contador" />
<?php echo $form->radioButtonListRow($model2,'TODOS_USUARIOS',array('S'=>'Si','N'=>'No')); ?>

<?php if(!$model2->isNewRecord) :?>
    <div class="complex" style="<?php if($model2->TODOS_USUARIOS == 'N') echo "display: block;"; else echo "display: none;"; ?>">
            <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                    <thead>
                       <tr>
                           <td>
                                <?php echo $form->labelEx(CrugeUserModel::model(),'username') ?>
                           </td>
                           <td></td>
                      </tr>
                    </thead>
                    <tbody class="templateTarget">
                        <?php foreach($usuarios as $i=>$person): ?>
                            <tr class="templateContent">
                                <td>
                                    <?php echo $form->dropDownList($person,"[$i]USUARIO",CHtml::ListData(CrugeUserModel::model()->findAll(),'username','username'),array('empty'=>'Seleccione'));  ?>
                                    <?php echo $form->hiddenField($person,"[$i]ID",''); ?>
                                </td>
                                <td>
                                     <div class="remove">
                                         <?php $this->darBotonDeleteLinea('Eliminar',array('class'=>'eliminarUsuario','name'=>$i)); ?>
                                     </div>
                                </td>
                           </tr>
                       <?php  endforeach ?>
                   </tbody>
                </table>
                <?php echo CHtml::hiddenField('eliminarUsuario','' ); ?>
            </div><!--panel-->
    </div><!--complex-->
<?php endif; ?>

<div class="complex" style="<?php if($model2->isNewRecord ) echo "display: none;"; elseif($model2->TODOS_USUARIOS == 'N') echo "display: block;"; else echo "display: none;"; ?>">
        <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                <thead class="templateHead">
                   <tr>
                       <td>
                           <?php if($model2->isNewRecord) :?>
                                  <?php echo $form->labelEx(CrugeUserModel::model(),'username') ?>
                            <?php endif;?>
                       </td>
                       <td>
                           
                       </td>
                  </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="4">
                             <div class="add" style="width: 85px;" >
                                 <?php $this->darBotonAddLinea('Nuevo',array('id'=>'nuevo')); ?>
                            </div>
                            <textarea class="template" rows="0" cols="0" style="display:none;">
                                <tr class="templateContent">
                                    <td>
                                        <?php echo CHtml::dropDownList('UsuariosNuevo[{0}][USERNAME]','',CHtml::ListData(CrugeUserModel::model()->findAll(),'username','username'),array('empty'=>'Seleccione')); ?>
                                    </td>
                                    <td>
                                        <div class="remove">
                                            <?php $this->darBotonDeleteLinea('Eliminar',array('id'=>'remover')); ?>
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
                                <?php echo $form->dropDownList($person,"[$i]username", CHtml::ListData(CrugeUserModel::model()->findAll(),'username','username'),array('empty'=>'Seleccione'));  ?>
                            </td>
                            <td>
                                 <div class="remove">
                                     <?php $this->darBotonDeleteLinea('Eliminar',array('id'=>'remover')); ?>
                                 </div>
                            </td>
                       </tr>
                   <?php  endforeach ?>
               </tbody>
            </table>
        </div><!--panel-->
</div><!--complex-->