<script>
function add (){
    var a = $('#contador').val();
    var conf = $("#numLineas").val();
     if (a < '0'){
        $('#contadorCrea').val(1);
        $('#remover').addClass('remove');
    }
    else{
        a = parseInt(a, 10) + 1;
        $('#contadorCrea').val(a);
    }   

    if(conf <= a){
        $("#nuevo").css('display','none'); 
        $("#cargar").css('display','none'); 
    }
    $('#contador').val(a);
}

function Eliminar(id){
    var eliminar = $('#eliminar').get(0).value;
    eliminar = eliminar + id + ",";
    $('#eliminar').val(eliminar);
    var a = parseInt($('#contador').val(), 10);
    a--;
    if (a <= '1'){
        $('#remover').removeClass('remove');
    }
    else{
        a = parseInt(a, 10) - 1;
        $('#contador').val(a);
    }
    $('#contador').val(a);
    $("#nuevo").css('display','block');
    $("#cargar").css('display','block');
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

function cargaArticuloGrilla2 (grid_id){

       var contador = $('#oculto').get(0).value;
       var buscar = $.fn.yiiGridView.getSelection(grid_id);
       var nombreClase = 'OrdenCompraLinea';
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

function cargaArticuloGrilla (grid_id){
       
       var contador = $('#oculto').get(0).value;
       var buscar = $.fn.yiiGridView.getSelection(grid_id);
       var nombreClase = 'Nuevo';
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
<?php if(!$model->isNewRecord) : ?>
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
   var a = 0;
   
   $("#Flete").val(montFlete);
   $("#Seguro").val(montSeguro);
   $("#Anticipo").val(montAnticipo);
   
   while(i < ocultoUpd){
       
       var buscar = $("#OrdenCompraLinea_" + i + '_ARTICULO').val();
       
       $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarArticulo'); ?>&buscar='+buscar,
            function(data)
                  {
                        
                        $('select[id$=#OrdenCompraLinea_' + a + '_UNIDAD_COMPRA] > option').remove();
                        if(data.UNIDAD){
                             $(data.UNIDAD).each(function()
                             {
                                 var option = $('<option />');
                                 option.attr('value', this.ID).text(this.NOMBRE);  
                                 if (this.ID == data.ALMACEN)
                                     option.attr("selected",true);

                                 $('#OrdenCompraLinea_' + a + '_UNIDAD_COMPRA').append(option);

                             });
                             }
                         else{
                              $('select[id$=#OrdenCompraLinea_' + a + '_UNIDAD_COMPRA] > option').remove();
                         }
                         a++;
                })
       
       
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
        }
    )
});
</script>
<?php endif; ?>
<script>
$(document).ready(function(){
    
        var nombreClase = 'Nuevo';
        var nombreDescripcion;
        var nombreUnidad;
        var contador;
        var nombreFecha;
        var nombreLinea;
        var nombreFecha2;
        var nombreImpuesto;
        
        $("body").delegate("input", "click", function(e){
                // $(".fecha").live("click", function (e) {
                contador = $(this).attr('id').split('_')[1];
                nombreFecha = nombreClase + '_' + contador + '_' + 'FECHA_REQUERIDA';
                nombreFecha2 = nombreClase + '_' + contador + '_' + 'FECHA';
                nombreLinea = nombreClase + '_' + contador + '_' + 'LINEA_NUM';
                contador = parseInt(contador, 10) + 1;
                       
                $(function() {
                    
                    $( "#" + nombreFecha ).datepicker({dateFormat: 'yy-mm-dd'});
                    
                    $( "#" + nombreFecha2 ).datepicker({dateFormat: 'yy-mm-dd'});
                    //$( "#" + nombreFecha ).datepicker($.datepicker.regional['es']);
                    $("#" + nombreLinea ).val(contador);
                    $.datepicker.setDefaults($.datepicker.regional['es']);
                })
            }
        )
                
        $("#nuevo").live("click", function (e){
            var a = $('#contador').val();
            a--;
            $('select[id$=Nuevo_' + a + '_BODEGA] > option').remove();
            $('#OrdenCompra_BODEGA option').clone().appendTo('#Nuevo_' + a + '_BODEGA');
        });
        
    	$(".emergente").live("click", function (e) {
            //Obtenemos el numero del campo
            contador = $(this).attr('name');
            $('#oculto').val(contador);
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
})


    $(".calculos").live("change", function (e) {
            
            var clase1 = 'Nuevo';
            var clase2 = 'OrdenCompraLinea';
            var nombreClase = $(this).attr('id').split('_')[0];
            var contador = $(this).attr('id').split('_')[1];
            var precio = parseFloat($("#" + nombreClase + '_' + contador + '_PRECIO_UNITARIO').val(), 10);
            var cantidad = parseFloat($("#" + nombreClase + '_' + contador + '_CANTIDAD_ORDENADA').val(), 10);
            var descuento = parseFloat($("#" + nombreClase + '_' + contador + '_PORC_DESCUENTO').val(), 10);
            var impuesto = parseFloat($("#" + nombreClase + '_' + contador + '_PORC_IMPUESTO').val(), 10);
            var impuestoGen = parseFloat($("#OrdenCompra_PORC_DESCUENTO").val(), 10);
            var ciclo = parseInt($("#contador").val());
            var ciclo2 = parseInt($("#ocultoUpd").val());
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
            
            if(ciclo != 0){
                for (x=0; x< ciclo; x++){
                    total = total + parseFloat($("#" + clase1 + '_' + x + '_IMPORTE').val());
                    impTotal = impTotal + parseFloat($("#" + clase1 + '_' + x + '_VALOR_IMPUESTO').val());
                }
            }
            
            if(ciclo2 != 0){
                for (x=0; x< ciclo2; x++){
                    total = total + parseFloat($("#" + clase2 + '_' + x + '_IMPORTE').val());   
                    impTotal = impTotal + parseFloat($("#" + clase2 + '_' + x + '_VALOR_IMPUESTO').val());
                }
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
           
           var ciclo = parseInt($("#contador").val());
           
           for (x=0; x< ciclo; x++){
                importe = parseFloat($("#Nuevo_" + x + '_IMPORTE').val());
                impuesto = parseFloat($("#Nuevo_" + x + '_PORC_IMPUESTO').val());
                porDesc = parseFloat($("#Nuevo_PORC_DESCUENTO").val());
                
                
                descGen = (importe * porDesc) / 100;
                importe = importe - descGen;
                impuesto = (importe * impuesto) / 100;
                $("#Nuevo_" + x + "_VALOR_IMPUESTO").val(impuesto);
                montoImpuesto = montoImpuesto + impuesto;
           }
           $("#ImpVentas").val(montoImpuesto);
        });
        
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
    'htmlOptions'=>array('data-toggle'=>'modal', 'id'=>"cargar"),
)); ?>

<?php 
    $value = 0;
    $i = 0;
?>
     <div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid table table-bordered" cellspacing="0">
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
                                        <?php echo $form->labelEx($linea,'PORC_IMPUESTO');?>                                       
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
                                        <div id="nuevo" class="add">
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
                                                    <?php echo CHtml::textField('Nuevo[{0}][ARTICULO]','',array('class' => 'tonces', 'size'=>'11')); ?>
                                                    <?php echo CHtml::hiddenField('Nuevo[{0}][ID_SOLICITUD_LINEA]', ''); ?>
                                                    <?php echo CHtml::hiddenField('Nuevo[{0}][RESTA_CANT]', ''); ?>
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
                                                    <?php echo CHtml::textField('Nuevo[{0}][DESCRIPCION]','',array('class' => 'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('Nuevo[{0}][UNIDAD_COMPRA]','',array('prompt'=>'Seleccione articulo')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][SOLICITUD]','',array('readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('Nuevo[{0}][BODEGA]','',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('class' => 'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][FECHA_REQUERIDA]','',array('class'=>'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][FACTURA]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][PRECIO_UNITARIO]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][CANTIDAD_ORDENADA]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][PORC_DESCUENTO]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][MONTO_DESCUENTO]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][IMPORTE]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][PORC_IMPUESTO]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][VALOR_IMPUESTO]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>                                           
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][CANTIDAD_RECIBIDA]','0',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][CANTIDAD_RECHAZADA]','0',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][FECHA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][OBSERVACION]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][ESTADO]','P',array('size'=>'1', 'readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][LINEA_NUM]','',array('readonly'=>true, 'size'=>'5')); ?>
                                                   
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
                                                                    'htmlOptions'=>array('id'=>'-1', 'onClick'=>'Eliminar(id)'),
                                                                    
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
                                <?php if(!$model->isNewRecord) : ?>
                                <?php foreach($items as $i=>$person): ?>
                                <tr class="templateContent">
                                    <td>
                                        <?php echo $form->textField($person,"[$i]ARTICULO",array('style'=>'width:100px', 'class' => 'tonces')); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::hiddenField("[$i]ID_SOLICITUD_LINEA", $value); ?>
                                        <?php echo CHtml::hiddenField("[$i]RESTA_CANT", $value); ?>
                                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo2',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => "$i"),
                                                        )); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]DESCRIPCION",array('class'=>'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]UNIDAD_COMPRA",array()); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("OrdenCompraLinea[$i][SOLICITUD]", '', array('readonly'=>true)); ?>
                        </td>                     
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]BODEGA",CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('class'=>'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA_REQUERIDA",array('size' => '10')); ?>
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
                            <?php echo CHtml::textField("OrdenCompraLinea[$i][IMPORTE]", $value, array('readonly' => true, 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PORC_IMPUESTO",array('readonly'=>true, 'size' => '10')); ?>                            
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]VALOR_IMPUESTO",array('readonly'=>true, 'value'=>'0', 'size' => '10')); ?>
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
                            <?php echo $form->hiddenField($person,"[$i]ORDEN_COMPRA_LINEA",array()); ?>
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
                                <?php endif; ?>
                            </tbody>
                        </table>
                        
                    </div><!--panel-->
                </div><!--complex-->
    </div>
<?php if(!$model->isNewRecord) {$i++;} ?>
<?php echo CHtml::hiddenField('ocultoUpd', $i); ?>
<?php echo CHtml::hiddenField('contadorCrea', '0') ?>
<?php echo CHtml::hiddenField('eliminar',''); ?>