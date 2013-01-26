<script>
    function cargando(){
        $("#form-lineas").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
    }
    
    //agregar una linea
    function agregar(span){
        var contador = $('#CAMPO_ACTUALIZA').val();
        var span = $('#SPAN').val();        
        var model = 'LineaNuevo';
        var model2 = 'PedidoLinea';
        
        if(span == 'U')
            model = 'PedidoLinea';
        
        
        $('.close').click();
        
        copiarCampos(contador,model,span);
        
        calcularTotal(contador,model, model2);
                        
        $('#alert').remove();
        $('#resetear').click();
        $('#form-cargado').slideDown('slow');
        $('#boton-cargado').remove();
       // limpiarForm(false);
    }
    
    //copiar a campos en la linea despues de creada esta
    function copiarCampos(contador,model,span){
        
        if($('#ACTUALIZA').val() != 0){
            $('.clonar').click();
        }
        var unidad = $('#PedidoLinea_UNIDAD').val();
        var unidad_span = $('#PedidoLinea_UNIDAD option:selected').html();       
        var cantidad = $('#PedidoLinea_CANTIDAD').val();
        var precio_unitario = $('#PedidoLinea_PRECIO_UNITARIO').val();
        var porc_descuento = $('#PedidoLinea_PORC_DESCUENTO').val();
        //volver a calcular el monto descuento        
        var total = parseInt(precio_unitario, 10) * parseInt(cantidad, 10);
        var descuento = (total * parseInt(porc_descuento, 10))/100;
        var monto_descuento = descuento
        
        var porc_impuesto = $('#PedidoLinea_PORC_IMPUESTO').val();
        var valor_impuesto = parseFloat($('#PedidoLinea_VALOR_IMPUESTO').val());
        var comentario = $('#PedidoLinea_COMENTARIO').val();
        var tipo_precio = $('#PedidoLinea_TIPO_PRECIO').val();
        var tipo_precio_span = $('#PedidoLinea_TIPO_PRECIO option:selected').html();
        
        //copia a spans para visualizar detalles
        $('#unidad'+span+'_'+contador).text(unidad_span);
        $('#tipoprecio'+span+'_'+contador).text(tipo_precio_span);
        $('#cantidad'+span+'_'+contador).text(cantidad);
        $('#preciounitario'+span+'_'+contador).text(precio_unitario);
        $('#porcdescuento'+span+'_'+contador).text(porc_descuento);
        $('#porc_impuesto'+span+'_'+contador).text(porc_impuesto); 
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_UNIDAD').val(unidad);
        $('#'+model+'_'+contador+'_TIPO_PRECIO').val(tipo_precio);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(precio_unitario);
        $('#'+model+'_'+contador+'_PORC_DESCUENTO').val(porc_descuento);
        $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(monto_descuento);
        $('#'+model+'_'+contador+'_PORC_IMPUESTO').val(porc_impuesto);
        $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(valor_impuesto);
        $('#'+model+'_'+contador+'_COMENTARIO').val(comentario);
        $('#alert').remove();
        
    }
    
    //limpiar formulario
    function limpiarForm(){
        //$("#FacturaLinea_UNIDAD").val('');
        $("#PedidoLinea_CANTIDAD").val('');
        $("#PedidoLinea_PRECIO_UNITARIO").val('');
        $("#PedidoLinea_PORC_DESCUENTO").val('');
        $("#PedidoLinea_MONTO_DESCUENTO").val('');
        $("#PedidoLinea_PORC_IMPUESTO").val('');
        $("#PedidoLinea_VALOR_IMPUESTO").val('');
        $("#PedidoLinea_COMENTARIO").val('');
    }
    
    //actualizar una linea
    function actualiza(){
    
        limpiarForm();
        var contador = $('#NAME').val();
        var span = $('#SPAN').val();
        if (span == 'U'){
            var model = 'OrdenCompraLinea';
        }
        else{
            var model = 'Nuevo';
        }
        
        //values de los campos ocultos de la fila para actualizar
        var articulo = $('#'+model+'_'+contador+'_ARTICULO').val();
        var unidad = $('#'+model+'_'+contador+'_UNIDAD').val();
        var cantidad = $('#'+model+'_'+contador+'_CANTIDAD').val();
        var precio_unitario = $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val();
        var porc_descuento = $('#'+model+'_'+contador+'_PORC_DESCUENTO').val();
        var monto_descuento = $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val();
        var porc_impuesto = $('#'+model+'_'+contador+'_PORC_IMPUESTO').val();
        var valor_impuesto = $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val();
        var observacion = $('#'+model+'_'+contador+'_OBSERVACION').val();  
        //asignacion a los campos del formulario para su actualizacion
        $('#OrdenCompraLinea_ARTICULO').val(articulo);
        $('#OrdenCompraLinea_UNIDAD').val(unidad);
        $('#OrdenCompraLinea_CANTIDAD').val(cantidad);
        $('#OrdenCompraLinea_PRECIO_UNITARIO').val(precio_unitario);
        $('#OrdenCompraLinea_PORC_DESCUENTO').val(porc_descuento);
        $('#OrdenCompraLinea_MONTO_DESCUENTO').val(monto_descuento);
        $('#OrdenCompraLinea_PORC_IMPUESTO').val(porc_impuesto);
        $('#OrdenCompraLinea_VALOR_IMPUESTO').val(valor_impuesto);
        $('#OrdenCompraLinea_OBSERVACION').val(observacion);
        $('#CAMPO_ACTUALIZA').val(contador);
        $('#ACTUALIZA').val('0');
        $('select[id$=OrdenCompraLinea_BODEGA] > option').remove();
        $('#'+model+'_'+contador+'_BODEGA option').clone().appendTo('#OrdenCompraLinea_BODEGA');
        $('#OrdenCompraLinea_BODEGA').val($('#'+model+'_'+contador+'_BODEGA').val());
        
        $('select[id$=OrdenCompraLinea_UNIDAD] > option').remove();
        $('#'+model+'_'+contador+'_UNIDAD option').clone().appendTo('#OrdenCompraLinea_UNIDAD');
        $('#OrdenCompraLinea_UNIDAD').val($('#'+model+'_'+contador+'_UNIDAD').val());
        
        $('#nuevo').modal();
    }
</script>
<?php 
    $campoActualiza = isset($_POST['CAMPO_ACTUALIZA'])? $_POST['CAMPO_ACTUALIZA'] : '';
    $total = isset($_POST['TOTAL'])? $_POST['TOTAL'] : '';
    $span = isset($_POST['SPAN'])? $_POST['SPAN'] : '';
    $actualiza = isset($_POST['ACTUALIZA'])? $_POST['ACTUALIZA'] : '1';
    $tipo_precio = isset($_POST['OrdenCompraLinea']['TIPO_PRECIO']) && isset($_POST['PedidoLinea']['ARTICULO'])? CHtml::ListData(ArticuloPrecio::model()->findAll('ARTICULO = "'.$_POST['PedidoLinea']['ARTICULO'].'" AND ACTIVO = "S"'),'ID','nIVELPRECIO.DESCRIPCION') : array();
    $unidad = isset($_POST['OrdenCompraLinea']['UNIDAD'])? CHtml::ListData(UnidadMedida::model()->findAll('ID = "'.$_POST['OrdenCompraLinea']['UNIDAD'].'" AND ACTIVO = "S"'),'ID','NOMBRE') : array();
    $bodega = isset($_POST['OrdenCompraLinea']['BODEGA'])? CHtml::ListData(Bodega::model()->findAll('ID = "'.$_POST['OrdenCompraLinea']['BODEGA'].'" AND ACTIVO = "S"'),'ID','DESCRIPCION') : array();
    
    //$campoActualiza = isset($PcampoActualiza) ? $PcampoActualiza : '';    
    //$actualiza = isset($Pactualiza) ? $Pactualiza : 0;
    
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
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

            <?php echo $form->hiddenField($linea,'ARTICULO'); ?>
            <?php echo $form->textFieldRow($linea,'CANTIDAD_ORDENADA', array('size'=>4,'class'=>'decimal')); ?>
            <?php echo $form->dropDownListRow($linea,'UNIDAD_COMPRA', $unidad); ?>
            <?php echo $form->textFieldRow($linea,'PRECIO_UNITARIO',array('size'=>10,'prepend'=>'$','class'=>'decimal')); ?>
            <?php echo $form->textFieldRow($linea,'PORC_DESCUENTO',array('size'=>4,'append'=>'%','class'=>'decimal')); ?>
            <?php echo $form->hiddenField($linea,'MONTO_DESCUENTO',array('class'=>'decimal')); ?>
            <?php echo $form->hiddenField($linea,'PORC_IMPUESTO',array('class'=>'decimal')); ?>
            <?php echo $form->hiddenField($linea,'VALOR_IMPUESTO',array('class'=>'decimal')); ?>            
            <?php echo $form->dropDownListRow($linea,'BODEGA',$bodega); ?>            
            <?php echo $form->textAreaRow($linea,'OBSERVACION'); ?>
            <?php echo $form->textFieldRow($linea,'CANTIDAD_RECIBIDA'); ?>
            <?php echo $form->textFieldRow($linea,'CANTIDAD_RECHAZADA'); ?>
            <?php echo CHtml::hiddenField('CAMPO_ACTUALIZA',$campoActualiza); ?>
            <?php echo CHtml::hiddenField('ACTUALIZA',$actualiza); ?>
            <?php echo CHtml::hiddenField('SPAN',$span); ?>
     </div>
    <div class="modal-footer">
                 <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
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
                    $this->widget('bootstrap.widgets.TbButton', array(
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