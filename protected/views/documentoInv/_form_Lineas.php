<script>    
    //ANTES DE AGREGAR LA LINEA
    $(document).ready(inicio);
    
    function inicio(){ 
        var nombre_cantidad;
        $('#DocumentoInvLinea_TIPO_TRANSACCION').change(function (){
            
            $.getJSON('<?php echo $this->createUrl('agregarlinea'); ?>&tipo='+$(this).val(),
                function(data){
                    $('select[id$=DocumentoInvLinea_SUBTIPO ] > option').remove();
                    
                    if(data != ''){
                        
                         $('#DocumentoInvLinea_SUBTIPO').append("<option value=''>Seleccione</option>");
                    
                        $.each(data, function(value, name) {
                            $('#DocumentoInvLinea_SUBTIPO').append("<option value='"+value+"'>"+name+"</option>");
                        });
                        $('#DocumentoInvLinea_SUBTIPO').attr('readonly',false);
                    }else{
                        $('#DocumentoInvLinea_SUBTIPO').append("<option value=''>Ninguno</option>");
                        $('#DocumentoInvLinea_SUBTIPO').attr('readonly',true);
                    }
                        
            });
            
            $.getJSON('<?php echo $this->createUrl('agregarlinea'); ?>&tipo_transaccion='+$(this).val(),
                function(data){
                        $('#DocumentoInvLinea_BODEGA_DESTINO').attr('disabled',true);
                        $('#bodega-destino').attr('disabled',true);
                        
                        $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').attr('readonly',false);
                        $('select[id$=DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD ] > option').remove();
                        
                        if(data.TRANSACCIONES != ''){
                            
                            $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').append("<option value=''>Seleccione</option>");
                            
                            $.each(data.TRANSACCIONES, function(key, transaccion) {
                                
                                $.getJSON('<?php echo $this->createUrl('agregarlinea'); ?>&cantidad='+transaccion.CANTIDAD,
                                    function(respuesta){

                                        nombre_cantidad = respuesta.NOMBRE;

                                        $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').append("<option value='"+transaccion.CANTIDAD+"'>"+nombre_cantidad+"</option>");
                                });
                            });
                        }else{
                            $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').append("<option value=''>Seleccione</option>");
                            
                            $.getJSON('<?php echo $this->createUrl('agregarlinea'); ?>&cantidades='+1,
                                    function(data){

                                        $.each(data, function(value, name) {
                                            $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').append("<option value='"+value+"'>"+name+"</option>");
                                        });
                            });
                        }
                        
                        switch(data.TRANSACCION_BASE){
                            case 'COST':
                                  $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').attr('readonly',true);
                            break;
                            case 'TRAS':
                                   $('#DocumentoInvLinea_BODEGA_DESTINO').attr('disabled',false);
                                   $('#bodega-destino').attr('disabled',false);
                            break;
                       }
                });
        });
        
        $('#DocumentoInvLinea_BODEGA').blur(cargarBodega);
        $('#DocumentoInvLinea_BODEGA_DESTINO').blur(cargarBodegaDestino);
        $('#DocumentoInvLinea_ARTICULO').blur(cargarArticulo);
        $('.edit').live('click',actualiza);
        $('.editUpdate').live('click',actualizaUpdate);
        $('.eliminaRegistro').live('click',eliminaRegistro);
        //$('body').delegate('.eliminar','click',eliminar);
        
               
    }
    function cargando(){
                $("#form-lineas").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
    }
    
        
    //DAR VALORES A CAMPOS CON SELECCION DE GRILLA
    function updateCampos(id_grilla){
        var id = $.fn.yiiGridView.getSelection(id_grilla);
        var url;
        var campo;
        var campo_nombre;
        
        if(id_grilla == 'bodega-grid'){
            
            url = '<?php echo $this->createUrl('agregarlinea');?>&idBodega='+id;
            campo = '#DocumentoInvLinea_BODEGA';
            campo_nombre = '#NOMBRE_BODEGA';
            
        }else if(id_grilla == 'bodega-grid-destino'){
            
            url = '<?php echo $this->createUrl('agregarlinea');?>&idBodega='+id;
            campo = '#DocumentoInvLinea_BODEGA_DESTINO';
            campo_nombre = '#NOMBRE_BODEGA_DESTINO';
            
        }else if(id_grilla == 'articulo-grid'){
            
            url = '<?php echo $this->createUrl('agregarlinea');?>&idArticulo='+id;
            campo = '#DocumentoInvLinea_ARTICULO';
            campo_nombre = '#NOMBRE_ARTICULO';
            
        }
        
        $.getJSON(url,function(data){
                $(campo).val(id);
                $(campo_nombre).val(data.NOMBRE);
            });
        
    }
    
    
    //DAR VALORES A CAMPOS DE BODEGA CUANDO PIERDE FOCO
    function cargarBodega(){
        var idBodega = $(this).val();
        
        if(idBodega != ''){
            $.getJSON('<?php echo $this->createUrl('agregarlinea');?>&idBodega='+idBodega,
            function(data){
                
                $('#DocumentoInvLinea_BODEGA').val(idBodega);
                $('#NOMBRE_BODEGA').val(data.NOMBRE);
            });
        }else
            $('#NOMBRE_BODEGA').val('Ninguno');
        
    }
    
    //DAR VALORES A CAMPOS DE BODEGA DESTINO CUANDO PIERDE FOCO
    function cargarBodegaDestino(){
        var idBodega = $(this).val();
       
        if(idBodega != ''){
            $.getJSON('<?php echo $this->createUrl('agregarlinea');?>&idBodega='+idBodega,
            function(data){
                
                $('#DocumentoInvLinea_BODEGA_DESTINO').val(idBodega);
                $('#NOMBRE_BODEGA_DESTINO').val(data.NOMBRE);
            });
        }else
            $('#NOMBRE_BODEGA_DESTINO').val('Ninguno');
        
    }
    
    //DAR VALORES A CAMPOS DE ARTICULO CUANDO PIERDE FOCO
    function cargarArticulo(){
        var idArticulo = $(this).val();
        
        if(idArticulo != ''){
            $.getJSON('<?php echo $this->createUrl('agregarlinea');?>&idArticulo='+idArticulo,
            function(data){
                
                $('#DocumentoInvLinea_ARTICULO').val(idArticulo);
                $('#NOMBRE_ARTICULO').val(data.NOMBRE);
            });
        }else
            $('#NOMBRE_ARTICULO').val('Ninguno');
    }    
</script>
<script>            
     
     //agregar una linea
     function agregar(span){
        var contador ;
        var actualiza = $('#ACTUALIZA').val();
        var suma = true;
        var model = 'LineaNuevo';
        
        if(span == 'U')
            model = 'DocumentoInvLinea';
        
        $('.close').click();
        
        if(actualiza == 0){
            $('.add').click();
            contador = $('body').find('.rowIndex').max();
        }else{
            contador = $('#CAMPO_ACTUALIZA').val();
            suma = false;
        }
                
        copiarCampos(contador,model,span,suma);
        
        if(actualiza == 0)
            add();
                
        $('#alert').remove();
        $('#resetear').click();
        $('#form-cargado').slideDown('slow');
        $('#boton-cargado').remove();
        limpiarForm(false);
    }
    
    //para sumar a los contadores 1 es para validar que quede una liena,
    //y el otro es para poder tener el consecutivo de la linea que va es cual siempres suma
    function add(){
        var cuentaLineas = $('#contador').val();
        var maxLineas = $('#maxLineas').val();
        
        //CONTADOR QUE SIEMPRE SUMA
        var contadorLineas = $('#contadorLineas').val();
        contadorLineas = parseInt(contadorLineas, 10) + 1;
        
        $('#contadorLineas').val(contadorLineas);
        
        if (cuentaLineas < '0'){
            $('#contador').val(1);
            $('#remover').addClass('remove');
        }
        else{
            cuentaLineas = parseInt(cuentaLineas, 10) + 1;
            $('#contador').val(cuentaLineas);
            if(cuentaLineas == maxLineas)
                $('#btn-nuevo').attr('disabled',true);
        }
    }
    
    //copiar a campos en la linea despues de creada esta
    function copiarCampos(contador,model,span,suma){
        
        var articulo = $('#DocumentoInvLinea_ARTICULO').val();
        var nombrearticulo = $('#NOMBRE_ARTICULO').val();
        var bodega = $('#DocumentoInvLinea_BODEGA').val();
        var nombrebodega = $('#NOMBRE_BODEGA').val();
        var bodegadestino = $('#DocumentoInvLinea_BODEGA_DESTINO').val();
        var nombrebodegadestino = $('#NOMBRE_BODEGA_DESTINO').val();
        var cantidad = $('#DocumentoInvLinea_CANTIDAD').val();
        var tipotransaccion = $('#DocumentoInvLinea_TIPO_TRANSACCION').val();
        var subtipo = $('#DocumentoInvLinea_SUBTIPO').val();
        var tipoTransaccionCantidad = $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').val();
        var unidad = $('#DocumentoInvLinea_UNIDAD').val();
        var costounitario = $('#DocumentoInvLinea_COSTO_UNITARIO').val();
        
        //copia a spans para visualizar detalles
        if(suma == true)
            $('#linea'+span+'_'+contador).text(parseInt($('#contadorLineas').val(), 10) + 1);
        $('#articulo'+span+'_'+contador).text(articulo);
        $('#descripcion'+span+'_'+contador).text(nombrearticulo);
        $('#bodega'+span+'_'+contador).text(bodega+' - '+nombrebodega);
        $('#cantidad'+span+'_'+contador).text(cantidad);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_TIPO_TRANSACCION').val(tipotransaccion);
        $('#'+model+'_'+contador+'_SUBTIPO').val(subtipo);
        $('#'+model+'_'+contador+'_TIPO_TRANSACCION_CANTIDAD').val(tipoTransaccionCantidad);
        $('#'+model+'_'+contador+'_BODEGA').val(bodega);
        $('#'+model+'_'+contador+'_NOMBRE_BODEGA').val(nombrebodega);
        $('#'+model+'_'+contador+'_BODEGA_DESTINO').val(bodegadestino);
        $('#'+model+'_'+contador+'_NOMBRE_BODEGA_DESTINO').val(nombrebodegadestino);
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_NOMBRE_ARTICULO').val(nombrearticulo);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_UNIDAD').val(unidad);
        $('#'+model+'_'+contador+'_COSTO_UNITARIO').val(costounitario);
        
    }
    //revisar el contador para validar que quede almenos una linea
    function eliminar(){
        var cuentaLineas = $('#contador').val();
        var maxLineas = $('#maxLineas').val();
        
        if (cuentaLineas <= '1'){
            $('#remover').removeClass('remove');
        }
        else{
            cuentaLineas = parseInt(cuentaLineas, 10) - 1;
            if(cuentaLineas == 1){
                $('#remover').removeClass('remove');
                $('#btn-remover').removeClass('eliminaRegistro');
                $('#contadorLineas').val(1) 
            }
                
            $('#contador').val(cuentaLineas);
            if(cuentaLineas < maxLineas)
                $('#btn-nuevo').attr('disabled',false);
        }
    }
    
    //resetear el formulario true es solo para la creacion de la primera linea
    function limpiarForm(bolean){
        
        if(bolean == true){
            $('#documento-inv-linea-form').each (function(){
              this.reset();
            });
        }else{
            $('#DocumentoInvLinea_TIPO_TRANSACCION').val('');
            
            restaurarCombos();
            $('#DocumentoInvLinea_SUBTIPO').val('');
            $('#DocumentoInvLinea_SUBTIPO').attr('readonly',true);
            $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').val('');
            $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').attr('readonly',true);
            
            $('#DocumentoInvLinea_BODEGA').val('');
            $('#NOMBRE_BODEGA').val('');
            $('#DocumentoInvLinea_BODEGA_DESTINO').val('');
            $('#DocumentoInvLinea_BODEGA_DESTINO').attr('disabled',true);
            $('#bodega-destino').attr('disabled',true);
            $('#NOMBRE_BODEGA_DESTINO').attr('disabled',true);
            $('#NOMBRE_BODEGA_DESTINO').val('');
            $('#DocumentoInvLinea_ARTICULO').val('');
            $('#NOMBRE_ARTICULO').val('');
            $('#DocumentoInvLinea_CANTIDAD').val('');
            $('#DocumentoInvLinea_UNIDAD').val('');
            $('#DocumentoInvLinea_COSTO_UNITARIO').val('');
            $('#CAMPO_ACTUALIZA').val('');
            $('#ACTUALIZA').val(0);
            $('#SPAN').val('');
        }
    }
    
    //actualizar una linea
    function actualiza(){
    
        limpiarForm(false);
        
        var  contador = $(this).attr('name');
        
        //values de los campos ocultos de la fila para actualizar
        var articulo = $('#LineaNuevo_'+contador+'_ARTICULO').val();
        var nombrearticulo = $('#LineaNuevo_'+contador+'_NOMBRE_ARTICULO').val();
        var bodega = $('#LineaNuevo_'+contador+'_BODEGA').val();
        var nombrebodega = $('#LineaNuevo_'+contador+'_NOMBRE_BODEGA').val();
        var bodegadestino = $('#LineaNuevo_'+contador+'_BODEGA_DESTINO').val();
        var nombrebodegadestino = $('#LineaNuevo_'+contador+'_NOMBRE_BODEGA_DESTINO').val();
        var cantidad = $('#LineaNuevo_'+contador+'_CANTIDAD').val();
        var tipotransaccion = $('#LineaNuevo_'+contador+'_TIPO_TRANSACCION').val();
        var subtipo = $('#LineaNuevo_'+contador+'_SUBTIPO').val();
        var tipoTransaccionCantidad = $('#LineaNuevo_'+contador+'_TIPO_TRANSACCION_CANTIDAD').val();
        var unidad = $('#LineaNuevo_'+contador+'_UNIDAD').val();
        var costounitario = $('#LineaNuevo_'+contador+'_COSTO_UNITARIO').val();
        
        //asignacion a los campos del formulario para su actualizacion
        $('#DocumentoInvLinea_TIPO_TRANSACCION').val(tipotransaccion);
        $('#DocumentoInvLinea_SUBTIPO').val(subtipo);
        $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').val(tipoTransaccionCantidad);
        $('#DocumentoInvLinea_BODEGA').val(bodega);
        $('#NOMBRE_BODEGA').val(nombrebodega);
        if(tipotransaccion == 'TRAS'){
            $('#DocumentoInvLinea_BODEGA_DESTINO').attr('disabled',false);
            $('#bodega-destino').attr('disabled',false);
        }
        $('#DocumentoInvLinea_BODEGA_DESTINO').val(bodegadestino);
        $('#NOMBRE_BODEGA_DESTINO').val(nombrebodegadestino);
        $('#DocumentoInvLinea_ARTICULO').val(articulo);
        $('#NOMBRE_ARTICULO').val(nombrearticulo);
        $('#DocumentoInvLinea_CANTIDAD').val(cantidad);
        $('#DocumentoInvLinea_UNIDAD').val(unidad);
        $('#DocumentoInvLinea_COSTO_UNITARIO').val(costounitario);
        $('#CAMPO_ACTUALIZA').val(contador);
        $('#ACTUALIZA').val(1);
        $('#SPAN').val('');
        
        $('#nuevo').modal();
        
    
    }
    //actualizar una linea de un documento que se va a modificar
    function actualizaUpdate(){
    
        limpiarForm(false);
        
        var  contador = $(this).attr('name');
        
        //values de los campos ocultos de la fila para actualizar
        var articulo = $('#DocumentoInvLinea_'+contador+'_ARTICULO').val();
        var nombrearticulo = $('#DocumentoInvLinea_'+contador+'_NOMBRE_ARTICULO').val();
        var bodega = $('#DocumentoInvLinea_'+contador+'_BODEGA').val();
        var nombrebodega = $('#DocumentoInvLinea_'+contador+'_NOMBRE_BODEGA').val();
        var bodegadestino = $('#DocumentoInvLinea_'+contador+'_BODEGA_DESTINO').val();
        var nombrebodegadestino = $('#DocumentoInvLinea_'+contador+'_NOMBRE_BODEGA_DESTINO').val();
        var cantidad = $('#DocumentoInvLinea_'+contador+'_CANTIDAD').val();
        var tipotransaccion = $('#DocumentoInvLinea_'+contador+'_TIPO_TRANSACCION').val();
        var subtipo = $('#DocumentoInvLinea_'+contador+'_SUBTIPO').val();
        var tipoTransaccionCantidad = $('#DocumentoInvLinea_'+contador+'_TIPO_TRANSACCION_CANTIDAD').val();
        var unidad = $('#DocumentoInvLinea_'+contador+'_UNIDAD').val();
        var costounitario = $('#DocumentoInvLinea_'+contador+'_COSTO_UNITARIO').val();
        
        //asignacion a los campos del formulario para su actualizacion
        $('#DocumentoInvLinea_TIPO_TRANSACCION').val(tipotransaccion);
        $('#DocumentoInvLinea_SUBTIPO').val(subtipo);
        $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').val(tipoTransaccionCantidad);
        $('#DocumentoInvLinea_BODEGA').val(bodega);
        $('#NOMBRE_BODEGA').val(nombrebodega);
        if(tipotransaccion == 'TRAS'){
            $('#DocumentoInvLinea_BODEGA_DESTINO').attr('disabled',false);
            $('#bodega-destino').attr('disabled',false);
        }
        $('#DocumentoInvLinea_BODEGA_DESTINO').val(bodegadestino);
        $('#NOMBRE_BODEGA_DESTINO').val(nombrebodegadestino);
        $('#DocumentoInvLinea_ARTICULO').val(articulo);
        $('#NOMBRE_ARTICULO').val(nombrearticulo);
        $('#DocumentoInvLinea_CANTIDAD').val(cantidad);
        $('#DocumentoInvLinea_UNIDAD').val(unidad);
        $('#DocumentoInvLinea_COSTO_UNITARIO').val(costounitario);
        $('#CAMPO_ACTUALIZA').val(contador);
        $('#ACTUALIZA').val(1);
        $('#SPAN').val('U');
        
        $('#nuevo').modal();
        
    
    }
    //para el campo oculto tener los id, de los campos que se van a eliminar valido solo para actualizar el documento de inventario
    function eliminaRegistro(){
        
        eliminar();       
       var  idFila = $(this).attr('name');
       var eliminarOculto = $("#eliminar").val()
       var idCampo = $("#DocumentoInvLinea_"+idFila+"_DOCUMENTO_INV_LINEA").val();


        eliminarOculto = eliminarOculto + idCampo +",";
        $("#eliminar").val(eliminarOculto);

    }
    //RESTAURAR SUBTIPOS Y CANTIDADES PARA PODER VISUALIZAR CUANDO ACUALIZAN
    function restaurarCombos(){
        
        $.getJSON('<?php echo $this->createUrl('agregarlinea')?>&restaurarCombos=1',
            function(data){
                
                $.each(data.SUBTIPOS, function(value, name) {
                     $('#DocumentoInvLinea_SUBTIPO').append("<option value='"+value+"'>"+name+"</option>");

                });
                
                $.each(data.CANTIDADES, function(value, name) {
                     $('#DocumentoInvLinea_TIPO_TRANSACCION_CANTIDAD').append("<option value='"+value+"'>"+name+"</option>");
                });
                
            }
        );
        
        
    }
     
</script>
<?php 
    $nombre_bodega = isset($Pnombre_bodega) ? $Pnombre_bodega : '';
    $nombre_bodega_destino = isset($Pnombre_bodega_destino) ? $Pnombre_bodega_destino : '';
    $nombre_articulo = isset($Pnombre_articulo) ? $Pnombre_articulo : '';
    $subtipos = isset($Psubtipos) ? $Psubtipos : array();
    $cantidades = isset($Pcantidades) ? $Pcantidades : array();
    
    $campoActualiza = isset($PcampoActualiza) ? $PcampoActualiza : '';    
    $actualiza = isset($Pactualiza) ? $Pactualiza : 0;    
    
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'documento-inv-linea-form',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                ),
                 'type'=>'horizontal',
     ));
     
     $botonBodega = $this->widget('bootstrap.widgets.BootButton', array(
                        'type'=>'info',
                        'size'=>'mini',
                        'buttonType'=>'button',
                        'icon'=>'search',
                        'htmlOptions'=>array('onclick'=>'$("#bodega").dialog("open");return false;',),
                    ),true);
     $botonBodegaDestino = $this->widget('bootstrap.widgets.BootButton', array(
                        'type'=>'info',
                        'size'=>'mini',
                        'buttonType'=>'button',
                        'icon'=>'search',
                        'htmlOptions'=>array('id'=>'bodega-destino','disabled'=>true,'onclick'=>'$("#bodega_destino").dialog("open");return false;',),
                    ),true);
     $botonArticulo = $this->widget('bootstrap.widgets.BootButton', array(
                        'type'=>'info',
                        'size'=>'mini',
                        'buttonType'=>'button',
                        'icon'=>'search',
                        'htmlOptions'=>array('onclick'=>'$("#articulo").dialog("open");return false;',),
                    ),true);
     
     echo CHtml::hiddenField('documento',$model->DOCUMENTO_INV);
     echo CHtml::hiddenField('consecutivo',isset($_POST['consecutivo']) ? $_POST['consecutivo'] : '');
     
?>

<div class="form">
    <div class="modal-body" >
        
       <?php echo $form->errorSummary($modelLi); ?>


       <table>
             <tr>
                 <td>
                       <div align="left" style="width: 120px;">
                             <?php echo $form->dropDownListRow($modelLi,'TIPO_TRANSACCION',isset($tipo_transaccion) ? $tipo_transaccion : array(),array('empty'=>'Seleccione')); ?>
                       </div>
                </td>
                <td>
                       <div align="left" style="margin-left: -60px;">
                             <?php echo $form->dropDownListRow($modelLi,'SUBTIPO',$model->isNewRecord ? $subtipos : CHtml::listData(SubtipoTransaccion::model()->findAll(),'ID','NOMBRE'),
                                     array(
                                         'empty'=>'Seleccione',
                                         'readonly'=>isset($Vsubtipo) ? false : true,
                                         'options'=>isset($Vsubtipo) ? array($Vsubtipo=>array('selected'=>true)): array() 
                                     )
                                   ); ?>
                       </div>
               </td>
            </tr>
            <tr>
                <td colspan="2">
                       <?php echo $form->dropDownListRow($modelLi,'TIPO_TRANSACCION_CANTIDAD',$model->isNewRecord ? $cantidades : CHtml::listData(TipoCantidadArticulo::model()->findAll(),'ID','NOMBRE'),
                               array(
                                   'empty'=>'Seleccione',
                                   'readonly'=>isset($Vcantidad) ? false : true,
                                   'options'=>isset($Vcantidad) ? array($Vcantidad=>array('selected'=>true)): array()
                               )
                             ); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->textFieldRow($modelLi,'BODEGA',array('size'=>4,'maxlength'=>4)); ?></td> 
                <td>
                    <span style="margin: 0 0 0 -30px"><?php echo CHtml::textField('NOMBRE_BODEGA',$nombre_bodega,array('readonly'=>true))?></span>
                    <span style="margin: 5px 0 0 0"><?php echo $botonBodega ?></span>
                </td> 
            </tr>
            <tr>
                <td><?php echo $form->textFieldRow($modelLi,'BODEGA_DESTINO',array('size'=>4,'maxlength'=>4,'disabled'=>true)); ?></td> 
                <td>
                    <span style="margin: 0 0 0 -30px"><?php echo CHtml::textField('NOMBRE_BODEGA_DESTINO',$nombre_bodega_destino,array('readonly'=>true))?></span>
                    <span style="margin: 5px 0 0 0"><?php echo $botonBodegaDestino ?></span>
                </td>
            </tr>
            <tr>
                <td><?php echo $form->textFieldRow($modelLi,'ARTICULO',array('size'=>4,'maxlength'=>20)); ?></td> 
                <td>
                    <span style="margin: 0 0 0 -30px"><?php echo CHtml::textField('NOMBRE_ARTICULO',$nombre_articulo,array('readonly'=>true))?></span>
                    <span style="margin: 5px 0 0 0"><?php echo $botonArticulo ?></span>
                </td>
            </tr>
            <tr>
                 <td>
                        <div align="left" style="width: 120px;">
                                <?php echo $form->textFieldRow($modelLi,'CANTIDAD',array('size'=>13,'maxlength'=>28)); ?>
                        </div>
                </td>
                <td>
                        <div align="left" style="margin-left: 30px;">
                                <?php echo $form->dropDownList($modelLi,'UNIDAD',CHtml::listData(UnidadMedida::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione')); ?>
                        </div>
                </td>
           </tr>
           <tr>
                 <td colspan="2">
                     <span style="margin-top: -15;"><?php echo $form->textFieldRow($modelLi,'COSTO_UNITARIO',array('maxlength'=>28)); ?></span>
                 </td>
           </tr>

        </table> 
        <?php echo CHtml::hiddenField('CAMPO_ACTUALIZA',$campoActualiza); ?>
        <?php echo CHtml::hiddenField('ACTUALIZA',$actualiza); ?>
        <?php echo CHtml::hiddenField('SPAN',''); ?>
     </div>
    <div class="modal-footer">
                 <?php
                    $this->widget('bootstrap.widgets.BootButton', array(
                         'buttonType'=>'ajaxSubmit',
                         'type'=>'primary',
                         'label'=>'Aceptar',
                         'icon'=>'ok white',
                         'url'=>array('documentoInv/agregarlinea',),
                         'ajaxOptions'=>array(
                             'type'=>'POST',
                             'update'=>'#form-lineas',
                             'beforeSend' => 'cargando()' ,
                          ),
                          'htmlOptions'=>array('id'=>'linea')
                      ));
                ?>
                 <?php
                    $bolean =Yii::app()->request->isAjaxRequest ? false : true;
                    $this->widget('bootstrap.widgets.BootButton', array(
                         'buttonType'=>'button',
                         'type'=>'normal',
                         'label'=>'Cancelar',
                         'icon'=>'remove',
                         'htmlOptions'=>array('onclick'=>'$(".close").click(); limpiarForm('.$bolean.');')
                      ));
                ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
