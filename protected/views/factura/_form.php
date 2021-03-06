<script>
    $(document).ready(inicio);
    
    function calcularTotal(contador,model){
        
        var cantidad = parseFloat(unformat($('#'+model+'_'+contador+'_CANTIDAD').val()));
        var precio_unitario = parseFloat(unformat($('#'+model+'_'+contador+'_PRECIO_UNITARIO').val()));
        var porc_descuento = parseFloat(unformat($('#'+model+'_'+contador+'_PORC_DESCUENTO').val()));
        var porc_impuesto = parseFloat(unformat($('#'+model+'_'+contador+'_PORC_IMPUESTO').val()));
        var total = cantidad * precio_unitario;
        
        var total_impuesto = (total * porc_impuesto)/100;
        var total_descuento = (total * porc_descuento)/100;
        var total_linea = parseFloat(total - total_descuento + total_impuesto);
        
        
        //Span Que muestran los valores en la tabla
        $('#total_'+contador).text(format(total_linea.toString().replace(/\./g,',')));//Total Linea
        $('#valor_impuesto_'+contador).text(format(total_impuesto.toString().replace(/\./g,',')));
        $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(format(total_descuento.toString().replace(/\./g,',')));
        $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(format(total_impuesto.toString().replace(/\./g,',')));
        $('#'+model+'_'+contador+'_TOTAL').val(format(total_linea.toString().replace(/\./g,',')));
        
        calculoGranTotal(model);
    }
    function calculoGranTotal(model){
        
        var total_mercaderia =  parseFloat(unformat($('#Factura_TOTAL_MERCADERIA').val()));
        var total_descuento =  parseFloat(unformat($('#Factura_MONTO_DESCUENTO1').val()));
        var total_iva =  parseFloat(unformat($('#Factura_TOTAL_IMPUESTO1').val()));
        var total_facturar =  parseFloat(unformat($('#Factura_TOTAL_A_FACTURAR').val()));
        var anticipo =  parseFloat(unformat($('#Factura_MONTO_ANTICIPO').val()));
        var flete =  parseFloat(unformat($('#Factura_MONTO_FLETE').val()));
        var seguro =  parseFloat(unformat($('#Factura_MONTO_SEGURO').val()));

        
        if(model != false){
            var total_mercaderia =0,total_facturar=0,total_descuento=0,total_iva=0;
            var cantidad,precio,descuento,iva,total;
            var contador = $('body').find('.rowIndex').max();
            for(var i = 0 ; i <=contador; i++){
                //lineas         
                cantidad = parseFloat(unformat($('#'+model+'_'+i+'_CANTIDAD').val()));
                precio = parseFloat(unformat($('#'+model+'_'+i+'_PRECIO_UNITARIO').val()));
                descuento = parseFloat(unformat($('#'+model+'_'+i+'_MONTO_DESCUENTO').val()));
                iva =  parseFloat(unformat($('#'+model+'_'+i+'_VALOR_IMPUESTO').val()));
                total = cantidad * precio;

                total_mercaderia += total;
                total_descuento += descuento;
                total_iva += iva;
                total_facturar = (total_mercaderia-total_descuento)+total_iva;
                $('#linea_'+i).text(parseFloat(i, 10) + 1);
            }
            $('#Factura_TOTAL_MERCADERIA').val(format(total_mercaderia.toString().replace(/\./g,',')));
            $('#Factura_MONTO_DESCUENTO1').val(format(total_descuento.toString().replace(/\./g,',')));
            $('#Factura_TOTAL_IMPUESTO1').val(format(total_iva.toString().replace(/\./g,',')));
            $('#Factura_TOTAL_A_FACTURAR').val(format(total_facturar.toString().replace(/\./g,',')));
      
        }
        var gran_total =(total_facturar - anticipo)+flete+seguro;
        $('#calculos').val(format(gran_total.toString().replace(/\./g,',')));
    }
    
    function inicio(){
            
            $('.templateTarget').html('');
            $('#Factura_CONSECUTIVO').focus();
            $('.edit').live('click',actualiza);
            $('#ok-cliente').click(function(){
                $('#Cliente_desc').val($('#Cliente_NOMBRE').val());
            });
            $('#Factura_UNIDAD').live('change',function(){
                var nombre = $('#Factura_UNIDAD option:selected').html()
                $('#NOMBRE_UNIDAD').val(nombre);
            });
            $('#FacturaLinea_TIPO_PRECIO').live('change',function(){
                $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&tipo='+$(this).val(),
                    function(data){
                         $('#NOMBRE_TIPO_PRECIO').val('');
                         $('#NOMBRE_TIPO_PRECIO').val(data.NOMBRE);
                         $('#FacturaLinea_PRECIO_UNITARIO').val(data.PRECIO);
                 });
            });
            $('#Factura_CONSECUTIVO').change(function(){
                $.getJSON('<?php echo $this->createUrl('cargarconsecutivo')?>&id='+$(this).val(),
                    function(data){

                        $('#Factura_FACTURA').val(data.VALOR);

                    }
                );
            });
            
            $('#Factura_CANTIDAD').change(function(){
                $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+$('#Factura_ARTICULO').val()+'&bodega='+$('#Factura_BODEGA').val()+'&cantidad='+$(this).val()+'&unidad='+$('#Factura_UNIDAD').val(),
                    function(data){
                        if(data.CANT_VALIDA == 'S' && $('#Articulo_existe').val() == 'S')
                            $('#agregar').attr('disabled',false);
                        else{
                            $('#agregar').attr('disabled',true);                            
                            $(this).focus();
                        }
                    });
            });
            
            $('#Factura_ARTICULO').change(function(){
                $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+$(this).val()+'&bodega='+$('#Factura_BODEGA').val(),
                    function(data){
                        $("#Articulo_desc").val(data.NOMBRE);
                         $('select[id$=Factura_UNIDAD]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#Factura_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#Factura_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
                        if(data.EXISTE == 'S')
                            $('#Articulo_existe').val('S');
                        else
                            $('#Articulo_existe').val('N');
                 });     

            });

            $('#Factura_CLIENTE').change(function(){
                var value = $(this).val()
                $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+value,
                    function(data){
                        if(data.EXISTE){
                            $('#Factura_CLIENTE_EXISTE').val('1');
                            $("#Cliente_desc").val(data.NOMBRE);
                            $('#editaCliente').slideUp('slow');
                            $('#Cliente_CLIENTE').val(0);
                            $('#Cliente_NOMBRE').val(0);
                            $('#Cliente_DIRECCION_COBRO').val(0);
                            $('#Cliente_TELEFONO1').val(0);
                        }else if($('#Factura_CLIENTE').val()!=''){
                            $("#Cliente_desc").val('Ninguno');
                             $('#Factura_CLIENTE').val('');
                             $('#Factura_CLIENTE').focus();
                            if(confirm('Cliente "'+value+'" no Existe ¿Desea crearlo?')) {
                                $('#clienteNuevo').modal();
                                $('#Cliente_CLIENTE').focus();
                                $('#Factura_CLIENTE_EXISTE').val('0');
                                $('#Cliente_CLIENTE').val(value);
                                $('#Cliente_NOMBRE').val('');
                                $('#Cliente_DIRECCION_COBRO').val('');
                                $('#Cliente_TELEFONO1').val('');
                                $('#editaCliente').slideDown('slow');
                                $('#Factura_CLIENTE').val(value);
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
           
           $('#Factura_BODEGA').change(function(){
                if($('.templateTarget').text() != ''){
                    if(confirm('¿Desea cambiar la bodega?\nSi se cambia perdera los items agregados')){
                        $('#Factura_ARTICULO').val('');
                        $('#Articulo_desc').val('Ninguno');
                        $('#Factura_CANTIDAD').val('');
                        $('select[id$=Factura_UNIDAD ] > option').remove();
                        $('#agregar').val('');
                        $('.templateTarget').html('');
                    }
                }
           });
    }
    
    function cargaGrilla(grid_id){
        var ID = $.fn.yiiGridView.getSelection(grid_id);
        var url;
        var campo;
        var campo_nombre;

        if (grid_id == 'cliente-grid'){
            url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+ID;
            campo = '#Factura_CLIENTE';
            campo_nombre = '#Cliente_desc';
            $('#editaCliente').slideUp('slow');
            $('#Factura_CLIENTE_EXISTE').val('1');
            $('#Cliente_CLIENTE').val(0);
            $('#Cliente_NOMBRE').val(0);
            $('#Cliente_DIRECCION_COBRO').val(0);
            $('#Cliente_TELEFONO1').val(0);
        }
        else if (grid_id == 'articulo-grid'){
            url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+ID;
            campo = '#Factura_ARTICULO';
            campo_nombre = '#Articulo_desc';
            $('#Factura_ARTICULO').focus();
        }
        $.getJSON(url,function(data){
                    $(campo).val(ID);
                    $(campo_nombre).val(data.NOMBRE); 
                    if(data.UNIDAD){

                         $('select[id$=Factura_UNIDAD]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                  $('#Factura_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $("#Factura_UNIDAD").val(data.UNIDAD);
                    }
                });    
    }
</script>
<div class="form">

<?php
    /* @var $this FacturaController */
    
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'factura-form',
            'type'=>'horizontal',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                  'validateOnSubmit'=>true,
             ),	
    )); 
    echo CHtml::hiddenField('Articulo_existe','');
    $text_rubros =$conf->USAR_RUBROS == 0 ? '<div class="alert alert-info"><strong>Actualmente No usa Campos adicionales</strong></div>' : '';
    $rubro1 =$conf->USAR_RUBROS == 1 && $conf->RUBRO1_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO1') : '';
    $rubro2 =$conf->USAR_RUBROS == 1 && $conf->RUBRO2_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO2') : '';
    $rubro3 =$conf->USAR_RUBROS == 1 && $conf->RUBRO3_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO3') : '';
    $rubro4 =$conf->USAR_RUBROS == 1 && $conf->RUBRO4_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO4') : '';
    $rubro5 =$conf->USAR_RUBROS == 1 && $conf->RUBRO5_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO5') : '';
?>
    
<?php
    $fechaFactura = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_FACTURA',
        'model'=>$model,
	'language'=>'es',
	'options'=>array(
            'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
            'dateFormat'=>'yy-mm-dd',
            'changeMonth'=>true,
            'changeYear'=>true,
            'showOn'=>'both', // 'focus', 'button', 'both'
            'buttonText'=>Yii::t('ui','Select form calendar'), 
            'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
            'buttonImageOnly'=>true,
	),
        'htmlOptions'=>array(
            'tabindex'=>'3',
            'style'=>'width:80px !important;vertical-align:top',
            'value'=>date('Y-m-d'),
        ),  
   ), true);
    
    $fechaDespacho = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_DESPACHO',
        'model'=>$model,
	'language'=>'es',
	'options'=>array(
            'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
            'dateFormat'=>'yy-mm-dd',
            'changeMonth'=>true,
            'changeYear'=>true,
            'showOn'=>'both', // 'focus', 'button', 'both'
            'buttonText'=>Yii::t('ui','Select form calendar'), 
            'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif', 
            'buttonImageOnly'=>true,
	),
        'htmlOptions'=>array(
            'style'=>'width:80px !important;vertical-align:top'
        ),  
   ), true); 
    
    $fechaEntrega = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_ENTREGA',
        'model'=>$model,
	'language'=>'es',
	'options'=>array(
            'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
            'dateFormat'=>'yy-mm-dd',
            'changeMonth'=>true,
            'changeYear'=>true,
            'showOn'=>'both', // 'focus', 'button', 'both'
            'buttonText'=>Yii::t('ui','Select form calendar'), 
            'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif', 
            'buttonImageOnly'=>true,
	),
        'htmlOptions'=>array(
            'style'=>'width:80px !important;vertical-align:top'
        ),  
   ), true); 
    $fechaOrden = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_ORDEN',
        'model'=>$model,
	'language'=>'es',
	'options'=>array(
            'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
            'dateFormat'=>'yy-mm-dd',
            'changeMonth'=>true,
            'changeYear'=>true,
            'showOn'=>'both', // 'focus', 'button', 'both'
            'buttonText'=>Yii::t('app','Select form calendar'), 
            'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif', 
            'buttonImageOnly'=>true,
	),
        'htmlOptions'=>array(
            'style'=>'width:80px !important;vertical-align:top'
        ),  
   ), true); 
    
    $renderLineas = $this->renderPartial('lineas', array('linea'=>$linea, 'form'=>$form, 'model'=>$model,'ruta2'=>$ruta2,),true);
    
?>

	<?php echo $form->errorSummary(array($model,$cliente)); ?>
        <table>
            <tr>
                <td>
            <table style="margin-left: -100px;">
                        <tr>
                            <td style="width: 315px">
                                <?php echo $form->dropDownListRow($model,'CONSECUTIVO',CHtml::listData(ConsecutivoFa::model()->findAllByAttributes(array('ACTIVO'=>'S','CLASIFICACION'=>'F')),'CODIGO_CONSECUTIVO','DESCRIPCION'),array('empty'=>'Seleccione','style'=>'width: 100px;','tabindex'=>'1')); ?>
                            </td>
                            <td style="width: 80px;">
                                <?php echo $form->textField($model,'FACTURA',array('size'=>15,'maxlength'=>50,'readonly'=>true)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <div class="control-group ">
                                        <?php echo $form->labelEx($model,'FECHA_FACTURA',array('class'=>'control-label')); ?>
                                        <div class="controls">   
                                            <?php 
                                                echo $fechaFactura; 
                                                echo $form->error($model,'FECHA_FACTURA')
                                            ?>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <?php echo $form->dropDownListRow($model,'CONDICION_PAGO',CHtml::listData(CodicionPago::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 239px;','empty'=>'Seleccione','tabindex'=>'5'));?>
                            </td>
                        </tr>

                    </table>
                </td>
                <td>
            <table style="margin-left: -115px;">
                        <tr>
                            <td style="width: 315px">
                                <?php echo $form->textFieldRow($model,'CLIENTE',array('size'=>18,'maxlength'=>20,'tabindex'=>'2')); ?>
                            </td>
                            <td style="width: 28px;">
                                <?php $this->darBotonBuscar('#cliente'); ?>
                            </td>
                            <td>
                                <?php echo CHtml::textField('Cliente_desc','',array('disabled'=>true,'size'=>24)); ?>
                            </td>
                            <td>
                                 <?php $this->widget('bootstrap.widgets.TbButton', array(
                                               'buttonType'=>'button',
                                               'type'=>'normal',
                                              'size'=>'small',
                                               'icon'=>'pencil',
                                               'htmlOptions'=>array('style'=>'margin: 5px -25px 0 -3px; display:none','id'=>'editaCliente','onclick'=>'$("#clienteNuevo").modal();')
                                       ));

                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo $form->dropDownListRow($model,'BODEGA',CHtml::listData(Bodega::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 150px;','empty'=>'Seleccione','tabindex'=>'4'));?>
                            </td>
                            <td rowspan="2" colspan="2">
                                  <span style="background-color:#EEEEEE;line-height:20px;text-align:center; text-shadow:#FFFFFF 0 1px 0;padding-left:5px;padding-top:9px;width:26px;height:28px;margin-top:57px;float:left;font-size: 42px;border:1px solid #CCCCCC;">$</span>
                                  <?php echo CHtml::textField('calculos','0',array('disabled'=>true,'style'=>'width: 185px !important;height:31px;font-size: 34px;margin-top:56px;text-align:right;'));?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo $form->dropDownListRow($model,'NIVEL_PRECIO', CHtml::listData(NivelPrecio::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 150px;','empty'=>'Seleccione','tabindex'=>'6'));?>
                                <?php echo CHtml::hiddenField('NOMBRE_TIPO_PRECIO','');?>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <?php $this->widget('bootstrap.widgets.TbTabs', array(
                'type'=>'tabs', // 'tabs' or 'pills'
                'tabs'=>array( 
                    array('label'=>'Líneas', 'content'=>$renderLineas, 'active'=>true),
                    array('label'=>'Otros', 'content'=>
                        '<table>
                            <tr>
                                <td style="width: 380px;">
                                    <fieldset >
                                        <legend ><font face="arial" size=3 >Fechas</font></legend>
                                        <div class="control-group ">'
                                            .$form->labelEx($model,'FECHA_DESPACHO',array('class'=>'control-label'))
                                            .'<div class="controls">'   
                                            .$fechaDespacho
                                            .'</div>
                                        </div>'
                                        .'<div class="control-group ">'
                                            .$form->labelEx($model,'FECHA_ENTREGA',array('class'=>'control-label'))
                                            .'<div class="controls">'   
                                            .$fechaEntrega
                                            .'</div>
                                        </div>'
                                   .'</fieldset>'
                                   .$form->textFieldRow($model,'COMENTARIOS_CXC',array('size'=>50,'maxlength'=>50))
                                   .$form->textAreaRow($model,'OBSERVACIONES',array('rows'=>6, 'cols'=>50))
                               .'</td>
                                <td>
                                    <fieldset>
                                        <legend ><font face="arial" size=3 >Campos adicionales</font></legend>'
                                        .$text_rubros
                                        .$rubro1
                                        .$rubro2
                                        .$rubro3
                                        .$rubro4
                                        .$rubro5
                                    .'</fieldset>
                               </td>
                            </tr>
                       </table>
                       <fieldset>
                               <legend ><font face="arial" size=3 >Orden de Compra</font></legend>
                               <table>
                                    <tr>
                                        <td style="width: 380px;">'
                                            .$form->textFieldRow($model,'ORDEN_COMPRA',array('size'=>30,'maxlength'=>50))
                                         .'</td>
                                        <td>
                                            <div class="control-group ">'
                                                .$form->labelEx($model,'FECHA_ORDEN',array('class'=>'control-label'))
                                                .'<div class="controls">'   
                                                    .$fechaOrden
                                                .'</div>
                                            </div>
                                        </td>
                                    <tr>
                            </table>
                      </fieldset>'
                    ),
                    array('label'=>'Montos', 'content'=>
                        '<table>
                                 <tr>
                                      <td style="width: 380px;">'
                                            .$form->textFieldRow($model,'TOTAL_MERCADERIA',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true, 'class'=>'decimal'))
                                            .$form->textFieldRow($model,'MONTO_DESCUENTO1',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true, 'class'=>'decimal'))
                                            .$form->textFieldRow($model,'TOTAL_IMPUESTO1',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true, 'class'=>'decimal'))
                                            .$form->textFieldRow($model,'TOTAL_A_FACTURAR',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true, 'class'=>'decimal'))
                                     .'</td>
                                      <td>'
                                           .$form->textFieldRow($model,'MONTO_ANTICIPO',array('prepend'=>'$','size'=>15,'maxlength'=>28,'value'=>0,'class'=>'montos decimal'))
                                           .$form->textFieldRow($model,'MONTO_FLETE',array('prepend'=>'$','size'=>15,'maxlength'=>28,'value'=>0,'class'=>'montos decimal'))
                                           .$form->textFieldRow($model,'MONTO_SEGURO',array('prepend'=>'$','size'=>15,'maxlength'=>28,'value'=>0,'class'=>'montos decimal'))
                                     .'</td>
                                 <tr>
                        </table>'
                        
                    ),
                )
            )); ?>

        <div align="center">
            <?php $this->darBotonEnviar($model->isNewRecord ? 'Crear' : 'Guardar');?>
            <?php $this->darBotonCancelar(); ?>
	</div>
    
        <?php 
            $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'clienteNuevo')); ?>
                <div class="modal-header">
                        <a class="close" data-dismiss="modal">&times;</a>
                        <h3>Cliente Nuevo</h3>
                </div>
                <div class="modal-body">
                        <br>
                  <?php 
                    echo $form->textFieldRow($cliente,'CLIENTE',array('maxlength'=>20,'value'=>0));
                    echo $form->textFieldRow($cliente,'NOMBRE',array('maxlength'=>60,'value'=>0));
                    echo $form->dropDownListRow($cliente,'UBICACION_GEOGRAFICA1',CHtml::listData(UbicacionGeografica1::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','NOMBRE'),array('empty'=>'Seleccione','options'=>array('73'=>array('selected'=>'selected'))));
                    echo $form->dropDownListRow($cliente,'UBICACION_GEOGRAFICA2',CHtml::listData(UbicacionGeografica2::model()->findAllByAttributes(array('ACTIVO'=>'S','UBICACION_GEOGRAFICA1'=>'73')),'ID','NOMBRE'),array('empty'=>'Seleccione','options'=>array('73001'=>array('selected'=>'selected'))));
                    echo $form->textFieldRow($cliente,'DIRECCION_COBRO',array('maxlength'=>128,'size'=>50,'value'=>0));
                    echo '<table>
                                <tr>
                                     <td width="50px;">'.$form->textFieldRow($cliente,'TELEFONO1', array('maxlength'=>16,'value'=>0)).'</td>      
                                     <td>'.$form->textField($cliente,'TELEFONO2', array('maxlength'=>16)).'</td>
                                </tr>
                          </table>';

                  ?>
                </div>
                <div class="modal-footer">

                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'Aceptar',
                        'icon'=>'ok',
                        'url'=>'#',
                        'htmlOptions'=>array('data-dismiss'=>'modal','id'=>'ok-cliente'),
                    )); ?>
                </div>
        <?php $this->endWidget(); ?>
    
</div><!-- form -->

<?php $this->endWidget(); ?>
<!--ventanas modales-->

 
<?php     
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'cliente')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'cliente-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$cliente->search(),
            'selectionChanged'=>'cargaGrilla',
            'filter'=>$cliente,
            'columns'=>array(
                array(  'name'=>'CLIENTE',
                        'header'=>'Codigo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->CLIENTE,"#")'
                    ),
                    'NOMBRE',
                    'NIT',
            ),
    ));
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
            <?php  $this->renderPartial('form_lineas', 
                        array(
                            'model'=>$model,
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    ); ?>
        </div>
 
<?php $this->endWidget(); ?>

<!--Fin modales-->