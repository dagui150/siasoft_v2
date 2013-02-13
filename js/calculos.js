/*Calculos*/
    $(".calculos_form_lineas").live("change", function(e){
        var model = $(this).attr('id').split('_')[0];       
        var cantidad = parseFloat($('#' + model + '_CANTIDAD').val());
        var precio_unitario = parseFloat($('#' + model + '_PRECIO_UNITARIO').val());
        var porc_descuento = parseFloat($('#' + model + '_PORC_DESCUENTO').val());
        var porc_impuesto = parseFloat($('#' + model + '_PORC_IMPUESTO').val());        
        var total = cantidad * precio_unitario;
        var monto_descuento = (total * porc_descuento) / 100;
        var monto_impuesto = (total * porc_impuesto) / 100; 
        
        $('#' + model + '_MONTO_DESCUENTO').val(monto_descuento);
        $('#' + model + '_VALOR_IMPUESTO').val(monto_impuesto);
        $('#TOTAL').val(total);
    });
    $(".calculos_montos").live("change", function(e){
        var model = $(this).attr('id').split('_')[0];
        var mercaderia = parseFloat($('#' + model + '_TOTAL_MERCADERIA').val());
        var descuento = parseFloat($('#' + model + '_MONTO_DESCUENTO1').val());
        var anticipo = parseFloat($('#' + model + '_MONTO_ANTICIPO').val());
        var flete = parseFloat($('#' + model + '_MONTO_FLETE').val());
        var seguro = parseFloat($('#' + model + '_MONTO_SEGURO').val());
        var impuesto = parseFloat($('#' + model + '_TOTAL_IMPUESTO1').val());        
        var total = mercaderia - descuento - anticipo + flete + seguro + impuesto;
        $('#total_grande').val(total);
        $('#calculos').text(total);
    });