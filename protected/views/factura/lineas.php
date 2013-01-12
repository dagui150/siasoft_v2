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
        var cantidad,precio,descuento,valor_impuesto,contador, model,id,total;

        
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
                             $('#preciounitario_'+contador).text('$ '+data.PRECIO);
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
                    precio = parseFloat($('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val(),10);
                    
                    //volver a calcular el monto descuento
                    precio = parseFloat($('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val(), 10);
                    total = precio * parseFloat($(this).val(), 10);
                    descuento = (total * parseFloat($('#LineaNuevo_'+contador+'_PORC_DESCUENTO').val(), 10))/100;
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
                    $('#preciounitario_'+contador).text('$ '+$(this).val());
                    $('#campo_preciounitario_'+contador).hide('fast');
                    //volver a calcular el monto descuento
                    total = parseFloat($(this).val(), 10) * parseFloat($('#LineaNuevo_'+contador+'_CANTIDAD').val(), 10);
                    descuento = (total * parseFloat($('#LineaNuevo_'+contador+'_PORC_DESCUENTO').val(), 10))/100;
                    $('#LineaNuevo_'+contador+'_MONTO_DESCUENTO').val(descuento);
                        
                     //calcular el total
                     calcularTotal(contador,'LineaNuevo');
                    $('#preciounitario_'+contador).show('fast');
                break;
                case 'porcdescuento':
                    $('#porcdescuento_'+contador).text($(this).val()+' %');
                    $('#campo_porcdescuento_'+contador).hide('fast'); 
                    precio = parseFloat($('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val(), 10);
                    total = precio * parseFloat($('#LineaNuevo_'+contador+'_CANTIDAD').val(), 10);
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
                         $('#preciounitario_'+contador).text('$ '+data.PRECIO);
                         $('#'+modelo+'_'+contador+'_PRECIO_UNITARIO').val(data.PRECIO);
                         
                         //volver a calcular el monto descuento
                         total = parseFloat(data.PRECIO, 10) * parseFloat($('#'+modelo+'_'+contador+'_CANTIDAD').val(), 10);
                         descuento = (total * parseFloat($('#'+modelo+'_'+contador+'_PORC_DESCUENTO').val(), 10))/100;
                         $('#'+modelo+'_'+contador+'_MONTO_DESCUENTO').val(descuento);
                         
                         //calcular el total
                         calcularTotal(contador,modelo);
                 });
        });
        
        $('#agregar').click(function(){
                $('.clonar').click();
                $(this).attr('disabled',true);
                contador = $('body').find('.rowIndex').max();
                model ='LineaNuevo';
                var impuesto;
                var tipo_precio = $('#Factura_NIVEL_PRECIO').val();
                
                agregarCampos(contador,model);
                $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+$('#Factura_ARTICULO').val(),
                    function(data){
                         impuesto = data.IMPUESTO;
                         $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
                        $('#porc_impuesto_'+contador).text(impuesto+" %");
                        $('#'+model+'_'+contador+'_PORC_IMPUESTO').val(impuesto);
                        
                         $('select[id$='+model+'_'+contador+'_UNIDAD]>option').remove();
                         
                         $.each(data.UNIDADES, function(value, name) {
                            if(value == $('#Factura_UNIDAD').val())
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                            else
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                        });
                        //cargar tipo de precio
                        $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&art='+$('#Factura_ARTICULO').val()+'&tipo='+tipo_precio,
                            function(data){
                                 $('#tipoprecio_'+contador).text(data.NOMBRE);
                                 $('#preciounitario_'+contador).text('$ '+data.PRECIO);
                                 $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(data.PRECIO);

                                 $('select[id$='+model+'_'+contador+'_TIPO_PRECIO]>option').remove();

                                 $.each(data.COMBO, function(value, name) {
                                        tipo_precio = data.SELECCION;
                                        if(value == tipo_precio)
                                            $('#'+model+'_'+contador+'_TIPO_PRECIO').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                        else
                                            $('#'+model+'_'+contador+'_TIPO_PRECIO').append("<option value='"+value+"'>"+name+"</option>");


                                });
                                valor_impuesto = (parseFloat(data.PRECIO, 10) * parseFloat(impuesto, 10))/100;
                                $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(valor_impuesto);
                                $('#valor_impuesto_'+contador).text('$ '+valor_impuesto);
                                
                                calcularTotal(contador,model);              
                         });
                         $('#Factura_ARTICULO').val('');
                        $('#Articulo_desc').val('');
                        $('#Factura_CANTIDAD').val('');
                        $('select[id$=Factura_UNIDAD]>option').remove();
                        $('#Factura_UNIDAD').append("<option value=''>Seleccione</option>");
                        $('#Factura_ARTICULO').focus();

                });
                $('#carga').ajaxSend(function(){
                    $("#carga").html('<div align="left" style="margin-bottom: 9px; margin-left: 7px;"><?php echo CHtml::image($ruta2);?></div>');
                });
                $('#carga').ajaxComplete(function(){
                    $('#carga').html('');
                });
     });
    
    $('.montos').blur(function(){
        if($(this).val()== '')
            $(this).val(0);
        
        calculoGranTotal(false);
    });
    
    $('.eliminaLinea').live('click',function(){
        contador = $(this).attr('name');
        model = 'LineaNuevo';
           
        $('#remover_'+contador).click();
        var contadorMax = $('body').find('.rowIndex').max();
        var contFor = parseFloat(contador, 10)+1;
        var linea = parseFloat(contador, 10); 
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
        calculoGranTotal(model);
        
    });
    
    
    function agregarCampos(contador,model){
        
        var articulo = $('#Factura_ARTICULO').val();
        var descripcion = $('#Articulo_desc').val();
        var cantidad = $('#Factura_CANTIDAD').val(); 
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_PORC_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_COMENTARIO').val('');
        
        //copia a spans para visualizar detalles
        $('#linea_'+contador).text(parseFloat(contador, 10) + 1);
        $('#articulo_'+contador).text(articulo);
        $('#descripcion_'+contador).text(descripcion);
        $('#cantidad_'+contador).text(cantidad);
        $('#porcdescuento_'+contador).text(0+' %');
        $('#monto_descuento_'+contador).text(0);
  
    } 
        
    
});



</script>
<?php 
    /* @var $this FacturaController*/
    
?>
<table style="margin-left: -100px;">
         <tr>
             <td style="width: 289px">
                <?php echo $form->textFieldRow($model,'ARTICULO',array('size'=>15,'tabindex'=>'7')); ?>
             </td>
             <td style="width: 28px;">
                    <?php $this->darBotonBuscar('#articulo'); ?>
            </td>
            <td>
                 <?php echo CHtml::textField('Articulo_desc','',array('disabled'=>true,'size'=>18)); ?>
           </td>
           <td>
               <table style="margin-left: -100px;margin-top:-4px;">
                   <tr>
                       <td style="width: 289px;">
                            <?php echo $form->textFieldRow($model,'CANTIDAD',array('size'=>4,'tabindex'=>'8'));?>
                       </td>
                   </tr>
               </table>
           </td>
           <td>
               <table style="margin-left: -120px;margin-top:-4px;">
                   <tr>
                       <td>
                            <?php echo $form->dropDownListRow($model,'UNIDAD',array(),array('empty'=>'Seleccione','style'=>'width: 120px;','tabindex'=>'9'));?>
                            <?php echo CHtml::hiddenField('NOMBRE_UNIDAD','');?>
                       </td>
                       <td>
                           <?php
                                $htmlOptions = array('id'=>'agregar','disabled'=>true,'style'=>'margin-top: 5px;','tabindex'=>'10');
                                $this->darBotonAddLinea(false,$htmlOptions);
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
                <th>#</th>
                <th>Artículo</th>
                <th>Descripción</th>
                <th>Cant.</th>
                <th>Unidad</th>
                <th>Tipo Precio</th>
                <th style="width: 74px;">Precio Unit.</th>  
                <th style="width: 74px;">% Desc.</th>
                <th style="width: 74px;">% Iva</th>
                <th>    Iva</th>
                <th>Total</th>
                <th></td>
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
                                            <span id='campo_cantidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('LineaNuevo[{0}][CANTIDAD]','',array('size'=>4,'class'=>'blur')); ?></span>                                                                                                            
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
                                            <span id='campo_preciounitario_<?php echo '{0}';?>'style="display:none;" ><?php echo CHtml::textField('LineaNuevo[{0}][PRECIO_UNITARIO]','',array('size'=>10,'class'=>'blur')); ?></span>                                         
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
                                            <?php echo '<span id="lineaU_'.$i.'">'.$linea->LINEA_NUM.'</span>'; ?>
                                   </td>
                                   <td>
                                            <?php echo '<span id="articuloU_'.$i.'">'.$linea->ARTICULO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ARTICULO"); ?>
                                   </td>
                                   <td> 
                                            <?php echo '<span id="descripcionU_'.$i.'">'.$linea->DESCRIPCION.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]DESCRIPCION"); ?>
                                   </td>
                                   <td>
                                            <?php echo '<span id="unidadU_'.$i.'">'.$linea->UNIDAD.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]UNIDAD"); ?>
                                    </td>
                                   <td>
                                            <?php echo '<span id="tipo_precioU_'.$i.'">'.$linea->TIPO_PRECIO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]TIPO_PRECIO"); ?>
                                    </td>
                                    <td>
                                            <?php echo '<span id="precio_unitarioU_'.$i.'">'.$linea->PRECIO_UNITARIO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PRECIO_UNITARIO"); ?>                                        
                                    </td>                                
                                    <td>
                                            <?php echo '<span id="porc_descuentoU_'.$i.'">'.$linea->PORC_DESCUENTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="monto_descuentoU_'.$i.'">'.$linea->MONTO_DESCUENTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="porc_impuestoU_'.$i.'">'.$linea->PORC_IMPUESTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="valor_impuestoU_'.$i.'">'.$linea->VALOR_IMPUESTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="estadoU_'.$i.'">'.$linea->ESTADO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ESTADO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="comentarioU_'.$i.'">'.$linea->COMENTARIO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]COMENTARIO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="totalU_'.$i.'">'.$linea->ESTADO.'</span>'; ?>
                                    </td>
                                    <td>                                     
                                           <div class="remove" id ="remover" style="float: left; margin-left: 5px;">
                                                      <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                     'buttonType'=>'button',
                                                                     'type'=>'danger',
                                                                     'size'=>'mini',
                                                                     'icon'=>'minus white',
                                                                     'htmlOptions'=>array('id'=>'btn-remover','class'=>'eliminaRegistro','name'=>$i,'disabled'=>$model->ESTADO == 'P' ? false : true)

                                                             ));
                                                     ?>
                                           </div>
                                       </td>
                             </tr>
                       <?php  endforeach; ?>
                       <?php echo CHtml::hiddenField('eliminar','' ); ?>
              <?php endif; ?>
        </tbody>
</table>
<?php $model->isNewRecord ? $i=0 : $i++; ?>
<?php echo CHtml::HiddenField('CAMPO_ACTUALIZA', $i); ?>