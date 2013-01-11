<script>
    $(document).ready(inicio);
    
    function calcularTotal(contador,model, model2){
        var total;
        
        var cantidad = parseInt($('#'+model+'_'+contador+'_CANTIDAD').val(), 10);
        var precio = parseInt($('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(), 10);
        var descuento = parseInt($('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(), 10);
        var iva =  parseInt($('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(), 10);
        
        total = ((cantidad * precio)-descuento)+iva;
        $('#total_'+contador).text(total); 
        $('#'+model+'_'+contador+'_TOTAL').val(total);
                
        calculoGranTotal(model, model2);
    }
    function calculoGranTotal(model, model2){
        
        var total_mercaderia =  parseInt($('#Pedido_TOTAL_MERCADERIA').val(), 10);
        var total_descuento =  parseInt($('#Pedido_MONTO_DESCUENTO1').val(), 10);
        var total_iva =  parseInt($('#Pedido_TOTAL_IMPUESTO1').val(), 10);
        var total_facturar =  parseInt($('#Pedido_TOTAL_A_FACTURAR').val(), 10);
        var anticipo =  parseInt($('#Pedido_MONTO_ANTICIPO').val(), 10);
        var flete =  parseInt($('#Pedido_MONTO_FLETE').val(), 10);
        var seguro =  parseInt($('#Pedido_MONTO_SEGURO').val(), 10);
        
        if(model != false){
            var total_mercaderia =0,total_facturar=0,total_descuento=0,total_iva=0;
            var cantidad,precio,descuento,iva,total;
            var contador = $('body').find('.rowIndex').max();           
            var numLinea = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
            for(var i = 0 ; i <=contador; i++){
                //lineas         
                cantidad = parseInt($('#'+model+'_'+i+'_CANTIDAD').val(), 10);
                precio = parseInt($('#'+model+'_'+i+'_PRECIO_UNITARIO').val(), 10);
                descuento = parseInt($('#'+model+'_'+i+'_MONTO_DESCUENTO').val(), 10);
                iva =  parseInt($('#'+model+'_'+i+'_VALOR_IMPUESTO').val(), 10);
                total = cantidad * precio;

                total_mercaderia += total;
                total_descuento += descuento;
                total_iva += iva;
                total_facturar = (total_mercaderia-total_descuento)+total_iva;
                $('#linea_'+i).text(parseInt(i, 10) + 1 + numLinea);
            }
            $('#Pedido_TOTAL_MERCADERIA').val(total_mercaderia);
            $('#Pedido_MONTO_DESCUENTO1').val(total_descuento);
            $('#Pedido_TOTAL_IMPUESTO1').val(total_iva);
            $('#Pedido_TOTAL_A_FACTURAR').val(total_facturar);
        }
        if(model2 != false){
           
            //var total_mercaderia =0,total_facturar=0,total_descuento=0,total_iva=0;
            //var cantidad,precio,descuento,iva,total;
            var contador = $('body').find('.rowIndexU').max();            
            var numLinea = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
            for(var i = 0 ; i <=contador; i++){      
                //lineas         
                cantidad = parseInt($('#'+model2+'_'+i+'_CANTIDAD').val(), 10);
                precio = parseInt($('#'+model2+'_'+i+'_PRECIO_UNITARIO').val(), 10);
                descuento = parseInt($('#'+model2+'_'+i+'_MONTO_DESCUENTO').val(), 10);
                iva =  parseInt($('#'+model2+'_'+i+'_VALOR_IMPUESTO').val(), 10);
                total = cantidad * precio;

                total_mercaderia += total;
                total_descuento += descuento;
                total_iva += iva;
                total_facturar = (total_mercaderia-total_descuento)+total_iva;
                $('#linea_'+i).text(parseInt(i, 10) + 1 + numLinea);
            }
            $('#Pedido_TOTAL_MERCADERIA').val(total_mercaderia);
            $('#Pedido_MONTO_DESCUENTO1').val(total_descuento);
            $('#Pedido_TOTAL_IMPUESTO1').val(total_iva);
            $('#Pedido_TOTAL_A_FACTURAR').val(total_facturar);
        }
        var gran_total =(total_facturar - anticipo)+flete+seguro;        
        $('#calculos').val(gran_total);
    }
    
    function inicio(){
        
            $('#calculos').val($('#Pedido_TOTAL_A_FACTURAR').val());
            var cliente = $('#Pedido_CLIENTE').val();
            $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+cliente,
                    function(data){
                        if(data.EXISTE)
                            $("#Cliente_desc").val(data.NOMBRE);
                            $('#editaCliente').slideUp('slow');
                            $('#Cliente_CLIENTE').val(0);
                            $('#Cliente_NOMBRE').val(0);
                            $('#Cliente_DIRECCION_COBRO').val(0);
                            $('#Cliente_TELEFONO1').val(0);
                    }
             );            
            
            $('.edit').live('click',function(){
                $('#SPAN').val('');
                $('#NAME').val($(this).attr('name'));
                actualiza();
            });
            $('.editU').live('click',function(){
                $('#SPAN').val('U');
                $('#NAME').val($(this).attr('name'));
                actualiza();
            });
            $('#Pedido_UNIDAD').live('change',function(){
                var nombre = $('#Pedido_UNIDAD option:selected').html()
                $('#NOMBRE_UNIDAD').val(nombre);
            });
            $('#PedidoLinea_TIPO_PRECIO').live('change',function(){
                $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&tipo='+$(this).val(),
                    function(data){
                         $('#NOMBRE_TIPO_PRECIO').val('');
                         $('#NOMBRE_TIPO_PRECIO').val(data.NOMBRE);
                         $('#PedidoLinea_PRECIO_UNITARIO').val(data.PRECIO);
                 });
            });
            $('#Pedido_CONSECUTIVO').change(function(){
                $.getJSON('<?php echo $this->createUrl('/factura/cargarconsecutivo')?>&id='+$(this).val(),
                    function(data){

                        $('#Pedido_PEDIDO').val(data.VALOR);

                    }
                );
            });

            $('#Pedido_ARTICULO').change(function(){
                $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+$(this).val(),
                    function(data){
                        $("#Articulo_desc").val(data.NOMBRE);
                         $('select[id$=Pedido_UNIDAD]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#Pedido_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#Pedido_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
                        $('#agregar').attr('disabled', false);
                 });     

            });

            $('#Pedido_CLIENTE').change(function(){
                var value = $(this).val()
                $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+value,
                    function(data){
                        if(data.EXISTE){
                            $("#Cliente_desc").val(data.NOMBRE);
                            $('#editaCliente').slideUp('slow');
                            $('#Cliente_CLIENTE').val(0);
                            $('#Cliente_NOMBRE').val(0);
                            $('#Cliente_DIRECCION_COBRO').val(0);
                            $('#Cliente_TELEFONO1').val(0);
                        }else{
                            $("#Cliente_desc").val('Ninguno');
                            if(confirm('Cliente "'+value+'" no Existe ¿Desea crearlo?')) {
                                $('#clienteNuevo').modal();
                                $('#Cliente_CLIENTE').val(value);
                                $('#Cliente_NOMBRE').val('');
                                $('#Cliente_DIRECCION_COBRO').val('');
                                $('#Cliente_TELEFONO1').val('');
                                $('#editaCliente').slideDown('slow');
                            }
                        }
                    }
                );
            }); 
            $('#Cliente_UBICACION_GEOGRAFICA1').change(function(){

                $.getJSON('<?php echo $this->createUrl('/proveedor/cargarubicacion')?>&ubicacion='+$(this).val(),
                    function(data){

                         $('select[id$=Cliente_UBICACION_GEOGRAFICA2 ] > option').remove();
                          $('#Cliente_UBICACION_GEOGRAFICA2').append("<option value=''>Seleccione</option>");

                        $.each(data, function(value, name) {
                                  $('#Cliente_UBICACION_GEOGRAFICA2').append("<option value='"+value+"'>"+name+"</option>");
                            });
                    });
           });
    }
    
    function cargaGrilla(grid_id){
        var ID = $.fn.yiiGridView.getSelection(grid_id);
        var url;
        var campo;
        var campo_nombre;

        if (grid_id == 'cliente-grid'){
            url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+ID;
            campo = '#Pedido_CLIENTE';
            campo_nombre = '#Cliente_desc';
            $('#editaCliente').slideUp('slow');
            $('#Cliente_CLIENTE').val(0);
            $('#Cliente_NOMBRE').val(0);
            $('#Cliente_DIRECCION_COBRO').val(0);
            $('#Cliente_TELEFONO1').val(0);
        }
        else if (grid_id == 'articulo-grid'){
            url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+ID;
            campo = '#Pedido_ARTICULO';
            campo_nombre = '#Articulo_desc';
            $('#agregar').attr('disabled', false);
        }
        $.getJSON(url,function(data){
                    $(campo).val(ID);
                    $(campo_nombre).val(data.NOMBRE); 
                    if(data.UNIDAD){

                         $('select[id$=Pedido_UNIDAD]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                  $('#Pedido_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $("#Pedido_UNIDAD").val(data.UNIDAD);
                    }
                });    
    }
    
    function formato(input){
        var num = input.value.replace(/\./g,'');
        if(!/,/.test(num)){
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/,'');
            input.value = num;
        }
    }
</script>
<div class="form">

<?php
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'pedido-form',
            'type'=>'horizontal',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                  'validateOnSubmit'=>true,
             ),	
    )); 
?>
    
<?php
    $renderLineas = $this->renderPartial('lineas', array('linea'=>$linea, 'form'=>$form, 'model'=>$model,'ruta2'=>$ruta2,'modelLinea'=>$modelLinea, 'articulo'=>$articulo),true);
    
?>

	<?php echo $form->errorSummary(array($model)); ?>
            <table  style="width: 250px">
            <!-- <table style="margin-left: -100px;"> -->
                <tr>
                    <td>
                        <?php //echo $form->dropDownListRow($model,'CONSECUTIVO',CHtml::listData(ConsecutivoFa::model()->findAllByAttributes(array('ACTIVO'=>'S','CLASIFICACION'=>'P')),'CODIGO_CONSECUTIVO','DESCRIPCION'),array('empty'=>'Seleccione','style'=>'width: 100px;')); ?>
                        <?php echo $form->textFieldRow($model,'ID',array('size'=>15,'readonly'=>true)); ?>
                    </td>
                    <td>
                        <?php //echo $form->textField($model,'PEDIDO',array('size'=>15,'maxlength'=>50,'readonly'=>true)); ?>
                        <?php echo $form->textFieldRow($model,'DESCRIPCION',array('size'=>30,'readonly'=>true)); ?>
                    </td>
                </tr>
            </table>
        <?php /*$this->widget('bootstrap.widgets.TbTabs', array(
                'type'=>'tabs', // 'tabs' or 'pills'
                'tabs'=>array( 
                    array('label'=>'Líneas', 'content'=>$renderLineas, 'active'=>true),
                )
            )); */
        
        echo $renderLineas;
        ?>

        <div align="center">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('label'=>'Cancelar', 'size'=>'small', 'url' => array('pedido/admin'), 'icon' => 'remove'));  ?>
	</div>

</div><!-- form -->

<?php $this->endWidget(); ?>
<!--ventanas modales-->

    <?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'articulo')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php
            $funcion = 'cargaGrilla';
            $id = 'articulo-grid';
            $data=$articulo->searchModal();
            $this->renderPartial('/articulo/articulos', array('articulo'=>$articulo,'funcion'=>$funcion,'id'=>$id,'check'=>false,'data'=>$data));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>
    
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'nuevo')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Línea</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
        <div id="form-lineas">
            <?php /* $this->renderPartial('form_lineas', 
                        array(
                            'model'=>$model,
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    );*/ ?>
        </div>
 
<?php $this->endWidget(); ?>

<!--Fin modales-->