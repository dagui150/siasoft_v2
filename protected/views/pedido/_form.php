<script>
    $(document).ready(inicio);
    
    function calcularTotal(contador,model){
        var total;
        
        var cantidad = parseInt($('#'+model+'_'+contador+'_CANTIDAD').val(), 10);
        var precio = parseInt($('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(), 10);
        var descuento = parseInt($('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(), 10);
        var iva =  parseInt($('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(), 10);
        
        total = ((cantidad * precio)-descuento)+iva;
        $('#total_'+contador).text('$ '+total); 
        $('#'+model+'_'+contador+'_TOTAL').val(total);
                
        calculoGranTotal(model);
    }
    function calculoGranTotal(model){
        
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
                $('#linea_'+i).text(parseInt(i, 10) + 1);
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
            
            $('.edit').live('click',actualiza);
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
    $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id'=>'pedido-form',
            'type'=>'horizontal',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                  'validateOnSubmit'=>true,
             ),	
    )); 
    $conf = ConfFa::model()->find();
    $confAs = ConfFa::model()->find();
    echo CHtml::hiddenField('dec_precio');
    echo CHtml::hiddenField('dec_porcentaje');
    $text_rubros =$conf->USAR_RUBROS == 0 ? '<div class="alert alert-info"><strong>Actualmente No usa Rubros</strong></div>' : '';
    $rubro1 =$conf->USAR_RUBROS == 1 && $conf->RUBRO1_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO1') : '';
    $rubro2 =$conf->USAR_RUBROS == 1 && $conf->RUBRO2_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO2') : '';
    $rubro3 =$conf->USAR_RUBROS == 1 && $conf->RUBRO3_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO3') : '';
    $rubro4 =$conf->USAR_RUBROS == 1 && $conf->RUBRO4_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO4') : '';
    $rubro5 =$conf->USAR_RUBROS == 1 && $conf->RUBRO5_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO5') : '';
?>
    
<?php
    if($model->isNewRecord){
        $calculos = $form->textFieldRow($model,'TOTAL_MERCADERIA',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true))
        .$form->textFieldRow($model,'MONTO_DESCUENTO1',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true))
        .$form->textFieldRow($model,'TOTAL_IMPUESTO1',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true))
        .$form->textFieldRow($model,'TOTAL_A_FACTURAR',array('prepend'=>'$','size'=>15,'maxlength'=>15,'value'=>0,'readonly'=>true));
        
        $calculos2 = $form->textFieldRow($model,'MONTO_ANTICIPO',array('prepend'=>'$','size'=>15,'maxlength'=>28,'value'=>0,'class'=>'montos'))
        .$form->textFieldRow($model,'MONTO_FLETE',array('prepend'=>'$','size'=>15,'maxlength'=>28,'value'=>0,'class'=>'montos'))
        .$form->textFieldRow($model,'MONTO_SEGURO',array('prepend'=>'$','size'=>15,'maxlength'=>28,'value'=>0,'class'=>'montos'));        
    }
    else{
        $calculos = $form->textFieldRow($model,'TOTAL_MERCADERIA',array('prepend'=>'$','size'=>15,'maxlength'=>15,'readonly'=>true))
        .$form->textFieldRow($model,'MONTO_DESCUENTO1',array('prepend'=>'$','size'=>15,'maxlength'=>15,'readonly'=>true))
        .$form->textFieldRow($model,'TOTAL_IMPUESTO1',array('prepend'=>'$','size'=>15,'maxlength'=>15,'readonly'=>true))
        .$form->textFieldRow($model,'TOTAL_A_FACTURAR',array('prepend'=>'$','size'=>15,'maxlength'=>15,'readonly'=>true));   
        
        $calculos2 = $form->textFieldRow($model,'MONTO_ANTICIPO',array('prepend'=>'$','size'=>15,'maxlength'=>28,'class'=>'montos'))
        .$form->textFieldRow($model,'MONTO_FLETE',array('prepend'=>'$','size'=>15,'maxlength'=>28,'class'=>'montos'))
        .$form->textFieldRow($model,'MONTO_SEGURO',array('prepend'=>'$','size'=>15,'maxlength'=>28,'class'=>'montos'));
    }
?>
<?php
    $fechaFactura = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_PEDIDO',
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
            'style'=>'width:80px;vertical-align:top',
            'value'=>date('Y-m-d'),
        ),  
   ), true);
    
    $fechaDespacho = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_PROMETIDA',
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
            'style'=>'width:80px;vertical-align:top'
        ),  
   ), true); 
    
    $fechaEntrega = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_EMBARQUE',
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
            'style'=>'width:80px;vertical-align:top'
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
            'buttonText'=>Yii::t('ui','Select form calendar'), 
            'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif', 
            'buttonImageOnly'=>true,
	),
        'htmlOptions'=>array(
            'style'=>'width:80px;vertical-align:top'
        ),  
   ), true); 
    
    $renderLineas = $this->renderPartial('lineas', array('linea'=>$linea, 'form'=>$form, 'model'=>$model,'ruta2'=>$ruta2,'modelLinea'=>$modelLinea),true);
    
?>

	<?php echo $form->errorSummary(array($model,$cliente)); ?>
        <table>
            <tr>
                <td>
            <table style="margin-left: -100px;">
                        <tr>
                            <td style="width: 315px">
                                <?php echo $form->dropDownListRow($model,'CONSECUTIVO',CHtml::listData(ConsecutivoFa::model()->findAllByAttributes(array('ACTIVO'=>'S','CLASIFICACION'=>'P')),'CODIGO_CONSECUTIVO','DESCRIPCION'),array('empty'=>'Seleccione','style'=>'width: 100px;')); ?>
                            </td>
                            <td style="width: 80px;">
                                <?php echo $form->textField($model,'PEDIDO',array('size'=>15,'maxlength'=>50,'readonly'=>true)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <div class="control-group ">
                                        <?php echo $form->labelEx($model,'FECHA_PEDIDO',array('class'=>'control-label')); ?>
                                        <div class="controls">   
                                            <?php 
                                                echo $fechaFactura; 
                                                echo $form->error($model,'FECHA_PEDIDO')
                                            ?>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <?php echo $form->dropDownListRow($model,'CONDICION_PAGO',CHtml::listData(CodicionPago::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 239px;','empty'=>'Seleccione','options'=>array($model->isNewRecord && $conf->COND_PAGO_CONTADO!= '' ? $conf->COND_PAGO_CONTADO : ''=>array('selected'=>'selected'))));?>
                            </td>
                        </tr>

                    </table>
                </td>
                <td>
            <table style="margin-left: -140px;">
                        <tr>
                            <td style="width: 315px">
                                <?php echo $form->textFieldRow($model,'CLIENTE',array('size'=>18,'maxlength'=>20)); ?>
                            </td>
                            <td style="width: 28px;padding-top:11px;">
                                <?php $this->widget('bootstrap.widgets.BootButton', array(
                                  'type'=>'info',
                                  'size'=>'mini',
                                  'url'=>'#cliente',
                                  'icon'=>'search',
                                  'htmlOptions'=>array('data-toggle'=>'modal'),
                            )); ?>
                            </td>
                            <td>
                                <?php echo CHtml::textField('Cliente_desc','',array('disabled'=>true,'size'=>31)); ?>
                            </td>
                            <td>
                                 <?php $this->widget('bootstrap.widgets.BootButton', array(
                                               'buttonType'=>'button',
                                               'type'=>'normal',
                                               'size'=>'mini',
                                               'icon'=>'pencil',
                                               'htmlOptions'=>array('style'=>'margin: 5px -25px 0 -3px; display:none','id'=>'editaCliente','onclick'=>'$("#clienteNuevo").modal();')
                                       ));
                                 ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo $form->dropDownListRow($model,'BODEGA',CHtml::listData(Bodega::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 150px;','empty'=>'Seleccione','options'=>array($model->isNewRecord && $conf->BODEGA_DEFECTO!= '' ? $conf->BODEGA_DEFECTO : ''=>array('selected'=>'selected'))));?>
                            </td>
                            <td rowspan="2" colspan="2">
                                  <span style="background-color:#EEEEEE;line-height:20px;text-align:center; text-shadow:#FFFFFF 0 1px 0;padding-left:5px;padding-top:9px;width:26px;height:28px;margin-top:57px;float:left;font-size: 42px;border:1px solid #CCCCCC;">$</span>
                                  <?php echo CHtml::textField('calculos','0',array('disabled'=>true,'style'=>'width:254px;height:40px;font-size: 34px;margin-top:56px;text-align:right;'));?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo $form->dropDownListRow($model,'NIVEL_PRECIO', CHtml::listData(NivelPrecio::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 150px;','empty'=>'Seleccione','options'=>array($model->isNewRecord && $conf->NIVEL_PRECIO!= '' ? $conf->NIVEL_PRECIO : ''=>array('selected'=>'selected'))));?>
                                <?php echo CHtml::hiddenField('NOMBRE_TIPO_PRECIO','');?>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <?php $this->widget('bootstrap.widgets.BootTabbable', array(
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
                                            .$form->labelEx($model,'FECHA_PROMETIDA',array('class'=>'control-label'))
                                            .'<div class="controls">'   
                                            .$fechaDespacho
                                            .'</div>
                                        </div>'
                                        .'<div class="control-group ">'
                                            .$form->labelEx($model,'FECHA_EMBARQUE',array('class'=>'control-label'))
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
                                        <legend ><font face="arial" size=3 >Rubros</font></legend>'
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
                                            .$calculos.'</td>
                                      <td>'
                                            .$calculos2
                                            .$form->hiddenField($model, 'REMITIDO', array('value'=>'N'))
                                            .$form->hiddenField($model, 'RESERVADO', array('value'=>'N'))
                                            .$form->hiddenField($model, 'ESTADO', array('value'=>'N'))
                                     .'</td>
                                 <tr>
                        </table>'
                        
                    ),
                )
            )); ?>

        <div align="center">
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small', 'url' => array('pedido/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php 
            $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'clienteNuevo')); ?>
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

                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                        'label'=>'Aceptar',
                        'icon'=>'ok',
                        'url'=>'#',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                    )); ?>
                </div>
        <?php $this->endWidget(); ?>

</div><!-- form -->

<?php $this->endWidget(); ?>
<!--ventanas modales-->

    <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'cliente')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
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
                    array(
                            'class'=>'bootstrap.widgets.BootButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'template'=>'',
                    ),
            ),
    ));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>

    <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'articulo')); ?>
 
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

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>
    
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'nuevo')); ?>
 
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