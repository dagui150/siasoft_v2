/*Calculos*/
    $(".calculos_form_lineas").live("change", function(e){
        var cantidad = parseFloat($('#PedidoLinea_CANTIDAD').val());
        var precio_unitario = parseFloat($('#PedidoLinea_PRECIO_UNITARIO').val());
        var porc_descuento = parseFloat($('#PedidoLinea_PORC_DESCUENTO').val());
        var porc_impuesto = parseFloat($('#PedidoLinea_PORC_IMPUESTO').val());        
        var total = cantidad * precio_unitario;
        var monto_descuento = (total * porc_descuento) / 100;
        var monto_impuesto = (total * porc_impuesto) / 100;
        total = total - monto_descuento + monto_impuesto;
        $('#PedidoLinea_MONTO_DESCUENTO').val(monto_descuento);
        $('#PedidoLinea_VALOR_IMPUESTO').val(monto_impuesto);
        $('#TOTAL').val(total);
    });