<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<script>
    $(document).ready(function(){
        var contador, model, id;

        
        $('.cambiar').live('dblclick',function(){
            model = $(this).attr('id').split('_')[0];
            contador = $(this).attr('id').split('_')[1];
            id = '#campo_'+model+'_'+contador;
            $(this).hide('fast');
            $(id).show('fast');
            switch(model){
                case 'existenciaminima':
                    //alert(contador);
                    //$('#LineaNuevo_'+contador+'_EXISTENCIA_MINIMA').removeAttr('type');
                    //$('#LineaNuevo_'+contador+'_EXISTENCIA_MINIMA').attr('type','text');
                    $('#LineaNuevo_'+contador+'_EXISTENCIA_MINIMA').focus();
                    break;
                case 'existenciamaxima':
                    $('#LineaNuevo_'+contador+'_EXISTENCIA_MAXIMA').focus();
                    break;
                case 'puntoreorden':
                    $('#LineaNuevo_'+contador+'_PUNTO_REORDEN').focus();
                    break;
            }
                
            
        });
        
        $('.blur').live('blur',function(){
            var min = parseInt($('#LineaNuevo_'+contador+'_EXISTENCIA_MINIMA').val(),10);
            var max = parseInt($('#LineaNuevo_'+contador+'_EXISTENCIA_MAXIMA').val(),10);
            contador =  $(this).attr('id').split('_')[1];
            switch(model){
                case 'existenciaminima':
                    if((min) < (max)){
                        $("#mensaje_edit").html("");
                        $('#existenciaminima_'+contador).text($(this).val());
                        //$('#LineaNuevo_'+contador+'_EXISTENCIA_MINIMA').attr('type','hidden');
                        $('#campo_existenciaminima_'+contador).hide('fast');
                        $('#existenciaminima_'+contador).show('fast');
                        $("#guardar_lineas").attr('disabled',false);
                    }else{
                        //alert('Debe ser un valor menor a maxima');
                        $("#mensaje_edit").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><font size='5' align='left'>&nbsp &nbsp El valor de mínima debe ser menor al de máxima.</font></div> ");
                        $("#guardar_lineas").attr('disabled',true);
                    }
                break;
                case 'existenciamaxima':
                    if((max) > (min)){
                        $("#mensaje_edit").html("");
                        $('#existenciamaxima_'+contador).text($(this).val());
                        $('#campo_existenciamaxima_'+contador).hide('fast');
                        $('#existenciamaxima_'+contador).show('fast');
                        $("#guardar_lineas").attr('disabled',false);
                    }else{
                        //alert('Debe ser un valor menor a maxima');
                        $("#mensaje_edit").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><font size='5' align='left'>&nbsp &nbsp El valor de máxima debe ser mayor al de mínima.</font></div> ");
                        $("#guardar_lineas").attr('disabled',true);
                    }
                break;
                case 'puntoreorden':
                    $('#puntoreorden_'+contador).text($(this).val());
                    $('#campo_puntoreorden_'+contador).hide('fast');
                    $('#puntoreorden_'+contador).show('fast');
                break;
            }
        });
        
        $('#agregar').click(function(){
                $('.clonar').click();
                contador = $('body').find('.rowIndex').max();
                model ='LineaNuevo';
                
                agregarCampos(contador,model);
                $('#carga').ajaxSend(function(){
                    $("#carga").html('<div align="left" style="margin-bottom: 9px; margin-left: 7px;"><?php echo CHtml::image($ruta2);?></div>');
                });
                $('#carga').ajaxComplete(function(){
                    $('#carga').html('');
                });
     });
    
    $('.montos').blur(function(){
        calculoGranTotal(false, false);
    });
    
    $('.valLinea').blur(function(){
        var articulo2 = $('#Articulo_ARTICULO').val();
        var descripcion2 = $('#Articulo_desc').val();
        var existenciaminima2 = $('#ExistenciaBodega_EXISTENCIA_MINIMA_ADD').val(); 
        var existenciamaxima2 = $('#ExistenciaBodega_EXISTENCIA_MAXIMA_ADD').val(); 
        var puntoreorden2 = $('#ExistenciaBodega_PUNTO_REORDEN_ADD').val(); 
        var min = parseInt(existenciaminima2,10);
        var max = parseInt(existenciamaxima2,10);
        if(articulo2!='' && descripcion2!='' && existenciaminima2!='' && existenciamaxima2!='' && puntoreorden2!=''){
            if(min < max){
                $('#agregar').attr('disabled', false);
                $("#mensaje_addLinea").html("");
            }else{
                $('#agregar').attr('disabled', true);
                $("#mensaje_addLinea").html("<div class='alert alert-error'><button type='button' class='close' data-dismiss='alert'>&times;</button><font size='5' align='left'>&nbsp &nbsp El valor de mínima debe ser menor al de máxima.</font></div> ");
            }
        }else{
            $('#agregar').attr('disabled', true);
        }
    });
    
    $('.eliminaLinea').live('click',function(){
        contador = $(this).attr('name');
        var model = 'LineaNuevo';
        var model2 =  'ExistenciaBodegas';
           
        $('#remover_'+contador).click();
        var contadorMax = $('body').find('.rowIndex').max();
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){
            var campos = ['ARTICULO','DESCRIPCION','EXISTENCIA_MINIMA','EXISTENCIA_MAXIMA','PUNTO_REORDEN','CANT_DISPONIBLE','CANT_RESERVADA','CANT_REMITIDA'];
            var span = ['articulo','descripcion','existenciaminima','campo_existenciaminima','existenciamaxima','campo_existenciamaxima','puntoreorden','campo_puntoreorden','cant_disponible','campo_cant_disponible','cant_reservada','campo_cant_reservada','cant_remitida','campo_cant_remitida','remover','edit','eliminaLinea','rowIndex'];
            //CAMBIAR IDS DE LOS SPAN
            for(var x =0 ; x<=span.length;x++){
                switch(span[x]){
                    case 'edit':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'eliminaLinea':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'rowIndex':
                         $('[name="'+span[x]+'_'+i+'"]').attr({
                        name: span[x]+'_'+linea,
                        value:linea
                    });
                    break
                }
                $('#'+span[x]+'_'+i).attr('id',span[x]+'_'+linea);
            }
            //CAMBIAR IDS Y NAMES DE LOS CAMPOS DE LAS LINEAS
            for(var y =0 ; y<=campos.length;y++){
               /* alert('editar :'+model+'_'+i+'_'+campos[y]);
                alert('editado :'+model+'_'+linea+'_'+campos[y]);*/
                 $('#'+model+'_'+i+'_'+campos[y]).attr({
                    id: model+'_'+linea+'_'+campos[y],
                    name: model+'['+linea+']['+campos[y]+']'
                });
            }
            contador++;
            linea++;
        }
    });
    
    $('.eliminaLineaU').live('click',function(){
        contador = $(this).attr('name');
        var model = 'LineaNuevo';
        var model2 = 'ExistenciaBodegas';
        var numLinea = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
        var eliminar = $('#eliminar').val();
        eliminar = eliminar + $('#ExistenciaBodegas_'+contador+'_ID').val() + ',';
        $('#eliminar').val(eliminar);
        $('#CAMPO_ACTUALIZA').val(numLinea - 1);
        $('#removerU_'+contador).click();
        var contadorMax = $('body').find('.rowIndexU').max();
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){
            var campos = ['ID', 'ARTICULO','DESCRIPCION','EXISTENCIA_MINIMA','EXISTENCIA_MAXIMA','PUNTO_REORDEN','CANT_DISPONIBLE','CANT_RESERVADA','CANT_REMITIDA'];
            var span = ['articuloU','descripcionU','existenciaminimaU','campo_existenciaminimaU','existenciamaximaU','campo_existenciamaximaU','puntoreordenU','campo_puntoreordenU','cant_disponibleU','campo_cant_disponibleU','cant_reservadaU','campo_cant_reservadaU','cant_remitidaU','campo_cant_remitidaU','removerU','editU','eliminaLineaU','rowIndexU'];
            //CAMBIAR IDS DE LOS SPAN
            for(var x =0 ; x<=span.length;x++){
                switch(span[x]){
                    case 'editU':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'eliminaLineaU':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'rowIndexU':
                         $('[name="'+span[x]+'_'+i+'"]').attr({
                        name: span[x]+'_'+linea,
                        value:linea
                    });
                    break
                }
                $('#'+span[x]+'_'+i).attr('id',span[x]+'_'+linea);
                     
                 
            }
            //CAMBIAR IDS Y NAMES DE LOS CAMPOS DE LAS LINEAS
            for(var y =0 ; y<=campos.length;y++){
               /* alert('editar :'+model+'_'+i+'_'+campos[y]);
                alert('editado :'+model+'_'+linea+'_'+campos[y]);*/
                 $('#'+model2+'_'+i+'_'+campos[y]).attr({
                    id: model2+'_'+linea+'_'+campos[y],
                    name: model2+'['+linea+']['+campos[y]+']'
                });
            }
            contador++;
            linea++;
        }
    });
       
    function agregarCampos(contador,model){
        
        var articulo = $('#Articulo_ARTICULO').val();
        var descripcion = $('#Articulo_desc').val();
        var existenciaminima = $('#ExistenciaBodega_EXISTENCIA_MINIMA_ADD').val(); 
        var existenciamaxima = $('#ExistenciaBodega_EXISTENCIA_MAXIMA_ADD').val(); 
        var puntoreorden = $('#ExistenciaBodega_PUNTO_REORDEN_ADD').val(); 
        //var cant_disponible = $('#ExistenciaBodegas_CANT_DISPONIBLE').val(); 
        //var cant_reservada = $('#ExistenciaBodegas_CANT_RESERVADA').val(); 
        //var cant_remitida = $('#ExistenciaBodegas_CANT_REMITIDA').val(); 
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion);
        $('#'+model+'_'+contador+'_EXISTENCIA_MINIMA').val(existenciaminima);
        $('#'+model+'_'+contador+'_EXISTENCIA_MAXIMA').val(existenciamaxima);
        $('#'+model+'_'+contador+'_PUNTO_REORDEN').val(puntoreorden);
        $('#'+model+'_'+contador+'_CANT_DISPONIBLE').val('0,00');
        $('#'+model+'_'+contador+'_CANT_RESERVADA').val('0,00');
        $('#'+model+'_'+contador+'_CANT_REMITIDA').val('0,00');

        //copia a spans para visualizar detalles
        //$('#linea_'+contador).text(parseInt(contador, 10) + 1);
        $('#articulo_'+contador).text(articulo);
        $('#descripcion_'+contador).text(descripcion);
        $('#existenciaminima_'+contador).text(existenciaminima);
        $('#existenciamaxima_'+contador).text(existenciamaxima);
        $('#puntoreorden_'+contador).text(puntoreorden);
        $('#cant_disponible_'+contador).text('0,00');
        $('#cant_reservada_'+contador).text('0,00');
        $('#cant_remitida_'+contador).text('0,00');

    }
});
</script>
<!--<div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">-->
<div st>
<table style="margin-left: -90px;">
    <!--<table style="margin-left: -100px;">-->
         <tr>
             <td style="width: 289px">
                <?php echo $form->textFieldRow($articulo,'ARTICULO',array('size'=>5, 'class'=>'valLinea')); ?>
             </td>
             <td style="width: 28px;">
                 <?php //$this->darBoton(false, false, 'info', 'normal', '#articulo', 'search white',array('data-toggle'=>'modal','style'=>'margin-top: 5px;')); ?>
                 <?php $this->darBotonBuscar('#articulo'); ?>
            </td>
            <td>
                 <?php echo CHtml::textField('Articulo_desc','',array('disabled'=>true,'size'=>10, 'class'=>'valLinea')); ?>
           </td>
           <td>
               <table style="margin-left: -110px;margin-top:-4px;">
                   <tr>
                       <td style="width: 289px;">
                            <?php echo $form->textFieldRow($linea22,'EXISTENCIA_MINIMA_ADD',array('size'=>2, 'class'=>'valLinea'));?>
                       </td>
                   </tr>
               </table>
           </td>
           <td>
               <table style="margin-left: -110px;margin-top:-4px;">
                   <tr>
                       <td style="width: 289px;">
                            <?php echo $form->textFieldRow($linea22,'EXISTENCIA_MAXIMA_ADD',array('size'=>2, 'class'=>'valLinea'));?>
                       </td>
                   </tr>
               </table>
           </td>
           <td>
               <table style="margin-left: -70px;margin-top:-4px;">
                   <tr>
                       <td>
                            <?php //echo $form->dropDownListRow($model,'UNIDAD',array(),array('empty'=>'Seleccione','style'=>'width: 120px;'));?>
                            <?php //echo CHtml::hiddenField('NOMBRE_UNIDAD','');?>
                            <?php echo $form->textFieldRow($linea22,'PUNTO_REORDEN_ADD',array('size'=>2, 'class'=>'valLinea'));?>
                       </td>
                       <td>
                           <?php //$this->darBoton('button', false, 'success', 'normal', false, 'white plus',array('id'=>'agregar','disabled'=>true,'style'=>'margin-top: 5px;')); ?>
                           <?php $this->darBotonAddLinea('',array('id'=>'agregar','disabled'=>true,'style'=>'margin-top: 5px;')); ?>
                       </td>
                   </tr>
               </table>
           </td>
               <div id="mensaje_addLinea"></div>
        </tr>
</table>
<span id="carga" style="height:30px;width:30px;"></span>
<table class="templateFrame table table-bordered" cellspacing="0">
          <thead>
               <tr>
                    <td><strong>Artículo</strong></td>
                    <td><strong>Descripción</strong></td>
                    <td><strong>Minima</strong></td>
                    <td><strong>Maxima</strong></td>
                    <td><strong>Punto Reorden</strong></td>
                    <td><strong>Disponible</strong></td>
                    <td><strong>Reservada</strong></td>
                    <td><strong>Remitida</strong></td>
                    <!--
                    <td style="width: 74px;"><strong>Precio Unit.</strong></td>  
                    <td style="width: 74px;"><strong>% Desc.</strong></td>
                    <td style="width: 74px;"><strong>% Iva</strong></td>
                    <td><strong>Iva</strong></td>
                    <td><strong>Total</strong></td>
                    -->
                    <td>&nbsp;</td>
               </tr>
         </thead>
         <tfoot style="display:none;">
               <tr>
                    <td colspan="12">
                        <div id="add" class="add">
                            <?php $this->darBotonAddLinea('Nuevo',array('class'=>'clonar', 'style'=>'display:none')); ?>
                        </div>
                           <textarea class="template" rows="0" cols="0" style="display:none;">
                                    <tr class="templateContent">
                                        <td>
                                            <span id='articulo_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][ARTICULO]',''); ?>
                                        </td>
                                        <td>
                                            <span id='descripcion_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][DESCRIPCION]',''); ?>
                                        </td>
                                        <td>
                                            <span id='existenciaminima_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_existenciaminima_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][EXISTENCIA_MINIMA]','',array('size'=>4,'class'=>'blur existenciaminima',)); ?></span>
                                        </td>
                                        <td>
                                            <span id='existenciamaxima_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_existenciamaxima_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][EXISTENCIA_MAXIMA]','',array('size'=>4,'class'=>'blur existenciamaxima')); ?></span>
                                        </td>
                                        <td>
                                            <span id='puntoreorden_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_puntoreorden_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][PUNTO_REORDEN]','',array('size'=>4,'class'=>'blur puntoreorden')); ?></span>
                                        </td>
                                        <td>
                                            <span id='cant_disponible_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_cant_disponible_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][CANT_DISPONIBLE]','',array('size'=>4,'class'=>'blur cant_disponible')); ?></span>
                                        </td>                                  
                                        <td>
                                            <span id='cant_reservada_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_cant_reservada_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][CANT_RESERVADA]','',array('size'=>4,'class'=>'blur cant_reservada')); ?></span>
                                        </td>                                  
                                        <td>
                                            <span id='cant_remitida_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_cant_remitida_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][CANT_REMITIDA]','',array('size'=>4,'class'=>'blur cant_remitida')); ?></span>
                                        </td>                                  
                                        <td width="40px">
                                             <span style="float: left">
                                                 <?php $this->darBotonUpdateLinea(array('class'=>'edit','name'=>'{0}','id'=>'edit_{0}')); ?>
                                            </span>
                                            <div class="remove" id ="remover_<?php echo '{0}';?>" style="float: left; margin-left: 5px; display: none"></div>
                                            <div style="float: left; margin-left: 5px;">
                                                <?php $this->darBotonDeleteLinea(false,array('id'=>'eliminaLinea_{0}','class'=>'eliminaLinea','name'=>'{0}')); ?>
                                            </div>
                                            <input name="rowIndex_{0}" type="hidden" class="rowIndex" value="{0}" />
                                       </td>
                                    </tr>
                             </textarea>
                      </td>
              </tr>
         </tfoot>
         <tbody class="templateTarget">
              <?php if(!$model->isNewRecord) :?>
                        <?php foreach($modelLinea as $i=>$linea): ?>
                                <tr class="templateContent">
                                   <td>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ID"); ?>
                                            <?php echo '<span id="articuloU_'.$i.'">'.$linea->ARTICULO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ARTICULO"); ?>
                                   </td>
                                   <td> 
                                            <?php echo '<span id="descripcionU_'.$i.'">'.$linea->aRTICULO->NOMBRE.'</span>'; ?>                                            
                                   </td>
                                   <td>
                                            <?php echo '<span id="existenciaminimaU_'.$i.'">'.$linea->EXISTENCIA_MINIMA.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]EXISTENCIA_MINIMA"); ?>    
                                   </td>
                                   <td>
                                            <?php echo '<span id="existenciamaximaU_'.$i.'">'.$linea->EXISTENCIA_MAXIMA.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]EXISTENCIA_MAXIMA"); ?>    
                                   </td>
                                   <td>
                                            <?php echo '<span id="puntoreordenU_'.$i.'">'.$linea->PUNTO_REORDEN.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PUNTO_REORDEN"); ?>    
                                   </td>
                                   <td>
                                            <?php echo '<span id="cantdisponibleU_'.$i.'">'.$linea->CANT_DISPONIBLE.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]CANT_DISPONIBLE"); ?>    
                                   </td>
                                   <td>
                                            <?php echo '<span id="cantreservadaU_'.$i.'">'.$linea->CANT_RESERVADA.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]CANT_RESERVADA"); ?>    
                                   </td>
                                   <td>
                                            <?php echo '<span id="cantremitidaU_'.$i.'">'.$linea->CANT_REMITIDA.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]CANT_REMITIDA"); ?>    
                                   </td>
                                    <td>            
                                            <span style="float: left">
                                                <?php $this->darBotonUpdateLinea(array('class'=>'editU','name'=>"$i",'id'=>"editU_$i")); ?>
                                            </span>
                                           <div class="remove" id ="removerU" style="float: left; margin-left: 5px;">
                                               <?php $this->darBotonDeleteLinea(false,array('id'=>"eliminaLineaU_$i",'class'=>'eliminaLineaU','name'=>"$i")); ?>
                                           </div>
                                        <?php echo CHtml::hiddenField("rowIndexU_$i", $i, array('class'=>'rowIndexU')); ?>                                         
                                       </td>
                             </tr>
                       <?php  endforeach; ?>
                       <?php echo CHtml::hiddenField('eliminar','' ); ?>
              <?php endif; ?>
        </tbody>
</table>
<div id="mensaje_edit"></div>
</div>
<?php $model->isNewRecord ? $i=0 : $i++; ?>
<?php echo CHtml::HiddenField('CAMPO_ACTUALIZA', $i); ?>
<?php echo CHtml::HiddenField('NAME', ''); ?>