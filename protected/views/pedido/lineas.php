<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('calculos.js'), CClientScript::POS_HEAD);
?>
<script>
    $(document).ready(function(){
        var cantidad,precio,descuento,iva,valor_impuesto,contador, model,id,total,total_mercaderia,total_facturar,total_descuento,total_iva,anticipo,flete,seguro;

        
        $('.cambiar').live('dblclick',function(){
            model = $(this).attr('id').split('_')[0];
            contador = $(this).attr('id').split('_')[1];
            id = '#campo_'+model+'_'+contador;
            $(this).hide('fast');
            $(id).show('fast');
            switch(model){
                case 'cantidad':
                    $('#LineaNuevo_'+contador+'_CANTIDAD').focus();
                    break;
                case 'unidad':
                    $('#LineaNuevo_'+contador+'_UNIDAD').focus();
                    break;
                case 'tipoprecio':
                    $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&tipo='+$('#LineaNuevo_'+contador+'_TIPO_PRECIO').val(),
                        function(data){
                             $('#NOMBRE_TIPO_PRECIO').val('');
                             $('#NOMBRE_TIPO_PRECIO').val(data.NOMBRE);
                             $('#preciounitario_'+contador).text(data.PRECIO);
                             $('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val(data.PRECIO);
                             //calcular el total
                             calcularTotal(contador,'LineaNuevo');
                     });
                    break;
                case 'preciounitario':
                    $('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').focus();
                    break;
                case 'porcdescuento':
                    $('#LineaNuevo_'+contador+'_PORC_DESCUENTO').focus();
                    break;
            }
                
            
        });
        
        $('.blur').live('blur',function(){
            contador =  $(this).attr('id').split('_')[1];
            switch(model){
                case 'cantidad':
                    $('#cantidad_'+contador).text($(this).val());
                    $('#campo_cantidad_'+contador).hide('fast');
                    precio = parseInt($('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val(),10);
                    
                    //volver a calcular el monto descuento
                    precio = parseInt($('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val(), 10);
                    total = precio * parseInt($(this).val(), 10);
                    descuento = (total * parseInt($('#LineaNuevo_'+contador+'_PORC_DESCUENTO').val(), 10))/100;
                    $('#LineaNuevo_'+contador+'_MONTO_DESCUENTO').val(descuento);
                        
                    //calcular el total
                    calcularTotal(contador,'LineaNuevo');
                    $('#cantidad_'+contador).show('fast');
                break;
                case 'unidad':
                    $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
                    $('#campo_unidad_'+contador).hide('fast');
                    $('#unidad_'+contador).show('fast');
                break;
                case 'tipoprecio':
                    $('#tipoprecio_'+contador).text($('#NOMBRE_TIPO_PRECIO').val());
                    $('#campo_tipoprecio_'+contador).hide('fast');
                    $('#tipoprecio_'+contador).show('fast');
                break;
                case 'preciounitario':
                    $('#preciounitario_'+contador).text($(this).val());
                    $('#campo_preciounitario_'+contador).hide('fast');
                    //volver a calcular el monto descuento
                    total = parseInt($(this).val(), 10) * parseInt($('#LineaNuevo_'+contador+'_CANTIDAD').val(), 10);
                    descuento = (total * parseInt($('#LineaNuevo_'+contador+'_PORC_DESCUENTO').val(), 10))/100;
                    $('#LineaNuevo_'+contador+'_MONTO_DESCUENTO').val(descuento);
                        
                     //calcular el total
                     calcularTotal(contador,'LineaNuevo');
                    $('#preciounitario_'+contador).show('fast');
                break;
                case 'porcdescuento':
                    $('#porcdescuento_'+contador).text($(this).val());
                    $('#campo_porcdescuento_'+contador).hide('fast'); 
                    precio = parseInt($('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val(), 10);
                    total = precio * parseInt($('#LineaNuevo_'+contador+'_CANTIDAD').val(), 10);
                    descuento = (total * $(this).val())/100;
                    $('#LineaNuevo_'+contador+'_MONTO_DESCUENTO').val(descuento);                       
                    //calcular el total
                    calcularTotal(contador,'LineaNuevo');
                    $('#porcdescuento_'+contador).show('fast');
               break;
            }
        });
        
        $('.unidad').live('change',function(){
            contador =  $(this).attr('id').split('_')[1];
            var modelo = $(this).attr('id').split('_')[0];
            var nombre = $('#'+modelo+'_'+contador+'_UNIDAD option:selected').html()
            $('#NOMBRE_UNIDAD').val('');
            $('#NOMBRE_UNIDAD').val(nombre);
        });
        $('.tipo_precio').live('change',function(){
             contador =  $(this).attr('id').split('_')[1];
             var modelo = $(this).attr('id').split('_')[0];
            $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&tipo='+$(this).val(),
                    function(data){
                         $('#NOMBRE_TIPO_PRECIO').val('');
                         $('#NOMBRE_TIPO_PRECIO').val(data.NOMBRE);
                         $('#preciounitario_'+contador).text(data.PRECIO);
                         $('#'+modelo+'_'+contador+'_PRECIO_UNITARIO').val(data.PRECIO);
                         
                         //volver a calcular el monto descuento
                         total = parseInt(data.PRECIO, 10) * parseInt($('#'+modelo+'_'+contador+'_CANTIDAD').val(), 10);
                         descuento = (total * parseInt($('#'+modelo+'_'+contador+'_PORC_DESCUENTO').val(), 10))/100;
                         $('#'+modelo+'_'+contador+'_MONTO_DESCUENTO').val(descuento);
                         
                         //calcular el total
                         calcularTotal(contador,modelo);
                 });
        });
        
        $('#agregar').click(function(){
                $('.clonar').click();
                contador = $('body').find('.rowIndex').max();
                model ='LineaNuevo';
                var model2 ='PedidoLinea';
                var impuesto;
                var tipo_precio = $('#Pedido_NIVEL_PRECIO').val();
                
                agregarCampos(contador,model);
                $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+$('#Pedido_ARTICULO').val(),
                    function(data){
                        impuesto = data.IMPUESTO;
                        $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
                        $('#porc_impuesto_'+contador).text(impuesto);
                        $('#'+model+'_'+contador+'_PORC_IMPUESTO').val(impuesto);
                        
                         $('select[id$='+model+'_'+contador+'_UNIDAD]>option').remove();
                         
                         $.each(data.UNIDADES, function(value, name) {
                            if(value == $('#Pedido_UNIDAD').val())
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                            else
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                        });
                        //cargar tipo de precio
                        $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&art='+$('#Pedido_ARTICULO').val()+'&tipo='+tipo_precio,
                            function(data){
                                 $('#tipoprecio_'+contador).text(data.NOMBRE);
                                 $('#preciounitario_'+contador).text(data.PRECIO);
                                 $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(data.PRECIO);

                                 $('select[id$='+model+'_'+contador+'_TIPO_PRECIO]>option').remove();

                                 $.each(data.COMBO, function(value, name) {
                                        tipo_precio = data.SELECCION;
                                        if(value == tipo_precio)
                                            $('#'+model+'_'+contador+'_TIPO_PRECIO').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                        else
                                            $('#'+model+'_'+contador+'_TIPO_PRECIO').append("<option value='"+value+"'>"+name+"</option>");


                                });
                                valor_impuesto = (parseInt(data.PRECIO, 10) * parseInt(impuesto, 10))/100;
                                $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(valor_impuesto);
                                $('#valor_impuesto_'+contador).text(valor_impuesto);
                                
                                calcularTotal(contador,model, model2);              
                         });

                });
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
    
    $('.eliminaLinea').live('click',function(){
        contador = $(this).attr('name');
        var model = 'LineaNuevo';
        var model2 =  'PedidoLinea';
           
        $('#remover_'+contador).click();
        var contadorMax = $('body').find('.rowIndex').max();
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){
            var campos = ['ARTICULO','DESCRIPCION','UNIDAD','TIPO_PRECIO','CANTIDAD','PRECIO_UNITARIO','PORC_DESCUENTO','MONTO_DESCUENTO','PORC_IMPUESTO','VALOR_IMPUESTO','COMENTARIO','TOTAL'];
            var span = ['linea','articulo','descripcion','cantidad','campo_cantidad','unidad','campo_unidad','tipoprecio','campo_tipoprecio','preciounitario','campo_preciounitario','porcdescuento','campo_porcdescuento','porc_impuesto','valor_impuesto','total','remover','edit','eliminaLinea','rowIndex'];
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
        calculoGranTotal(model, model2);
    });
    
    $('.eliminaLineaU').live('click',function(){
        contador = $(this).attr('name');
        var model = 'LineaNuevo';
        var model2 = 'PedidoLinea';
        var numLinea = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
        var eliminar = $('#eliminar').val();
        eliminar = eliminar + $('#PedidoLinea_'+contador+'_ID').val() + ',';
        $('#eliminar').val(eliminar);
        $('#CAMPO_ACTUALIZA').val(numLinea - 1);
        $('#removerU_'+contador).click();
        var contadorMax = $('body').find('.rowIndexU').max();
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){
            var campos = ['ID','ARTICULO','DESCRIPCION','UNIDAD','TIPO_PRECIO','CANTIDAD','PRECIO_UNITARIO','PORC_DESCUENTO','MONTO_DESCUENTO','PORC_IMPUESTO','VALOR_IMPUESTO','COMENTARIO','TOTAL', 'ESTADO'];
            var span = ['lineaU','articuloU','descripcionU','cantidadU','campo_cantidadU','unidadU','campo_unidadU','tipoprecioU','campo_tipoprecioU','preciounitarioU','campo_preciounitarioU','porcdescuentoU','campo_porcdescuentoU','porc_impuestoU','valor_impuestoU','totalU','removerU','editU','eliminaLineaU','rowIndexU'];
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
        calculoGranTotal(model, model2);
    });
       
    function agregarCampos(contador,model){
        
        var articulo = $('#Pedido_ARTICULO').val();
        var descripcion = $('#Articulo_desc').val();
        var cantidad = $('#Pedido_CANTIDAD').val(); 
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_PORC_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_COMENTARIO').val('');
        
        //copia a spans para visualizar detalles
        $('#linea_'+contador).text(parseInt(contador, 10) + 1);
        $('#articulo_'+contador).text(articulo);
        $('#descripcion_'+contador).text(descripcion);
        $('#cantidad_'+contador).text(cantidad);
        $('#porcdescuento_'+contador).text(0);
        $('#monto_descuento_'+contador).text(0);
    }
});
</script>
<table style="margin-left: -100px;">
         <tr>
             <td style="width: 289px">
                <?php echo $form->textFieldRow($model,'ARTICULO',array('size'=>15)); ?>
             </td>
             <td style="width: 28px;">
                 <?php $this->widget('bootstrap.widgets.TbButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#articulo',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal','style'=>'margin-top: 5px;'),
                 )); ?>
            </td>
            <td>
                 <?php echo CHtml::textField('Articulo_desc','',array('disabled'=>true,'size'=>30)); ?>
           </td>
           <td>
               <table style="margin-left: -100px;margin-top:-4px;">
                   <tr>
                       <td style="width: 289px;">
                            <?php echo $form->textFieldRow($model,'CANTIDAD',array('size'=>4,'class'=>'decimal'));?>
                       </td>
                   </tr>
               </table>
           </td>
           <td>
               <table style="margin-left: -100px;margin-top:-4px;">
                   <tr>
                       <td>
                            <?php echo $form->dropDownListRow($model,'UNIDAD',array(),array('empty'=>'Seleccione','style'=>'width: 120px;'));?>
                            <?php echo CHtml::hiddenField('NOMBRE_UNIDAD','');?>
                       </td>
                       <td>
                           <?php
                                $this->widget('bootstrap.widgets.TbButton', array(
                                            'buttonType'=>'button',
                                            'type'=>'success',
                                            'icon'=>'white plus',
                                            'size'=>'mini',
                                            'htmlOptions'=>array('id'=>'agregar','disabled'=>true,'style'=>'margin-top: 5px;')
                                 ));    
                            ?> 
                       </td>
                   </tr>
               </table>
           </td>
        </tr>
</table>
<span id="carga" style="height:30px;width:30px;"></span>
<table class="templateFrame table table-bordered" cellspacing="0">
          <thead>
               <tr>
                    <td><strong>#</strong></td>
                    <td><strong>Artículo</strong></td>
                    <td><strong>Descripción</strong></td>
                    <td><strong>Cant.</strong></td>
                    <td><strong>Unidad</strong></td>
                    <td><strong>Tipo Precio</strong></td>
                    <td style="width: 74px;"><strong>Precio Unit.</strong></td>  
                    <td style="width: 74px;"><strong>% Desc.</strong></td>
                    <td style="width: 74px;"><strong>% Iva</strong></td>
                    <td><strong>Iva</strong></td>
                    <td><strong>Total</strong></td>
                    <td>&nbsp;</td>
               </tr>
         </thead>
         <tfoot style="display:none;">
               <tr>
                    <td colspan="12">
                        <div id="add" class="add">
                           <?php 
                                $this->widget('bootstrap.widgets.TbButton', array(
                                                            'buttonType'=>'button',
                                                            'type'=>'success',
                                                            'label'=>'Nuevo',
                                                            'icon'=>'plus white',
                                                            'htmlOptions' => array('class'=>'clonar', 'style'=>'display:none'),
                                                      ));
                           ?>
                        </div>
                           <textarea class="template" rows="0" cols="0" style="display:none;">
                                    <tr class="templateContent">
                                        <td>
                                            <span id='linea_<?php echo '{0}';?>'></span>                                                                        
                                        </td>
                                        <td>
                                            <span id='articulo_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][ARTICULO]',''); ?>
                                        </td>
                                        <td>
                                            <span id='descripcion_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][DESCRIPCION]',''); ?>
                                        </td>
                                        <td>
                                            <span id='cantidad_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_cantidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][CANTIDAD]','',array('size'=>4,'class'=>'blur decimal')); ?></span>                                                                                                            
                                        </td>
                                        <td>
                                            <span id='unidad_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_unidad_<?php echo '{0}';?>' style="display:none;" ><?php echo CHtml::dropDownList('LineaNuevo[{0}][UNIDAD]','',array(),array('empty'=>'Seleccione','style'=>'width:65px;','class'=>'blur unidad')); ?></span>
                                        </td>
                                        <td>
                                            <span id='tipoprecio_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_tipoprecio_<?php echo '{0}';?>' style="display:none;" ><?php echo CHtml::dropDownList('LineaNuevo[{0}][TIPO_PRECIO]','',array(),array('empty'=>'Seleccione','style'=>'width:80px;','class'=>'blur tipo_precio')); ?></span>
                                        </td>
                                        <td style="width: 74px;">
                                            <span id='preciounitario_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_preciounitario_<?php echo '{0}';?>'style="display:none;" ><?php echo CHtml::textField('LineaNuevo[{0}][PRECIO_UNITARIO]','',array('size'=>10,'class'=>'blur decimal')); ?></span>                                         
                                        </td>                                    
                                        <td style="width: 74px;">
                                            <span id='porcdescuento_<?php echo '{0}';?>' class="cambiar"></span>
                                            <span id='campo_porcdescuento_<?php echo '{0}';?>'style="display:none;" ><?php echo CHtml::textField('LineaNuevo[{0}][PORC_DESCUENTO]','',array('size'=>4,'class'=>'blur')); ?></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][MONTO_DESCUENTO]',''); ?>
                                        </td>
                                        <td style="width: 74px;">
                                            <span id='porc_impuesto_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][PORC_IMPUESTO]',''); ?>                                        
                                        </td>
                                        <td>
                                            <span id='valor_impuesto_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][VALOR_IMPUESTO]',''); ?>
                                        </td>
                                        <td>
                                            <span id='total_<?php echo '{0}';?>'></span>      
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][TOTAL]',''); ?>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][COMENTARIO]',''); ?>
                                        </td>                                            
                                        <td width="40px">
                                             <span style="float: left">
                                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                 'buttonType'=>'button',
                                                                 'type'=>'normal',
                                                                 'size'=>'mini',
                                                                 'icon'=>'pencil',
                                                                 'htmlOptions'=>array('class'=>'edit','name'=>'{0}','id'=>'edit_{0}')
                                                             ));
                                                ?>
                                            </span>
                                            <div class="remove" id ="remover_<?php echo '{0}';?>" style="float: left; margin-left: 5px; display: none"></div>
                                            <div style="float: left; margin-left: 5px;">
                                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'size'=>'mini',
                                                             'icon'=>'minus white',
                                                             'htmlOptions'=>array('id'=>'eliminaLinea_{0}','class'=>'eliminaLinea','name'=>'{0}')
                                                         ));
                                                   ?>
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
                                            <?php echo '<span id="lineaU_'.$i.'">'.$linea->LINEA.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea, "[$i]ID"); ?>
                                   </td>
                                   <td>
                                            <?php echo '<span id="articuloU_'.$i.'">'.$linea->ARTICULO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ARTICULO"); ?>
                                   </td>
                                   <td> 
                                            <?php echo '<span id="descripcionU_'.$i.'">'.$linea->aRTICULO->NOMBRE.'</span>'; ?>                                            
                                   </td>
                                   <td> 
                                            <?php echo '<span id="cantidadU_'.$i.'">'.$linea->CANTIDAD.'</span>'; ?>    
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]CANTIDAD"); ?>
                                   </td>
                                   <td>
                                            <?php echo '<span id="unidadU_'.$i.'">'.$linea->uNIDAD->NOMBRE.'</span>'; ?>
                                            <div style="display:none;"><?php echo CHtml::activeDropDownList($linea,"[$i]UNIDAD",CHtml::listData(UnidadMedida::model()->findAll('ACTIVO = "S" AND TIPO = "'.$linea->uNIDAD->TIPO.'"'), 'ID', 'NOMBRE'),array('style'=>'width:65px;', 'options'=>array($linea->UNIDAD => array('selected'=>'selected')))); ?></div>
                                    </td>
                                   <td>
                                            <?php echo '<span id="tipoprecioU_'.$i.'">'.$linea->tIPOPRECIO->nIVELPRECIO->DESCRIPCION.'</span>'; ?>
                                            <div style="display:none;"><?php echo CHtml::activeDropDownList($linea,"[$i]TIPO_PRECIO",CHtml::listData(ArticuloPrecio::model()->findAll('ACTIVO = "S"'), 'ID', 'nIVELPRECIO.DESCRIPCION'),array('style'=>'width:80px;', 'display'=>'none', 'options'=>array($linea->TIPO_PRECIO => array('selected'=>'selected')))); ?></div>
                                    </td>
                                    <td>
                                            <?php echo '<span id="preciounitarioU_'.$i.'">'.$linea->PRECIO_UNITARIO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PRECIO_UNITARIO"); ?>                                        
                                    </td>                                
                                    <td>
                                            <?php echo '<span id="porcdescuentoU_'.$i.'">'.$linea->PORC_DESCUENTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>  
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]MONTO_DESCUENTO"); ?>   
                                    </td>
                                    <td>
                                            <?php echo '<span id="porc_impuestoU_'.$i.'">'.$linea->PORC_IMPUESTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_IMPUESTO"); ?>                                          
                                    </td>
                                    <td>
                                            <?php echo '<span id="porc_impuestoU_'.$i.'">'.$linea->VALOR_IMPUESTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]VALOR_IMPUESTO"); ?>    
                                    </td>
                                    <td>
                                            <?php echo '<span id="totalU_'.$i.'">'.$linea->TOTAL.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]TOTAL"); ?>    
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ESTADO"); ?>    
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]COMENTARIO"); ?>
                                    </td>
                                    <td>            
                                            <span style="float: left">
                                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                 'buttonType'=>'button',
                                                                 'type'=>'normal',
                                                                 'size'=>'mini',
                                                                 'icon'=>'pencil',
                                                                 'htmlOptions'=>array('class'=>'editU','name'=>"$i",'id'=>"editU_$i")
                                                             ));
                                                ?>
                                            </span>
                                           <div class="remove" id ="removerU" style="float: left; margin-left: 5px;">
                                                      <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'size'=>'mini',
                                                             'icon'=>'minus white',
                                                             'htmlOptions'=>array('id'=>"eliminaLineaU_$i",'class'=>'eliminaLineaU','name'=>"$i")
                                                         ));
                                                   ?>
                                           </div>
                                        <?php echo CHtml::hiddenField("rowIndexU_$i", $i, array('class'=>'rowIndexU')); ?>                                         
                                       </td>
                             </tr>
                       <?php  endforeach; ?>                       
              <?php endif; ?>
        </tbody>
</table>
<?php $model->isNewRecord ? $i=0 : $i++; ?>
<?php echo CHtml::HiddenField('CAMPO_ACTUALIZA', $i); ?>
<?php echo CHtml::HiddenField('NAME', ''); ?>
<?php echo CHtml::hiddenField('eliminar','' ); ?>
