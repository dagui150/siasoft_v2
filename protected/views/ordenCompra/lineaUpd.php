<script>
$(document).ready(function(){
    
   var proveedor = $("#OrdenCompra_PROVEEDOR").val();
   var impuestoGen = parseFloat($("#OrdenCompra_PORC_DESCUENTO").val(), 10);
   var montFlete = parseFloat($("#OrdenCompra_MONTO_FLETE").val(), 10);
   var montSeguro = parseFloat($("#OrdenCompra_MONTO_SEGURO").val(), 10);
   var montAnticipo = parseFloat($("#OrdenCompra_MONTO_ANTICIPO").val(), 10);
   var totalCompra = parseFloat($("#OrdenCompra_TOTAL_A_COMPRAR").val(),10);
   var ocultoUpd = $("#ocultoUpd").val();
   var afecta = $("#afecta").val();
   var i = 0;
   var sumaImpuesto = 0;
   var totalLinea = 0;
   var total = 0;
   
   $("#Flete").val(montFlete);
   $("#Seguro").val(montSeguro);
   $("#Anticipo").val(montAnticipo);
   
   while(i <= ocultoUpd){
       
       var buscar = $("#OrdenCompraLinea_" + i + '_ARTICULO').val();
       var precio = parseFloat($("#OrdenCompraLinea_" + i + '_PRECIO_UNITARIO').val(), 10);
       var cantidad = parseFloat($("#OrdenCompraLinea_" + i + '_CANTIDAD_ORDENADA').val(), 10);
       var descuento = parseFloat($("#OrdenCompraLinea_" + i + '_PORC_DESCUENTO').val(), 10);
       var impuesto = parseFloat($("#OrdenCompraLinea_" + i + "_PORC_IMPUESTO").val(), 10);
       var totalLinea = precio * cantidad;
       
       descuento = (totalLinea * descuento) / 100;
       totalLinea = totalLinea - descuento;
       switch(afecta){
               case 'L': 
                   impuesto = (totalLinea * impuesto) / 100;
                   break;
               case 'A':
                   impuestoGen = (totalLinea * impuestoGen) / 100;
                   impuesto = (totalLinea - impuestoGen) * impuesto / 100;
                   break;
               case 'N':
                   impuesto = (precio * cantidad) * impuesto / 100;
                   break;
           }
           
            $("#_" + i + 'IMPORTE').val(totalLinea);
            $("#OrdenCompraLinea_" + i + '_MONTO_DESCUENTO').val(descuento);
            
       i++;
       
       sumaImpuesto = sumaImpuesto + impuesto;
       total = total + totalLinea;
       
   }
   
   impuestoGen = parseFloat($("#OrdenCompra_PORC_DESCUENTO").val(), 10);
   impuestoGen = total * impuestoGen / 100;
   
   $("#MenosDescuento").val(impuestoGen);
   $("#ImpVentas").val(sumaImpuesto);
   $("#TotalMerc").val(total);
   var saldo = totalCompra - montAnticipo;
   $("#Saldo").val(saldo);
   
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
            $('#OrdenCompra_PORC_DESCUENTO').val(data.DESCUENTO);
        }
    )
});
</script>
<script>
function add (){
    var a = parseInt($('#contarConf').val(), 10);
    var conf = parseInt($("#numLineas").val(), 10);
    
     if (a < '0'){
        $('#contarConf').val(1);
        $('#remover').addClass('remove');
    }
    else{
        a = parseInt(a, 10) + 1;
        $('#contarConf').val(a);
    }   

    if(conf <= a){
        $("#nuevo").css('display','none'); 
        $("#cargar").css('display','none'); 
    }
    $('#contarConf').val(a);
}

function Eliminar(id){
    var eliminar = $('#eliminar').get(0).value;
    eliminar = eliminar + id + ",";
    $('#eliminar').val(eliminar);
    var a = parseInt($('#contarConf').val(), 10);
    a--;
    if (a <= '1'){
        $('#remover').removeClass('remove');
    }
    else{
        a = parseInt(a, 10) - 1;
        $('#contarConf').val(a);
    }
    $('#contarConf').val(a);
    $("#nuevo").css('display','block');
    $("#cargar").css('display','block');
}

function cargaSolicitud (){
    var myString = $('#check').val();
    var myArray = myString.split(',');
    var a = $('#contador').val();
    
    for(var i=0;i<myArray.length;i++){
        $('#nuevo').click();
        
        $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarLineas'); ?>&seleccion='+myArray[i],
            function(data){
                $('#OrdenCompraLinea2_' + a + '_ARTICULO').val(data.ARTICULO);
                $('#OrdenCompraLinea2_' + a + '_DESCRIPCION').val(data.DESCRIPCION);
                $('#OrdenCompraLinea2_' + a + '_RESTA_CANT').val(data.CANTIDAD);
                $('#OrdenCompraLinea2_' + a + '_FECHA_REQUERIDA').val(data.FECHA_REQUERIDA);
                $('#OrdenCompraLinea2_' + a + '_CANTIDAD_ORDENADA').val(data.CANTIDAD);
                $('#OrdenCompraLinea2_' + a + '_OBSERVACION').val(data.COMENTARIO);               
                $('#OrdenCompraLinea2_' + a + '_SOLICITUD').val(data.SOLICITUD);
                $('#OrdenCompraLinea2_' + a + '_PORC_IMPUESTO').val(data.IMPUESTO);
                $('#OrdenCompraLinea2_' + a + '_ID_SOLICITUD_LINEA').val(data.ID);
                $('select[id$=OrdenCompraLinea2_' + a + '_UNIDAD_COMPRA] > option').remove();
                $(data.UNIDAD).each(function()
                {
                    var option = $('<option />');
                    option.attr('value', this.ID).text(this.NOMBRE);
                    $('#OrdenCompraLinea2_' + a + '_UNIDAD_COMPRA').append(option);
                });
                a++;
                $('#contador').val(a);  
            }
        )
    }
}

function cargaArticuloGrilla (grid_id){
       
       var contador = $('#oculto').get(0).value;
       var buscar = $.fn.yiiGridView.getSelection(grid_id);
       var nombreClase = '<?php echo get_class($linea); ?>';
       var nombreDescripcion;
       var nombreUnidad;
       var nombreArticulo;
       var nombreImpuesto;
       
        
        nombreDescripcion = nombreClase + '_' + contador + '_' + 'DESCRIPCION';
        nombreUnidad = nombreClase + '_' + contador + '_' + 'UNIDAD_COMPRA';
        nombreArticulo = nombreClase + '_' + contador + '_' + 'ARTICULO';
        nombreImpuesto = nombreClase + '_' + contador + '_' + 'PORC_IMPUESTO';
        
        $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+buscar,
            function(data)
                  {
                        $('select[id$=' + nombreUnidad + '] > option').remove();
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + nombreImpuesto).val(data.IMPUESTO);
                        $('#' + nombreArticulo).val(data.ID);
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);  
                 if (this.ID == data.ALMACEN)
                     option.attr("selected",true);
                 
                 $('#' + nombreUnidad).append(option);
                 
             });
             }
             else{
                  $('select[id$=' + nombreUnidad + '] > option').remove();
             }
		  })
        
    }
    
    function cargaArticuloGrilla2 (grid_id){
       
       var contador = $('#oculto').get(0).value;
       var buscar = $.fn.yiiGridView.getSelection(grid_id);
       var nombreClase = '<?php echo get_class($linea2); ?>';
       var nombreDescripcion;
       var nombreUnidad;
       var nombreArticulo;
       var nombreImpuesto;
       
        
        nombreDescripcion = nombreClase + '_' + contador + '_' + 'DESCRIPCION';
        nombreUnidad = nombreClase + '_' + contador + '_' + 'UNIDAD_COMPRA';
        nombreArticulo = nombreClase + '_' + contador + '_' + 'ARTICULO';
        nombreImpuesto = nombreClase + '_' + contador + '_' + 'PORC_IMPUESTO';
        
        $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+buscar,
            function(data)
                  {
                        $('select[id$=' + nombreUnidad + '] > option').remove();
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + nombreImpuesto).val(data.IMPUESTO);
                        $('#' + nombreArticulo).val(data.ID);
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);  
                 if (this.ID == data.ALMACEN)
                     option.attr("selected",true);
                 
                 $('#' + nombreUnidad).append(option);
                 
             });
             }
             else{
                  $('select[id$=' + nombreUnidad + '] > option').remove();
             }
		  })
        
    }
</script>
<script>
$(document).ready(function(){
    
        var nombreClase = '<?php echo get_class($linea); ?>';
        var nombreClase2 = '<?php echo get_class($linea2); ?>';
        var nombreDescripcion;
        var nombreUnidad;
        var contador;
        var nombreFecha;
        var nombreLinea;
        var nombreFecha2;
        var nombreFecha3;
        var nombreFecha4;
        var nombreImpuesto;
        var nombreLinea2;
        var update = $("#ocultoUpd").val();
        var linea =  $('#linea').get(0).value;
        
        
        $("body").delegate("input", "click", function(e){
                linea--;         
                // $(".fecha").live("click", function (e) {
                contador = $(this).attr('id').split('_')[1];
                nombreFecha = nombreClase + '_' + contador + '_' + 'FECHA_REQUERIDA';
                nombreFecha2 = nombreClase + '_' + contador + '_' + 'FECHA';
                nombreFecha3 = nombreClase2 + '_' + contador + '_' + 'FECHA_REQUERIDA';
                nombreFecha4 = nombreClase2 + '_' + contador + '_' + 'FECHA';
                nombreLinea = nombreClase + '_' + contador + '_' + 'LINEA_NUM';
                nombreLinea2 = nombreClase2 + '_' + contador + '_' + 'LINEA_NUM';
                contador = parseInt(contador, 10) + 1;
                linea = parseInt(contador, 10) + parseInt(linea, 10) + 1;
                       
                $(function() {
                    $( "#" + nombreFecha ).datepicker({dateFormat: 'yy-mm-dd'});
                    $( "#" + nombreFecha2 ).datepicker({dateFormat: 'yy-mm-dd'});
                    $( "#" + nombreFecha3 ).datepicker({dateFormat: 'yy-mm-dd'});
                    $( "#" + nombreFecha4 ).datepicker({dateFormat: 'yy-mm-dd'});
                    $.datepicker.setDefaults($.datepicker.regional['es']);
                    //$( "#" + nombreFecha ).datepicker($.datepicker.regional['es']);
                    $("#" + nombreLinea ).val(contador);
                    $("#" + nombreLinea2 ).val(linea);
                    linea = $('#linea').get(0).value;
                })
            }
        )
        
        $("#nuevo").live("click", function (e){
            var e = parseInt($("#ocultoContar").val(), 10);
            e++;
            $("#ocultoContar").val(e);
            var a = $('#contador').val();
            a--;
            $('select[id$=OrdenCompraLinea2_' + a + '_BODEGA] > option').remove();
            $('#OrdenCompra_BODEGA option').clone().appendTo('#OrdenCompraLinea2_' + a + '_BODEGA');
        });
        
    	$(".emergente").live("click", function (e) {
            //Obtenemos el numero del campo
            contador = $(this).attr('name');
            $('#oculto').val(contador);
	});
        
    	$(".emergente2").live("click", function (e) {
            //Obtenemos el numero del campo
            contador = $(this).attr('name');
            $('#oculto').val(contador);
	});

        
        $(".calculos").live("change", function (e) {
            
            var nombreClase = '<?php echo get_class($linea); ?>';
            var contador = $(this).attr('id').split('_')[1];
            var precio = parseFloat($("#" + nombreClase + '_' + contador + '_PRECIO_UNITARIO').val(), 10);
            var cantidad = parseFloat($("#" + nombreClase + '_' + contador + '_CANTIDAD_ORDENADA').val(), 10);
            var descuento = parseFloat($("#" + nombreClase + '_' + contador + '_PORC_DESCUENTO').val(), 10);
            var impuesto = parseFloat($("#" + nombreClase + '_' + contador + '_PORC_IMPUESTO').val(), 10);
            var impuestoGen = parseFloat($("#OrdenCompra_PORC_DESCUENTO").val(), 10);
            var ciclo = parseInt($("#contador").val());
            var config = $("#afecta").val();
            var totalLinea = precio * cantidad;
            var total = 0;
            var impTotal = 0;
            
            descuento = (totalLinea * descuento) / 100;
            totalLinea = totalLinea - descuento;
            
            switch(config){
               case 'L': 
                   impuesto = (totalLinea * impuesto) / 100;
                   break;
               case 'A':
                   impuestoGen = (totalLinea * impuestoGen) / 100;
                   impuesto = (totalLinea - impuestoGen) * impuesto / 100;
                   break;
               case 'N':
                   impuesto = (precio * cantidad) * impuesto / 100;
                   break;
           }

            $("#" + nombreClase + '_' + contador + '_IMPORTE').val(totalLinea);
            $("#" + nombreClase + '_' + contador + '_MONTO_DESCUENTO').val(descuento);
            $("#" + nombreClase + '_' + contador + '_VALOR_IMPUESTO').val(impuesto);
            
            for (x=0; x< ciclo; x++){
                total = total + parseFloat($("#" + nombreClase + '_' + x + '_IMPORTE').val());
                impTotal = impTotal + parseFloat($("#" + nombreClase + '_' + x + '_VALOR_IMPUESTO').val());
            }
            
            $("#TotalMerc").val(total);
            $("#ImpVentas").val(impTotal);
            
        });
        
        $(".calculos2").live("change", function (e) {
            
            var nombreClase = '<?php echo get_class($linea2); ?>';
            var contador = $(this).attr('id').split('_')[1];
            var precio = parseFloat($("#" + nombreClase + '_' + contador + '_PRECIO_UNITARIO').val(), 10);
            var cantidad = parseFloat($("#" + nombreClase + '_' + contador + '_CANTIDAD_ORDENADA').val(), 10);
            var descuento = parseFloat($("#" + nombreClase + '_' + contador + '_PORC_DESCUENTO').val(), 10);
            var impuesto = parseFloat($("#" + nombreClase + '_' + contador + '_PORC_IMPUESTO').val(), 10);
            var impuestoGen = parseFloat($("#OrdenCompra_PORC_DESCUENTO").val(), 10);
            var ciclo = parseInt($("#contador").val());
            var config = $("#afecta").val();
            var totalLinea = precio * cantidad;
            var total = parseFloat($("#TotalMerc").val(), 10);
            var impTotal = 0;
            
            descuento = (totalLinea * descuento) / 100;
            totalLinea = totalLinea - descuento;
            
            switch(config){
               case 'L': 
                   impuesto = (totalLinea * impuesto) / 100;
                   break;
               case 'A':
                   impuestoGen = (totalLinea * impuestoGen) / 100;
                   impuesto = (totalLinea - impuestoGen) * impuesto / 100;
                   break;
               case 'N':
                   impuesto = (precio * cantidad) * impuesto / 100;
                   break;
           }

            $("#" + nombreClase + '_' + contador + '_IMPORTE').val(totalLinea);
            $("#" + nombreClase + '_' + contador + '_MONTO_DESCUENTO').val(descuento);
            $("#" + nombreClase + '_' + contador + '_VALOR_IMPUESTO').val(impuesto);
            
            for (x=0; x< ciclo; x++){
                total = total + parseFloat($("#" + nombreClase + '_' + x + '_IMPORTE').val());
                impTotal = impTotal + parseFloat($("#" + nombreClase + '_' + x + '_VALOR_IMPUESTO').val());
            }
            
            $("#TotalMerc").val(total);
            $("#ImpVentas").val(impTotal);
            
        });
        
        $(".ambos").live("change", function(e){
            
           var importe;
           var porDesc;
           var descGen;
           var impuesto;
           var montoImpuesto = 0;
           var ciclo = parseInt($("#linea").val(), 10);
           var ciclo2 = parseInt($("#contador").val(), 10);
           
           for (x=0; x< ciclo; x++){
                importe = parseFloat($("#_" + x + 'IMPORTE').val());
                impuesto = parseFloat($("#OrdenCompraLinea_" + x + '_PORC_IMPUESTO').val());
                porDesc = parseFloat($("#OrdenCompra_PORC_DESCUENTO").val());
                
                descGen = (importe * porDesc) / 100;
                importe = importe - descGen;
                impuesto = (importe * impuesto) / 100;
                $("#OrdenCompraLinea_" + x + "_VALOR_IMPUESTO").val(impuesto);
                montoImpuesto = montoImpuesto + impuesto;
                
           }
           
           for (x=0; x< ciclo2; x++){
                importe = parseFloat($("#OrdenCompraLinea2_" + x + '_IMPORTE').val());
                impuesto = parseFloat($("#OrdenCompraLinea2_" + x + '_PORC_IMPUESTO').val());
                porDesc = parseFloat($("#OrdenCompra_PORC_DESCUENTO").val());
 
                descGen = (importe * porDesc) / 100;
                importe = importe - descGen;
                impuesto = (importe * impuesto) / 100;
                $("#OrdenCompraLinea2_" + x + "_VALOR_IMPUESTO").val(impuesto);
                montoImpuesto = montoImpuesto + impuesto;
           }
           $("#ImpVentas").val(montoImpuesto);
        });
        
        
        $(".tonces").live("change", function (e) {

            //Obtenemos el numero del campo
            contador = $(this).attr('id').split('_')[1];
            nombreDescripcion = nombreClase + '_' + contador + '_' + 'DESCRIPCION';
            nombreUnidad = nombreClase + '_' + contador + '_' + 'UNIDAD_COMPRA';
            nombreImpuesto = nombreClase + '_' + contador + '_' + 'PORC_IMPUESTO';
            
            $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+$(this).attr('value'),
            
		  function(data)
                  {
                        $('select[id$=' + nombreUnidad + '] > option').remove();
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + nombreImpuesto).val(data.IMPUESTO);
                        
                        
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);
                 if (this.ID == data.ALMACEN)
                     option.attr("selected",true);
                 
                 $('#' + nombreUnidad).append(option);
             });
             }
             else{
                  $('select[id$=' + nombreUnidad + '] > option').remove();
             }
		  });
            
    });
        $(".tonces2").live("change", function (e) {

            //Obtenemos el numero del campo
            contador = $(this).attr('id').split('_')[1];
            nombreDescripcion = nombreClase2 + '_' + contador + '_' + 'DESCRIPCION';
            nombreUnidad = nombreClase2 + '_' + contador + '_' + 'UNIDAD_COMPRA';
            nombreImpuesto = nombreClase2 + '_' + contador + '_' + 'PORC_IMPUESTO';
            
            $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+$(this).attr('value'),
            
		  function(data)
                  {
                        $('select[id$=' + nombreUnidad + '] > option').remove();
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + nombreImpuesto).val(data.IMPUESTO);
                        
                        
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);
                 if (this.ID == data.ALMACEN)
                     option.attr("selected",true);
                 
                 $('#' + nombreUnidad).append(option);
             });
             }
             else{
                  $('select[id$=' + nombreUnidad + '] > option').remove();
             }
		  });
            
    });
})
</script>
<?php

    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'type'=>'',
    'size'=>'mini',
    'url'=>'#lineas',
    'label' => 'Cargar Líneas',
    'icon'=>'icon-download-alt',
    'htmlOptions'=>array('data-toggle'=>'modal', 'id'=>'cargar'),
)); ?>

<?php 
    $value = 0;
?>

     <div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid" cellspacing="0">
                            <thead class="templateHead">
                                <tr>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ARTICULO');?>
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'DESCRIPCION');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'UNIDAD_COMPRA');?>
                                    </td>
                                    <td>
                                        <label>Solicitudes</label>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'BODEGA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FECHA_REQUERIDA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FACTURA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'PRECIO_UNITARIO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD_ORDENADA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'PORC_DESCUENTO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'MONTO_DESCUENTO');?>
                                    </td>
                                    <td>
                                        <label>Importe</label>
                                    </td>
                                    <td>
                                        <label>Porc. Impuesto</label>                                            
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'VALOR_IMPUESTO');?>
                                    </td>                                   
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD_RECIBIDA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD_RECHAZADA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FECHA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'OBSERVACION');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ESTADO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'LINEA_NUM');?>
                                    </td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][ARTICULO]','',array('class' => 'tonces')); ?>
                                                </td>
                                                <td>
                                                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => '{0}'),
                                                        )); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][DESCRIPCION]','',array('class' => 'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('OrdenCompraLinea[{0}][UNIDAD_COMPRA]','',array('prompt'=>'Seleccione articulo')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][SOLICITUD]','',array('readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('OrdenCompraLinea[{0}][BODEGA]','',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('prompt'=>'Seleccione Bodega')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][FECHA_REQUERIDA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][FACTURA]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][PRECIO_UNITARIO]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][CANTIDAD_ORDENADA]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][PORC_DESCUENTO]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][MONTO_DESCUENTO]','',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][IMPORTE]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][PORC_IMPUESTO]','',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][VALOR_IMPUESTO]','',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>                                           
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][CANTIDAD_RECIBIDA]','',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][CANTIDAD_RECHAZADA]','',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][FECHA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][OBSERVACION]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][ESTADO]','P',array('size'=>'1', 'readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][LINEA_NUM]','',array('readonly'=>true, 'size'=>'5')); ?>
                                                   
                                                </td>
                                                <td>
                                                    <div id="remover" class="remove">
                                                        <?php 
                                                
                                                            $this->widget('bootstrap.widgets.BootButton', array(
                                                                    'buttonType'=>'button',
                                                                    'type'=>'danger',
                                                                    'label'=>'',
                                                                    'icon'=>'minus white',
                                                                    'size' => 'normal',
                                                                    'htmlOptions'=> array('id'=>'OrdenCompraLinea{0}', 'onClick'=>'Eliminar(id)'),
                                                                    
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
                                    $persons = array();
                                    foreach($items as $i=>$person):
                                ?>
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($person,"[$i]ARTICULO",array('style'=>'width:100px', 'class' => 'tonces')); ?>
                                    </td>
                                    <td>
                                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => "[$i]"),
                                                        )); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]DESCRIPCION",array('class'=>'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]UNIDAD_COMPRA", $linea2->getCombo($person->ARTICULO),array('prompt'=>'Seleccione articulo')); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("[$i]SOLICITUD", '', array('readonly'=>true)); ?>
                        </td>                     
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]BODEGA",CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('class'=>'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA_REQUERIDA",array('class' => 'fecha', 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FACTURA",array()); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PRECIO_UNITARIO",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_ORDENADA",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PORC_DESCUENTO",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]MONTO_DESCUENTO",array('readonly'=>true, 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("[$i]IMPORTE", $value, array('size' => '10', 'readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PORC_IMPUESTO", array('size' => '10', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]VALOR_IMPUESTO",array('readonly'=>true, 'size' => '10')); ?>
                        </td>                       
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECIBIDA",array('readonly'=>true, 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECHAZADA",array('readonly'=>true, 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA",array('class' => 'fecha', 'size'=>'10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]OBSERVACION",array()); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]ESTADO",array('size'=>'1', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]LINEA_NUM",array('readonly'=>true, 'size'=>'5')); ?>
                        </td>
                                    <td>
                                        <div id="remover" class="remove">
                                              <?php 
                                                
                                                 $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'label'=>'',
                                                             'icon'=>'minus white',
                                                             'htmlOptions'=>array('id'=>$person["ORDEN_COMPRA_LINEA"], 'onClick'=>'Eliminar(id)'),
                                                  ));

                                             ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!--panel-->
                </div><!--complex-->
  


 <!-- Inicio tabla playground -->
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid" cellspacing="0">
                            <thead class="templateHead">
                                
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <div id="add" class="add">
                                            <?php 
                                                
                                                $this->widget('bootstrap.widgets.BootButton', array(
                                                        'buttonType'=>'button',
                                                        'type'=>'success',
                                                        'label'=>'Nuevo',
                                                        'icon'=>'plus white',
                                                        'htmlOptions' => array('id' => 'nuevo', 'onclick' => 'add()'),
                                                  ));
                                          
                                            ?>
                                        </div>
                                       <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][ARTICULO]','',array('class' => 'tonces2', 'size'=>'11')); ?>
                                                    <?php echo CHtml::hiddenField('OrdenCompraLinea2[{0}][ID_SOLICITUD_LINEA]', ''); ?>
                                                    <?php echo CHtml::hiddenField('OrdenCompraLinea2[{0}][RESTA_CANT]', ''); ?>
                                                </td>
                                                <td>
                                                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo2',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente2', 'name' => '{0}'),
                                                        )); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][DESCRIPCION]','',array('class' => 'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('OrdenCompraLinea2[{0}][UNIDAD_COMPRA]','',array('prompt'=>'Seleccione articulo')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][SOLICITUD]','',array('readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('OrdenCompraLinea2[{0}][BODEGA]','',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('class'=>'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][FECHA_REQUERIDA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][FACTURA]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][PRECIO_UNITARIO]','0',array('class'=>'calculos2', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][CANTIDAD_ORDENADA]','0',array('class'=>'calculos2', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][PORC_DESCUENTO]','0',array('class'=>'calculos2', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][MONTO_DESCUENTO]','',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][IMPORTE]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][PORC_IMPUESTO]','',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][VALOR_IMPUESTO]','',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>                                           
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][CANTIDAD_RECIBIDA]','0',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][CANTIDAD_RECHAZADA]','0',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][FECHA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][OBSERVACION]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][ESTADO]','P',array('size'=>'1', 'readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea2[{0}][LINEA_NUM]','',array('readonly'=>true, 'size'=>'5')); ?>
                                                   
                                                </td>
                                                <td>
                                                    <div id="remover" class="remove">
                                                        <?php 
                                                
                                                            $this->widget('bootstrap.widgets.BootButton', array(
                                                                    'buttonType'=>'button',
                                                                    'type'=>'danger',
                                                                    'label'=>'',
                                                                    'icon'=>'minus white',
                                                                    'size' => 'normal',
                                                                    'htmlOptions'=> array('id'=>'-1', 'onClick'=>'Eliminar(id)'),
                                                                    
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
                                    $persons = array();
                                    foreach($persons as $i=>$person):
                                ?>
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($person,"[$i]ARTICULO",array('style'=>'width:100px', 'class' => 'tonces2')); ?>
                                        <?php echo CHtml::hiddenField("[$i]ID_SOLICITUD_LINEA", $value); ?>
                                        <?php echo CHtml::hiddenField("[$i]RESTA_CANT", $value); ?>
                                    </td>
                                    <td>
                                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo2',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente2', 'name' => "[$i]"),
                                                        )); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]DESCRIPCION",array('class'=>'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]UNIDAD_COMPRA",array('prompt'=>'Seleccione articulo')); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("[$i]SOLICITUD", $value); ?>
                        </td>                     
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]BODEGA",CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('class'=>'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA_REQUERIDA",array('class' => 'fecha', 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FACTURA",array()); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PRECIO_UNITARIO",array('class'=>'calculos2', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_ORDENADA",array('class'=>'calculos2', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PORC_DESCUENTO",array('class'=>'calculos2', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]MONTO_DESCUENTO",array('readonly'=>true, 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("[$i]IMPORTE", $value, array('size' => '10', 'readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PORC_IMPUESTO", array('size' => '10', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]VALOR_IMPUESTO",array('readonly'=>true, 'size' => '10')); ?>
                        </td>                       
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECIBIDA",array('readonly'=>true, 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECHAZADA",array('readonly'=>true, 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA",array('class' => 'fecha', 'size'=>'10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]OBSERVACION",array()); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]ESTADO",array('size'=>'1', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]LINEA_NUM",array('readonly'=>true, 'size'=>'5')); ?>
                        </td>
                                    <td>
                                        <div id="remover" class="remove">
                                              <?php 
                                                
                                                 $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'label'=>'',
                                                             'icon'=>'minus white',
                                                             'htmlOptions'=>array('id'=>'-1', 'onClick'=>'Eliminar(id)'),
                                                  ));

                                             ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!--panel-->
                </div><!--complex-->
                
                 <!-- Fin tabla playground -->
                 
</div>
<?php echo CHtml::hiddenField('ocultoUpd', $i); ?>
<?php echo CHtml::HiddenField('linea', $person->LINEA_NUM); ?>
<?php 
$i++;
echo CHtml::hiddenField('contarConf', $i); ?>
<?php echo CHtml::hiddenField('eliminar',''); ?>