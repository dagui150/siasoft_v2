<script>
    function cargando(){
        $("#form-lineas").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
    }
    
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
            //$('.add').click();
            contador = $('body').find('.rowIndex').max();
        }else{
            contador = $('#CAMPO_ACTUALIZA').val();
            suma = false;
        }
                
        copiarCampos(contador,model,span,suma);
        
        if(actualiza == 0)
            //add();
                
        $('#alert').remove();
        $('#resetear').click();
        $('#form-cargado').slideDown('slow');
        $('#boton-cargado').remove();
       // limpiarForm(false);
    }
    
    //copiar a campos en la linea despues de creada esta
    function copiarCampos(contador,model,span,suma){
        
        $('.clonar').click();
        var articulo = $('#PedidoLinea_ARTICULO').val();
        var unidad = $('#PedidoLinea_UNIDAD').val();
        var cantidad = $('#PedidoLinea_CANTIDAD').val();
        var precio_unitario = $('#PedidoLinea_PRECIO_UNITARIO').val();
        var porc_descuento = $('#PedidoLinea_PORC_DESCUENTO').val();
        var monto_descuento = $('#PedidoLinea_MONTO_DESCUENTO').val();
        var comentario = $('#PedidoLinea_COMENTARIO').val();
        var descripcion = $('#Articulo_desc').val();
        var estado = 'Normal';
        var linea = $('#CAMPO_ACTUALIZA').val();
        linea = parseInt(linea, 10) + 1;
        
        //copia a spans para visualizar detalles
        if(suma == true)
        $('#linea'+span+'_'+contador).text(parseInt($('#contadorLineas').val(), 10) + 1);
        $('#articulo'+span+'_'+contador).text(articulo);
        //$('#descripcion'+span+'_'+contador).text(nombrearticulo);
        $('#unidad'+span+'_'+contador).text(unidad);
        $('#cantidad'+span+'_'+contador).text(cantidad);
        $('#precio_unitario'+span+'_'+contador).text(precio_unitario);
        $('#porc_descuento'+span+'_'+contador).text(porc_descuento);
        $('#monto_descuento'+span+'_'+contador).text(monto_descuento);
        $('#comentario'+span+'_'+contador).text(comentario);        
        $('#descripcion'+span+'_'+contador).text(descripcion);        
        $('#estado'+span+'_'+contador).text(estado);      
        $('#linea'+span+'_'+contador).text(linea);      
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_UNIDAD').val(unidad);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(precio_unitario);
        $('#'+model+'_'+contador+'_PORC_DESCUENTO').val(porc_descuento);
        $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(monto_descuento);
        $('#'+model+'_'+contador+'_COMENTARIO').val(comentario);    
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion); 
        $('#alert').remove();
        add();
        resetAgregar();
    }
    
    function resetAgregar(){
        $('#Articulo').val('');
        $('#Articulo_desc').val('');
        $('#btn-nuevo').attr('disabled', true);
    }
    
    function add(){
        var cuentaLineas = $('#CAMPO_ACTUALIZA').val();
        cuentaLineas = parseInt(cuentaLineas, 10) + 1;        
        $('#CAMPO_ACTUALIZA').val(cuentaLineas);
    }
</script>
<?php 
    /*$nombre_bodega = isset($Pnombre_bodega) ? $Pnombre_bodega : '';
    $nombre_bodega_destino = isset($Pnombre_bodega_destino) ? $Pnombre_bodega_destino : '';
    $nombre_articulo = isset($Pnombre_articulo) ? $Pnombre_articulo : '';
    $subtipos = isset($Psubtipos) ? $Psubtipos : array();
    $cantidades = isset($Pcantidades) ? $Pcantidades : array();*/
    
    //$campoActualiza = isset($PcampoActualiza) ? $PcampoActualiza : '';    
    /*$actualiza = isset($Pactualiza) ? $Pactualiza : 0;*/
    
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'pedido-linea-form',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                ),
                 'type'=>'horizontal',
     ));        
?>

<div class="form">
    <div class="modal-body" >
        
       <?php echo $form->errorSummary($linea); ?>

            <?php echo $form->textFieldRow($linea,'ARTICULO', array('readonly'=>true)); ?>
            <?php echo $form->textFieldRow($linea,'UNIDAD', array('readonly'=>true)); ?>
            <?php echo $form->textFieldRow($linea,'CANTIDAD'); ?>
            <?php echo $form->textFieldRow($linea,'PRECIO_UNITARIO'); ?>
            <?php echo $form->textFieldRow($linea,'PORC_DESCUENTO'); ?>
            <?php echo $form->textFieldRow($linea,'MONTO_DESCUENTO'); ?>
            <?php echo $form->textAreaRow($linea,'COMENTARIO'); ?>            
            <?php //echo $form->textFieldRow($linea,'PORC_RETENCION'); ?>
            <?php //echo $form->textFieldRow($linea,'MONTO_RETENCION'); ?>
            <?php //echo CHtml::hiddenField('CAMPO_ACTUALIZA',$campoActualiza); ?>
            <?php //echo CHtml::hiddenField('ACTUALIZA',$actualiza); ?>
            <?php echo CHtml::hiddenField('SPAN',''); ?>
     </div>
    <div class="modal-footer">
                 <?php
                    $this->widget('bootstrap.widgets.BootButton', array(
                         'buttonType'=>'ajaxSubmit',
                         'type'=>'primary',
                         'label'=>'Aceptar',
                         'icon'=>'ok white',
                         'url'=>array('agregarlinea',),
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
                         'htmlOptions'=>array('onclick'=>'$(".close").click(); ')
                      ));
                ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->