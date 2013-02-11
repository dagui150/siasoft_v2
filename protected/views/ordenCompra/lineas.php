<script>
$(document).ready(function(){    
    var contador, model,id;
    
    $('.eliminaLinea').live('click',function(){
        contador = $(this).attr('name');
        var model = 'Nuevo'; 
        $('#remover_'+contador).click();
        var contadorMax = $('body').find('.rowIndex').max();
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){            
            var campos = ['ARTICULO','DESCRIPCION','UNIDAD_COMPRA','FECHA_REQUERIDA','CANTIDAD_ORDENADA','SOLICITUD', 'PRECIO_UNITARIO','PORC_DESCUENTO','MONTO_DESCUENTO','PORC_IMPUESTO','VALOR_IMPUESTO','IMPORTE','CANTIDAD_RECIBIDA','CANTIDAD_RECHAZADA','FECHA','OBSERVACION','ESTADO','FACTURA','BODEGA'];
            var span = ['numero', 'campo_descripcion','descripcion','campo_unidad','unidad','requerida','campo_requerida','cantidad','campo_cantidad','unitario','campo_unitario','descuento','impuesto', 'campo_importe', 'importe','remover','edit','eliminaLinea','rowIndex'];
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
        calcularTotal(model);
    });
    
    $('.eliminaLineaU').live('click',function(){
        contador = $(this).attr('name');
        model = 'Nuevo';
        var model2 = 'OrdenCompraLinea';
        var numLinea = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
        var eliminar = $('#eliminar').val();
        eliminar = eliminar + $('#OrdenCompraLinea_'+contador+'_ORDEN_COMPRA_LINEA').val() + ',';
        $('#eliminar').val(eliminar);
        $('#CAMPO_ACTUALIZA').val(numLinea - 1);
        $('#removerU_'+contador).click();
        var contadorMax = $('body').find('.rowIndexU').max();
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){
           var campos = ['ARTICULO','DESCRIPCION','UNIDAD_COMPRA','ORDEN_COMPRA_LINEA','FECHA_REQUERIDA','CANTIDAD_ORDENADA','SOLICITUD', 'PRECIO_UNITARIO','PORC_DESCUENTO','MONTO_DESCUENTO','PORC_IMPUESTO','VALOR_IMPUESTO','IMPORTE','CANTIDAD_RECIBIDA','CANTIDAD_RECHAZADA','FECHA','OBSERVACION','ESTADO','FACTURA','BODEGA'];
           var span = ['numeroU', 'campo_descripcionU','descripcionU','campo_unidadU','unidadU','requeridaU','campo_requeridaU','cantidadU','campo_cantidadU','unitarioU','campo_unitarioU','descuentoU','impuestoU', 'campo_importeU', 'importeU','removerU','editU','eliminaLineaU','rowIndexU'];
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
        calcularTotal(model);
    });
    
    $('.cambiar').live('dblclick',function(){
            model = $(this).attr('id').split('_')[0];            
            contador = $(this).attr('id').split('_')[1];
            id = '#campo_'+model+'_'+contador;
            $(this).hide('fast');
            $(id).show('fast');
            switch(model){
                case 'requerida':
                    $('#Nuevo_'+contador+'_FECHA_REQUERIDA').focus();
                    break;
                case 'cantidad':
                    $('#Nuevo_'+contador+'_CANTIDAD_ORDENADA').focus();
                    break;
                case 'unidad':
                    $('#Nuevo_'+contador+'_UNIDAD_COMPRA').focus();
                    break;
                case 'preciounitario':
                    $('#Nuevo_'+contador+'_PRECIO_UNITARIO').focus();
                    break;
                case 'porcdescuento':
                    $('#Nuevo_'+contador+'_PORC_DESCUENTO').focus();
                    break;
                case 'porcimpuesto':
                    $('#Nuevo_'+contador+'_PORC_IMPUESTO').focus();
                    break;
            }
        });
        
        $('.blur').live('blur',function(){
            contador =  $(this).attr('id').split('_')[1];
            var span = '';
            switch(model){
                case 'cantidad':
                    $('#cantidad_'+contador).text($(this).val());
                    $('#campo_cantidad_'+contador).hide('fast');                                       
                    //calcular el total   
                    model = $(this).attr('id').split('_')[0];                    
                    calcularLinea(model,contador,span);
                    $('#cantidad_'+contador).show('fast');                    
                break;
                case 'unidad':
                    $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
                    $('#campo_unidad_'+contador).hide('fast');
                    $('#unidad_'+contador).show('fast');
                break;
                case 'unitario':
                    $('#unitario_'+contador).text($(this).val());
                    $('#campo_unitario_'+contador).hide('fast');
                    model = $(this).attr('id').split('_')[0];
                    calcularLinea(model,contador,span);
                    $('#unitario_'+contador).show('fast');
                break;
                case 'descuento':
                    $('#descuento_'+contador).text($(this).val());
                    $('#campo_descuento_'+contador).hide('fast');                    
                    model = $(this).attr('id').split('_')[0];
                    calcularLinea(model,contador,span);
                    $('#descuento_'+contador).show('fast');
               break;
                case 'impuesto':
                    $('#impuesto_'+contador).text($(this).val());
                    $('#campo_impuesto_'+contador).hide('fast');                    
                    model = $(this).attr('id').split('_')[0];
                    calcularLinea(model,contador,span);
                    $('#impuesto_'+contador).show('fast');
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
    
    $('.agregar').click(function(){        
        $('.clonar').click();
        var contador = $('body').find('.rowIndex').max();
        var model ='Nuevo'; 
        agregarCampos(contador,model);
        $.getJSON('<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+$('#OrdenCompra_ARTICULO').val(),
            function(data){
            $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
            $('select[id$='+model+'_'+contador+'_UNIDAD]>option').remove();
            $.each(data.UNIDADES, function(value, name) {
                if(value == $('#OrdenCompra_UNIDAD').val())
                    $('#'+model+'_'+contador+'_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                else
                    $('#'+model+'_'+contador+'_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                });
            });
            $('#carga').ajaxSend(function(){
                $("#carga").html('<div align="left" style="margin-bottom: 9px; margin-left: 7px;"><?php echo CHtml::image($ruta2);?></div>');
            });
            $('#carga').ajaxComplete(function(){
            $('#carga').html('');
        });
     });
 });
     
    function agregarCampos(contador,model){
        var date = new Date();
        date.setDate(date.getDate());
        var futDate= date.getFullYear() + "-" + date.getMonth()+1 + "-" + date.getDate();
        var span = '';
        var articulo = $('#OrdenCompra_ARTICULO').val();
        var descripcion = $('#Articulo_desc').val();
        var cantidad = $('#OrdenCompra_CANTIDAD').val();
        var precio = $('#OrdenCompra_PRECIO_UNITARIO').val();
        var cuentaActualiza = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion);
        $('#'+model+'_'+contador+'_CANTIDAD_ORDENADA').val(cantidad);
        $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(precio);
        $('#'+model+'_'+contador+'_SOLICITUD').val('');
        $('#'+model+'_'+contador+'_PORC_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_IMPORTE').val(0);        
        $('#'+model+'_'+contador+'_PORC_IMPUESTO').val(0);        
        $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(0);        
        $('#'+model+'_'+contador+'_CANTIDAD_RECIBIDA').val(0);        
        $('#'+model+'_'+contador+'_CANTIDAD_RECHAZADA').val(0);        
        $('#'+model+'_'+contador+'_FECHA').val(futDate);        
        $('#'+model+'_'+contador+'_OBSERVACION').val('');
        $('select[id$=Nuevo_' + contador + '_BODEGA] > option').remove();
        $('#OrdenCompra_BODEGA option').clone().appendTo('#'+model+'_'+contador+'_BODEGA');
        var select = $('#OrdenCompra_BODEGA option:selected').val();
        $("#"+model+"_"+contador+"_BODEGA option[value="+select+"]").attr("selected",true);
        $('#'+model+'_'+contador+'_FECHA_REQUERIDA').val(futDate);
        $('#'+model+'_'+contador+'_FACTURA').val('');
        $('#OrdenCompra_UNIDAD').clone().appendTo('#'+model+'_'+contador+'_UNIDAD');
        $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+articulo,
            
		  function(data)
                  {                        
                        $('select[id$='+model+'_'+contador+'_UNIDAD_COMPRA]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#'+model+'_'+contador+'_UNIDAD_COMPRA').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#'+model+'_'+contador+'_UNIDAD_COMPRA').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
		  });
        //copia a spans para visualizar detalles
        $('#numero_'+contador).text(parseInt(contador, 10) + 1 + cuentaActualiza);
        $('#descripcion_'+contador).text(descripcion);
        $('#unitario_'+contador).text(precio);
        $('#cantidad_'+contador).text(cantidad);
        $('#requerida_'+contador).text(futDate);
        $('#descuento_'+contador).text(0);
        $('#impuesto_'+contador).text(0);
        $('#importe_'+contador).text(0);
        $('#unidad_'+contador).text($('#OrdenCompra_UNIDAD option:selected').html());
        calcularLinea(model,contador, span);
    }
    function cargaSolicitud (){
        var myString = $('#check').val();
        var myArray = myString.split(',');
        var a = $('#contador').val();

        for(var i=0;i<myArray.length;i++){
            $('#nuevo').click();
            $("#OrdenCompraLinea_" + i + "_ID_SOLICITUD_LINEA").val(myArray[i]);
            $.getJSON(
                '<?php echo $this->createUrl('ordenCompra/CargarLineas'); ?>&seleccion='+myArray[i],
                function(data){
                    $('#Nuevo_' + a + '_ARTICULO').val(data.ARTICULO);
                    $('#Nuevo_' + a + '_DESCRIPCION').val(data.DESCRIPCION);
                    $('#Nuevo_' + a + '_FECHA_REQUERIDA').val(data.FECHA_REQUERIDA);
                    $('#Nuevo_' + a + '_RESTA_CANT').val(data.CANTIDAD);
                    $('#Nuevo_' + a + '_CANTIDAD_ORDENADA').val(data.CANTIDAD);
                    $('#Nuevo_' + a + '_OBSERVACION').val(data.COMENTARIO);               
                    $('#Nuevo_' + a + '_SOLICITUD').val(data.SOLICITUD);
                    $('#Nuevo_' + a + '_PORC_IMPUESTO').val(data.IMPUESTO);   
                    $('#Nuevo_' + a + '_ID_SOLICITUD_LINEA').val(data.ID);                
                    $('select[id$=Nuevo_' + a + '_UNIDAD_COMPRA] > option').remove();
                    $(data.UNIDAD).each(function()
                    {
                        var option = $('<option />');
                        option.attr('value', this.ID).text(this.NOMBRE);
                        $('#Nuevo_' + a + '_UNIDAD_COMPRA').append(option);
                    });
                    a++;
                    $('#contador').val(a);
                }
            )
        }
    }

    function cargaArticuloGrilla (grid_id){
       var att = $.fn.yiiGridView.getSelection(grid_id);       
       var nombreDescripcion = 'Articulo_desc'; 
       var articulo = 'OrdenCompra_ARTICULO';
            $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+att,
            
		  function(data)
                  {                        
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + articulo).val(data.ID);
                        $('select[id$=OrdenCompra_UNIDAD_COMPRA]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#OrdenCompra_UNIDAD_COMPRA').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#OrdenCompra_UNIDAD_COMPRA').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
		  });
    }
</script>
<?php if(!$model->isNewRecord) : ?>
<script>
$(document).ready(function(){
    
   var proveedor = $("#OrdenCompra_PROVEEDOR").val();
      
   $.getJSON(
        '<?php echo $this->createUrl('ordenCompra/CargarProveedor'); ?>&buscar='+proveedor,
        function(data)
        {
            $('#ProvNombre').val(data.NOMBRE);
            $('#ProvNombre2').val(data.NOMBRE);
            $('#ProvMail').val(data.EMAIL);
            $('#ProvContacto').val(data.CONTACTO);
            $('#ProvTelefono').val(data.TELEFONO);
            $('#OrdenCompra_PROVEEDOR').val(data.ID);
        }
    )
});
</script>
<?php endif; ?>
<script>
$(document).ready(function(){
        $(".tonces").live("change", function (e) {
            var nombreDescripcion = 'Articulo_desc';            
            $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+$(this).attr('value'),
            
		  function(data)
                  {
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('select[id$=OrdenCompra_UNIDAD_COMPRA]>option').remove();
                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#OrdenCompra_UNIDAD_COMPRA').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#OrdenCompra_UNIDAD_COMPRA').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
		  });
        });
})

// **** calculos **** //
function calcularLinea(model, contador, span){
    var afecta = $('#afecta').val();
    var descuento = parseFloat(unformat($('#'+model+'_'+contador+'_PORC_DESCUENTO').val()));
    var cantidad = parseFloat(unformat($('#'+model+'_'+contador+'_CANTIDAD_ORDENADA').val()));
    var precio = parseFloat(unformat($('#'+model+'_'+contador+'_PRECIO_UNITARIO').val()));
    var impuesto = parseFloat(unformat($('#'+model+'_'+contador+'_PORC_IMPUESTO').val()));
    var total = cantidad * precio;
    
    descuento = (total * descuento) / 100;
    total = total - descuento;    
    switch(afecta){
        case 'N' :
            impuesto = ((cantidad * precio) * impuesto) / 100;
            break;
        
        case 'L':
            impuesto = (total * impuesto) / 100;
            break;
            
        case 'A':
            var desc_gen = parseFloat(unformat($('#OrdenCompra_PORC_DESCUENTO').val()));
            desc_gen = (total * desc_gen) / 100;
            impuesto = ((total - desc_gen) * impuesto) / 100;
            break;
    }
        
    total = format(total.toString().replace(/\./g,','));
    //impuesto = format(impuesto.toString().replace(/\./g,','));
    $('#'+model+'_'+contador+'_IMPORTE').val(total);
    $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(impuesto); 
    $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(descuento);     
    $('#importe'+span+'_'+contador).text(total);
    model= 'Nuevo';
    calcularTotal(model);
}

function calcularTotal(model){
    var model2 = '<?php echo $model->isNewRecord ? false : 'OrdenCompraLinea'; ?>';
    var total_mercaderia =0,total_descuento=0,total_iva=0, total_comprar=0, saldo=0;
    var descuento,iva, importe, desc_general, monto_flete, monto_seguro, anticipo;
    //if($('body').find('.rowIndex').max() == -Infinity)        
    if(model != false){ 
            var contador = $('body').find('.rowIndex').max();
            var numLinea = parseInt($('#CAMPO_ACTUALIZA').val());
            for(var i = 0 ; i <=contador; i++){
                //lineas      
                importe = parseFloat(unformat($('#'+model+'_'+i+'_IMPORTE').val()));
                
                if($('#afecta').val() == 'A'){
                    var desc_gen = parseFloat(unformat($('#OrdenCompra_PORC_DESCUENTO').val()));
                    var impuesto = parseFloat(unformat($('#'+model+'_'+contador+'_PORC_IMPUESTO').val()));
                    desc_gen = (importe * desc_gen) / 100;
                    impuesto = ((importe - desc_gen) * impuesto) / 100;
                    $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(impuesto); 
                }
                
                   
                descuento = parseFloat(unformat($('#'+model+'_'+i+'_MONTO_DESCUENTO').val().toString().replace(/\./g,',')));
                iva =  parseFloat(unformat($('#'+model+'_'+i+'_VALOR_IMPUESTO').val().toString().replace(/\./g,',')));     
                total_mercaderia += importe;
                total_descuento += descuento;                
                total_iva += iva;                
                $('#numero_'+i).text(parseInt(i, 10) + 1 + numLinea);
            }
            
            //total
            desc_general = parseFloat(unformat($('#OrdenCompra_PORC_DESCUENTO').val()));            
            monto_flete = parseFloat(unformat($('#OrdenCompra_MONTO_FLETE').val()));
            monto_seguro = parseFloat(unformat($('#OrdenCompra_MONTO_SEGURO').val()));
            anticipo = parseFloat(unformat($('#OrdenCompra_MONTO_ANTICIPO').val()));            
            desc_general = total_mercaderia * desc_general / 100;            
            total_descuento += desc_general;
            total_comprar = total_mercaderia - total_descuento + total_iva + monto_flete + monto_seguro;
            saldo = total_comprar - anticipo;
            
            
            $('#TotalMerc').val(format(total_mercaderia.toString().replace(/\./g,',')));
            $('#MenosDescuento').val(format(total_descuento.toString().replace(/\./g,',')));
            $('#ImpVentas').val(format(total_iva.toString().replace(/\./g,','))); 
            $('#Flete').val(format(monto_flete.toString().replace(/\./g,',')));
            $('#Seguro').val(format(monto_seguro.toString().replace(/\./g,',')));
            $('#OrdenCompra_TOTAL_A_COMPRAR').val(format(total_comprar.toString().replace(/\./g,',')));
            $('#Anticipo').val(format(anticipo.toString().replace(/\./g,',')));
            $('#Saldo').val(format(saldo.toString().replace(/\./g,',')));
        }
        
    if(model2 != false){
            var contador = $('body').find('.rowIndexU').max();
            var numLinea = parseInt($('#CAMPO_ACTUALIZA').val());
            for(var i = 0 ; i <=contador; i++){
                //lineas      
                importe = parseFloat(unformat($('#'+model2+'_'+i+'_IMPORTE').val())); 
                descuento = parseFloat(unformat($('#'+model2+'_'+i+'_MONTO_DESCUENTO').val().toString().replace(/\./g,',')));
                if($('#afecta').val() == 'A'){
                    var desc_gen = parseFloat(unformat($('#OrdenCompra_PORC_DESCUENTO').val()));
                    var impuesto = parseFloat(unformat($('#'+model2+'_'+contador+'_PORC_IMPUESTO').val()));
                    importe = importe - descuento;
                    desc_gen = (importe * desc_gen) / 100;
                    impuesto = ((importe - desc_gen) * impuesto) / 100;
                    
                    $('#'+model2+'_'+contador+'_VALOR_IMPUESTO').val(impuesto);
                }                
                iva =  parseFloat(unformat($('#'+model2+'_'+i+'_VALOR_IMPUESTO').val().toString().replace(/\./g,',')));
                total_mercaderia += importe;
                total_descuento += descuento;
                total_iva += iva;
                if(model != false)
                $('#numeroU_'+i).text(parseInt(i, 10) + 1 + numLinea);
            }
            
            //total
            desc_general = parseFloat(unformat($('#OrdenCompra_PORC_DESCUENTO').val()));
            monto_flete = parseFloat(unformat($('#OrdenCompra_MONTO_FLETE').val()));
            monto_seguro = parseFloat(unformat($('#OrdenCompra_MONTO_SEGURO').val()));
            anticipo = parseFloat(unformat($('#OrdenCompra_MONTO_ANTICIPO').val()));
            desc_general = total_mercaderia * desc_general / 100;            
            total_descuento += desc_general;
            total_comprar = total_mercaderia - total_descuento + total_iva + monto_flete + monto_seguro;
            saldo = total_comprar - anticipo;
            
            $('#TotalMerc').val(format(total_mercaderia.toString().replace(/\./g,',')));            
            $('#MenosDescuento').val(format(total_descuento.toString().replace(/\./g,',')));            
            $('#ImpVentas').val(format(total_iva.toString().replace(/\./g,','))); 
            $('#Flete').val(format(monto_flete.toString().replace(/\./g,',')));
            $('#Seguro').val(format(monto_seguro.toString().replace(/\./g,',')));
            $('#OrdenCompra_TOTAL_A_COMPRAR').val(format(total_comprar.toString().replace(/\./g,',')));
            $('#Anticipo').val(format(anticipo.toString().replace(/\./g,',')));
            $('#Saldo').val(format(saldo.toString().replace(/\./g,',')));
        }
}
</script>
<?php

    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<?php $this->widget('bootstrap.widgets.TbButton', array(
    'type'=>'',
    'size'=>'mini',
    'url'=>'#lineas',
    'label' => 'Cargar Líneas',
    'icon'=>'icon-download-alt',
    'htmlOptions'=>array('data-toggle'=>'modal', 'id'=>"cargar"),
)); ?>

<?php 
    $value = 0;
    $i = 0;
?>
<div id="oculta-cancela">
<table>
    <tr>
        <td width="140px">
            <?php echo $form->textField($model,'ARTICULO',array('size'=>15, 'class'=>'tonces', 'placeholder'=>'Articulo')); ?>
        </td>
        <td>
            <?php $this->darBotonBuscar('#articulo'); ?>
        </td>
        <td>
            <?php echo CHtml::textField('Articulo_desc','',array('readonly'=>true,'size'=>20)); ?>
        </td>
        <td>
            <?php echo $form->textField($model,'CANTIDAD',array('size'=>4, 'placeholder'=>'Cant.', 'class'=>'decimal')); ?>
        </td>       
        <td>
            <?php echo $form->dropDownList($model,'UNIDAD_COMPRA',array(),array('empty'=>'Unidad','style'=>'width: 120px;'));?>
            <?php echo CHtml::hiddenField('NOMBRE_UNIDAD','');?>
        </td>
        <td>
             <?php echo $form->textField($model,'PRECIO_UNITARIO',array('size'=>8, 'placeholder'=>'Precio', 'class'=>'decimal')); ?>
        </td>
        <td>            
            <?php 
                $htmlOptions = array('id'=>'agregar','style'=>'margin-top: 5px;','tabindex'=>'10', 'class'=>'agregar');
                $this->darBotonAddLinea(false,$htmlOptions);
            ?>
        </td>
    </tr>
</table>
</div>
<span id="carga" style="height:30px;width:30px;"></span>

<table class="templateFrame grid table table-bordered" cellspacing="0">
    <thead>
        <tr>
            <td>
                #
            </td>
            <td>
                Articulo
            </td>
            <td>
                Unidad
            </td>
            <td>
                Requerida
            </td>            
            <td>
                Cant.
            </td>
            <td>
                Precio Und.
            </td>
            <td>
                % Desc.
            </td>
            <td>
                % IVA.
            </td>                               
            <td>
                Total
            </td>  
            <td>
                &nbsp;
            </td>
        </tr>
    </thead>
    <tfoot style="display:none;">
        <tr>
            <td>
                <div id="add" class="add">
                    <?php 
                        $htmlOptions = array('class'=>'clonar', 'style'=>'display:none');
                        $this->darBotonAddLinea(false,$htmlOptions);
                    ?>
                </div>
                <textarea class="template" rows="0" cols="0" style="display: none;" >
                    <tr class="templateContent">
                        <td>
                            <span id="numero_<?php echo '{0}';?>"></span>                           
                        </td>
                        <td>
                            <span id="descripcion_<?php echo '{0}';?>"></span>
                            <span id='campo_descripcion_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][DESCRIPCION]','',array()); ?></span>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][ARTICULO]','',array()); ?>
                        </td>
                        <td>
                            <span id="unidad_<?php echo '{0}';?>" class="cambiar"></span>
                            <span id='campo_unidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::dropDownList('Nuevo[{0}][UNIDAD_COMPRA]','',array('prompt'=>'Seleccione articulo', 'class'=>'blur unidad')); ?></span>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][SOLICITUD]','',array()); ?>
                            <span style="display:none"><?php echo CHtml::dropDownList('Nuevo[{0}][BODEGA]','',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array()); ?></span>
                        </td>
                        <td>
                            <span id="requerida_<?php echo '{0}';?>" class="cambiar"></span>
                            <span id='campo_requerida_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][FECHA_REQUERIDA]','',array('size'=>'10', 'class'=>'blur')); ?></span>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][FACTURA]','',array()); ?>
                        </td>
                        <td>
                            <span id="cantidad_<?php echo '{0}';?>" class="cambiar"></span>
                            <span id='campo_cantidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][CANTIDAD_ORDENADA]','0',array('size' => '5', 'class'=>'blur decimal')); ?></span>
                        </td>
                        <td>
                            <span id="unitario_<?php echo '{0}';?>" class="cambiar"></span>
                            <span id='campo_unitario_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][PRECIO_UNITARIO]','',array('size' => '10', 'class'=>'blur decimal')); ?></span>
                        </td>
                        <td>
                            <span id="descuento_<?php echo '{0}';?>" class="cambiar"></span>
                            <span id='campo_descuento_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][PORC_DESCUENTO]','0',array('size' => '5', 'class'=>'blur decimal')); ?></span>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][MONTO_DESCUENTO]','0',array()); ?>
                        </td>                        
                        <td>
                            <span id="impuesto_<?php echo '{0}';?>" class="cambiar"></span>
                            <span id='campo_impuesto_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][PORC_IMPUESTO]','0',array('size' => '10', 'class'=>'blur decimal')); ?></span>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][VALOR_IMPUESTO]','0',array()); ?>
                        </td>
                        <td>
                            <span id="importe_<?php echo '{0}';?>"></span>
                            <span id='campo_importe_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][IMPORTE]','0',array()); ?>
                            </span>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][CANTIDAD_RECIBIDA]','',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][CANTIDAD_RECHAZADA]','0',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][ID_SOLICITUD_LINEA]','',array()); ?>                            
                            <?php echo CHtml::hiddenField('Nuevo[{0}][FECHA]','',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][OBSERVACION]','',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][ESTADO]','P',array()); ?>
                        </td>
                        <td>
                                             <span style="float: left">
                                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                 'buttonType'=>'button',
                                                                 'type'=>'normal',
                                                                 'size'=>'small',
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
                                                             'size'=>'small',
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
                <?php if(!$model->isNewRecord) : ?>
                <?php foreach($items as $i=>$item): ?>
                <tr class="templateContent">
                        <td>
                            <?php echo '<span id="numeroU_'.$i.'">'.$item->LINEA_NUM.'</span>'; ?>                            
                        </td>
                        <td>
                            <?php echo '<span id="descripcionU_'.$i.'">'.$item->DESCRIPCION.'</span>'; ?>
                            <?php echo  CHtml::activeHiddenField($item,"[$i]DESCRIPCION",array()); ?>
                            <?php echo  CHtml::activeHiddenField($item,"[$i]ORDEN_COMPRA_LINEA",array()); ?>
                            <?php echo  CHtml::activeHiddenField($item,"[$i]ARTICULO", array()); ?> 
                        </td>
                        <td>
                            <?php echo '<span id="unidadU_'.$i.'">'.$item->uNIDADCOMPRA->NOMBRE.'</span>'; ?>
                            <div style="display:none;"><?php echo CHtml::activeDropDownList($linea,"[$i]UNIDAD_COMPRA",CHtml::listData(UnidadMedida::model()->findAll('ACTIVO = "S" AND TIPO = "'.$item->uNIDADCOMPRA->TIPO.'"'), 'ID', 'NOMBRE'),array('style'=>'width:65px;', 'options'=>array($item->UNIDAD_COMPRA => array('selected'=>'selected')))); ?></div>                                        
                            <div style="display:none;"><?php echo CHtml::activeDropDownList($linea,"[$i]BODEGA",CHtml::listData(Bodega::model()->findAll('ACTIVO = "S"'), 'ID', 'DESCRIPCION'),array('style'=>'width:65px;', 'options'=>array($item->BODEGA => array('selected'=>'selected')))); ?></div>
                        <td>
                            <?php echo '<span id="requeridaU_'.$i.'">'.$item->FECHA_REQUERIDA.'</span>'; ?>
                            <?php echo  CHtml::activeHiddenField($item,"[$i]FECHA_REQUERIDA",array()); ?>
                            <?php echo  CHtml::activeHiddenField($item,"[$i]FACTURA",array()); ?>                            
                        </td>
                        <td>
                            <?php echo '<span id="cantidadU_'.$i.'">'.$item->CANTIDAD_ORDENADA.'</span>'; ?>
                            <?php echo  CHtml::activeHiddenField($item,"[$i]CANTIDAD_ORDENADA",array()); ?></td>
                        <td>
                            <?php echo '<span id="unitarioU_'.$i.'">'.$item->PRECIO_UNITARIO.'</span>'; ?>
                            <?php echo  CHtml::activeHiddenField($item,"[$i]PRECIO_UNITARIO",array()); ?>
                        </td>
                        <td>
                            <?php echo '<span id="descuentoU_'.$i.'">'.$item->PORC_DESCUENTO.'</span>'; ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]PORC_DESCUENTO",array()); ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]MONTO_DESCUENTO",array()); ?>
                        </td>                        
                        <td>
                            <?php echo '<span id="impuestoU_'.$i.'">'.$item->PORC_IMPUESTO.'</span>'; ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]PORC_IMPUESTO",array()); ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]VALOR_IMPUESTO",array()); ?>
                        </td>
                        <td>
                            <?php echo '<span id="importeU_'.$i.'">'.$item->IMPORTE.'</span>'; ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]IMPORTE",array()); ?>                            
                            <?php echo CHtml::activeHiddenField($item,"[$i]CANTIDAD_RECIBIDA",array()); ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]CANTIDAD_RECHAZADA",array()); ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]FECHA",array()); ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]OBSERVACION",array()); ?>
                            <?php echo CHtml::activeHiddenField($item,"[$i]ESTADO",array()); ?>
                        </td>
                        <td>
                            <span style="float: left">
                                <?php $this->darBotonUpdateLinea(array('class'=>'editU','name'=>"$i",'id'=>"editU_$i", 'disabled'=>$readonly)); ?>
                            </span>
                            <div class="remove" id ="removerU" style="float: left; margin-left: 5px;">
                                <?php $this->darBotonDeleteLinea('',array('id'=>"eliminaLineaU_$i",'class'=>'eliminaLineaU','name'=>"$i", 'disabled'=>$readonly)); ?>
                            </div>
                                <?php echo CHtml::hiddenField("rowIndexU_$i", $i, array('class'=>'rowIndexU')); ?>
                        </td>
                     </tr>
                <?php endforeach; ?>
                <?php endif; ?>
             </tbody>
          </table>                        
<?php $model->isNewRecord ? $i=0 : $i++; ?>  
<?php echo CHtml::HiddenField('CAMPO_ACTUALIZA', $i); ?>
<?php echo CHtml::hiddenField('contadorCrea', '0') ?>
<?php echo CHtml::HiddenField('NAME', ''); ?>
<?php echo CHtml::hiddenField('eliminar',''); ?>