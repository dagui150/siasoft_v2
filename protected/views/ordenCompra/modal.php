<script>
    function cargando(){
        $("#form-lineas").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
    }
    
    //agregar una linea
    function agregar(span){
        var contador = $('#CAMPO_ACTUALIZA').val();
        var span = $('#SPAN').val();        
        var model = 'Nuevo';        
        
        if(span == 'U')
            model = 'OrdenCompraLinea';
        $('.close').click();
        
        copiarCampos(contador,model,span);        
        calcularLinea(model,contador,span);
        
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
        var unidad = $('#OrdenCompraLinea_UNIDAD_COMPRA').val();
        var unidad_span = $('#OrdenCompraLinea_UNIDAD_COMPRA option:selected').html();       
        var cantidad = $('#OrdenCompraLinea_CANTIDAD_ORDENADA').val();
        var precio_unitario = $('#OrdenCompraLinea_PRECIO_UNITARIO').val();
        var porc_descuento = $('#OrdenCompraLinea_PORC_DESCUENTO').val();
        var requerida = $('#OrdenCompraLinea_FECHA_REQUERIDA').val();        
        var porc_impuesto = $('#OrdenCompraLinea_PORC_IMPUESTO').val();
        var valor_impuesto = parseFloat($('#OrdenCompraLinea_VALOR_IMPUESTO').val());
        var observacion = $('#OrdenCompraLinea_OBSERVACION').val();
        var bodega = $('#OrdenCompraLinea_BODEGA').val();
        //var bodega_span = $('#PedidoLinea_BODEGA option:selected').html();
                
        //copia a spans para visualizar detalles
        $('#unidad'+span+'_'+contador).text(unidad_span);
        $('#cantidad'+span+'_'+contador).text(cantidad);
        $('#preciounitario'+span+'_'+contador).text(precio_unitario);
        $('#requerida'+span+'_'+contador).text(requerida);
        $('#descuento'+span+'_'+contador).text(porc_descuento);
        $('#impuesto'+span+'_'+contador).text(porc_impuesto);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_UNIDAD_COMPRA').val(unidad);
        $('#'+model+'_'+contador+'_BODEGA').val(bodega);
        $('#'+model+'_'+contador+'_CANTIDAD_ORDENADA').val(cantidad);
        $('#'+model+'_'+contador+'_FECHA_REQUERIDA').val(requerida);
        $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(precio_unitario);
        $('#'+model+'_'+contador+'_PORC_DESCUENTO').val(porc_descuento);        
        $('#'+model+'_'+contador+'_PORC_IMPUESTO').val(porc_impuesto);
        $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(valor_impuesto);
        $('#'+model+'_'+contador+'_OBSERVACION').val(observacion);
        $('#alert').remove();        
        calcularLinea(model, contador, span);
    }
    
    //limpiar formulario
    function limpiarForm(){
        $("#OrdenCompraLinea_UNIDAD_COMPRA").val('');
        $("#OrdenCompraLinea_CANTIDAD_ORDENADA").val('');
        $("#OrdenCompraLinea_PRECIO_UNITARIO").val('');
        $("#OrdenCompraLinea_PORC_DESCUENTO").val('');
        $("#OrdenCompraLinea_PORC_IMPUESTO").val('');
        $("#OrdenCompraLinea_FECHA_REQUERIDA").val('');
        $("#OrdenCompraLinea_BODEGA").val('');
        $("#OrdenCompraLinea_OBSERVACION").val('');
        $("#OrdenCompraLinea_CANTIDAD_RECIBIDA").val('');
        $("#OrdenCompraLinea_CANTIDAD_RECHAZADA").val('');
        
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
        //var articulo = $('#'+model+'_'+contador+'_ARTICULO').val();
        var cantidad = $('#'+model+'_'+contador+'_CANTIDAD_ORDENADA').val();
        var precio_unitario = $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val();
        var requerida = $('#'+model+'_'+contador+'_FECHA_REQUERIDA').val();       
        var porc_descuento = $('#'+model+'_'+contador+'_PORC_DESCUENTO').val();
        var porc_impuesto = $('#'+model+'_'+contador+'_PORC_IMPUESTO').val();
        var observacion = $('#'+model+'_'+contador+'_OBSERVACION').val(); 
        var recibida = $('#'+model+'_'+contador+'_CANTIDAD_RECIBIDA').val(); 
        var rechazada = $('#'+model+'_'+contador+'_CANTIDAD_RECHAZADA').val(); 
        //asignacion a los campos del formulario para su actualizacion
        $('#OrdenCompraLinea_CANTIDAD_ORDENADA').val(cantidad);
        $('#OrdenCompraLinea_PRECIO_UNITARIO').val(precio_unitario);
        $('#OrdenCompraLinea_FECHA_REQUERIDA').val(requerida);
        $('#OrdenCompraLinea_PORC_DESCUENTO').val(porc_descuento);
        $('#OrdenCompraLinea_PORC_IMPUESTO').val(porc_impuesto);
        $('#OrdenCompraLinea_OBSERVACION').val(observacion);
        $('#OrdenCompraLinea_CANTIDAD_RECIBIDA').val(recibida);
        $('#OrdenCompraLinea_CANTIDAD_RECHAZADA').val(rechazada);
        $('#CAMPO_ACTUALIZA').val(contador);
        $('#ACTUALIZA').val('0');
        $('select[id$=OrdenCompraLinea_BODEGA] > option').remove();
        $('#'+model+'_'+contador+'_BODEGA option').clone().appendTo('#OrdenCompraLinea_BODEGA');
        $('#OrdenCompraLinea_BODEGA').val($('#'+model+'_'+contador+'_BODEGA').val());
        
        $('select[id$=OrdenCompraLinea_UNIDAD_COMPRA] > option').remove();
        $('#'+model+'_'+contador+'_UNIDAD_COMPRA option').clone().appendTo('#OrdenCompraLinea_UNIDAD_COMPRA');
        $('#OrdenCompraLinea_UNIDAD_COMPRA').val($('#'+model+'_'+contador+'_UNIDAD_COMPRA').val());
        
        $('#nuevo').modal();
    }
</script>
<?php 
    $campoActualiza = isset($_POST['CAMPO_ACTUALIZA'])? $_POST['CAMPO_ACTUALIZA'] : '';
    $total = isset($_POST['TOTAL'])? $_POST['TOTAL'] : '';
    $span = isset($_POST['SPAN'])? $_POST['SPAN'] : '';
    $actualiza = isset($_POST['ACTUALIZA'])? $_POST['ACTUALIZA'] : '1';
    $tipo_precio = isset($_POST['OrdenCompraLinea']['TIPO_PRECIO']) && isset($_POST['PedidoLinea']['ARTICULO'])? CHtml::ListData(ArticuloPrecio::model()->findAll('ARTICULO = "'.$_POST['PedidoLinea']['ARTICULO'].'" AND ACTIVO = "S"'),'ID','nIVELPRECIO.DESCRIPCION') : array();
    $unidad = isset($_POST['OrdenCompraLinea']['UNIDAD_COMPRA'])? CHtml::ListData(UnidadMedida::model()->findAll('ID = "'.$_POST['OrdenCompraLinea']['UNIDAD_COMPRA'].'" AND ACTIVO = "S"'),'ID','NOMBRE') : array();
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
            
            <?php echo $form->textFieldRow($linea,'CANTIDAD_ORDENADA', array('size'=>4,'class'=>'decimal')); ?>
            <?php echo $form->dropDownListRow($linea,'UNIDAD_COMPRA', $unidad); ?>
            <?php echo $form->textFieldRow($linea,'PRECIO_UNITARIO',array('size'=>10,'prepend'=>'$','class'=>'decimal')); ?>
            <?php echo $form->textFieldRow($linea,'PORC_DESCUENTO',array('size'=>4,'append'=>'%','class'=>'decimal')); ?>
            <?php echo $form->textFieldRow($linea,'PORC_IMPUESTO',array('class'=>'decimal', 'size'=>4,'append'=>'%')); ?>          
            <?php echo $form->dropDownListRow($linea,'BODEGA',$bodega); ?> 
            <?php echo $form->textFieldRow($linea, 'FECHA_REQUERIDA'); ?> 
            <?php echo $form->textAreaRow($linea,'OBSERVACION'); ?>
            <?php echo $form->textFieldRow($linea,'CANTIDAD_RECIBIDA', array('readonly' => true, 'size' => 3)); ?>
            <?php echo $form->textFieldRow($linea,'CANTIDAD_RECHAZADA', array ('readonly' => true, 'size'=>3)); ?>
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