<script>
$(document).ready(function(){    
    var contador, model,id;
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
            switch(model){
                case 'cantidad':
                    $('#cantidad_'+contador).text($(this).val());
                    $('#campo_cantidad_'+contador).hide('fast');                                       
                    //calcular el total   
                    model = $(this).attr('id').split('_')[0];                    
                    calcularLinea(model,contador);
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
                    calcularLinea(model,contador);
                    $('#unitario_'+contador).show('fast');
                break;
                case 'descuento':
                    $('#descuento_'+contador).text($(this).val());
                    $('#campo_descuento_'+contador).hide('fast');                    
                    model = $(this).attr('id').split('_')[0];
                    calcularLinea(model,contador);
                    $('#descuento_'+contador).show('fast');
               break;
                case 'impuesto':
                    $('#impuesto_'+contador).text($(this).val());
                    $('#campo_impuesto_'+contador).hide('fast');                    
                    model = $(this).attr('id').split('_')[0];
                    calcularLinea(model,contador);
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
        $('#'+model+'_'+contador+'_SOLICITUD').val(0);
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
        calcularLinea(model,contador);
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
function calcularLinea(model, contador){
    var descuento = parseInt(unformat($('#'+model+'_'+contador+'_PORC_DESCUENTO').val(), 10));
    var cantidad = parseInt(unformat($('#'+model+'_'+contador+'_CANTIDAD_ORDENADA').val(), 10));
    var precio = parseInt(unformat($('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(), 10));
    var impuesto = parseInt(unformat($('#'+model+'_'+contador+'_PORC_IMPUESTO').val(), 10));
    var total = cantidad * precio;
    
    descuento = (total * descuento) / 100;
    total = total - descuento;
    impuesto = (total * impuesto) / 100
    total = format(total.toString().replace(/\./g,','));
    //impuesto = format(impuesto.toString().replace(/\./g,','));
    $('#'+model+'_'+contador+'_IMPORTE').val(total);
    $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(impuesto); 
    $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(descuento);     
    $('#importe_'+contador).text(total);
    calcularTotal();
}

function calcularTotal(){
    
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
                        </td>
                        <td>
                            <span id="importe_<?php echo '{0}';?>"></span>
                            <span id='campo_importe_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][IMPORTE]','0',array()); ?>
                            <?php echo CHtml::textField('Nuevo[{0}][VALOR_IMPUESTO]','0',array('readonly'=>true, 'size' => '10','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?></span>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][CANTIDAD_RECIBIDA]','',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][CANTIDAD_RECHAZADA]','0',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][FECHA]','',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][OBSERVACION]','',array()); ?>
                            <?php echo CHtml::hiddenField('Nuevo[{0}][ESTADO]','P',array()); ?>
                        </td>
                        <td>
                            <span style="float: left">
                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                        'buttonType'=>'button',
                                        'type'=>'normal',                                                                         
                                        'icon'=>'pencil',
                                        'htmlOptions'=>array('class'=>'edit','name'=>'{0}','id'=>'edit_{0}', 'disabled'=>$readonly)
                                  ));
                                 ?>
                            </span>
                            <div id="remover" class="remove">
                                <div style="float: left; margin-left: 5px;">
                                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                                            'buttonType'=>'button',
                                            'type'=>'danger',                                                                        
                                            'icon'=>'minus white',
                                            'htmlOptions'=>array('id'=>'eliminaLinea_{0}','class'=>'eliminaLinea','name'=>'{0}', 'disabled'=>$readonly)
                                            ));
                                     ?>
                                </div>
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
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
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
                        <?php echo $form->textField($person,"[$i]PRECIO_UNITARIO",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($person,"[$i]CANTIDAD_ORDENADA",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($person,"[$i]PORC_DESCUENTO",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                    </td>
                    <td>
                        <?php echo $form->textField($person,"[$i]MONTO_DESCUENTO",array('readonly'=>true, 'size' => '10','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?>
                    </td>
                    <td>
                        <?php echo CHtml::textField("OrdenCompraLinea[$i][IMPORTE]", $value, array('readonly' => true, 'size' => '10','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PORC_IMPUESTO",array('readonly'=>true, 'size' => '10')); ?>                            
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]VALOR_IMPUESTO",array('readonly'=>true, 'value'=>'0', 'size' => '10','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?>
                        </td>                       
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECIBIDA",array('readonly'=>true, 'size' => '5','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECHAZADA",array('readonly'=>true, 'size' => '5','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?>
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
                                                
                                                 $this->widget('bootstrap.widgets.TbButton', array(
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
<?php $model->isNewRecord ? $i=0 : $i++; ?>  
<?php echo CHtml::HiddenField('CAMPO_ACTUALIZA', $i); ?>
<?php echo CHtml::hiddenField('contadorCrea', '0') ?>
<?php echo CHtml::HiddenField('NAME', ''); ?>
<?php echo CHtml::hiddenField('eliminar',''); ?>