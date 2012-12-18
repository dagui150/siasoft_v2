<script>
    function cargando(){
        $("#form-lineas").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
    }
    
    //agregar una linea
    function agregar(span){
        var contador,precio,total_resta= new Array() ;
        var actualiza = $('#ACTUALIZA').val();
        var suma = true;
        var model = 'LineaNuevo';
        
        if(span == 'U')
            model = 'FacturaLinea';
        
        $('.close').click();
        
        if(actualiza == 0){
            //$('.add').click();
            contador = $('body').find('.rowIndex').max();
            
        }else{
            contador = $('#CAMPO_ACTUALIZA').val();
            suma = false;            
            //$('#ACTUALIZA').val('0');
        }
                
        copiarCampos(contador,model,span,suma);
        precio = parseInt($('#'+model+'_'+contador+'_PRE-PRECIO').val(), 10);
        total_resta['descuentos'] = (precio * parseInt($('#'+model+'_'+contador+'_PRE-DESCUENTO').val(), 10))/100;
        total_resta['mercaderia'] = parseInt($('#'+model+'_'+contador+'_PRE-CANTIDAD').val(), 10) * precio;
        
        calcularTotal(contador,model,true,total_resta);
        $('#'+model+'_'+contador+'_PRE-PRECIO').val($('#FacturaLinea_PRECIO_UNITARIO').val());
        $('#'+model+'_'+contador+'_PRE-DESCUENTO').val($('#FacturaLinea_PORC_DESCUENTO').val());
        $('#'+model+'_'+contador+'_PRE-CANTIDAD').val($('#FacturaLinea_CANTIDAD').val());
        
        if(actualiza == 0)
            //add();
                
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
        var unidad = $('#FacturaLinea_UNIDAD').val();
        var unidad_span = $('#FacturaLinea_UNIDAD option:selected').html();       
        var cantidad = $('#FacturaLinea_CANTIDAD').val();
        var precio_unitario = $('#FacturaLinea_PRECIO_UNITARIO').val();
        var porc_descuento = $('#FacturaLinea_PORC_DESCUENTO').val();
        var monto_descuento = parseFloat($('#FacturaLinea_MONTO_DESCUENTO').val());
        var porc_impuesto = $('#FacturaLinea_PORC_IMPUESTO').val();
        var valor_impuesto = parseFloat($('#FacturaLinea_VALOR_IMPUESTO').val());
        var comentario = $('#FacturaLinea_COMENTARIO').val();
        var tipo_precio = $('#FacturaLinea_TIPO_PRECIO').val();
        var tipo_precio_span = $('#FacturaLinea_TIPO_PRECIO option:selected').html();
        
        //copia a spans para visualizar detalles
        $('#unidad'+span+'_'+contador).text(unidad_span);
        $('#tipoprecio'+span+'_'+contador).text(tipo_precio_span);
        $('#cantidad'+span+'_'+contador).text(cantidad);
        $('#preciounitario'+span+'_'+contador).text('$ '+precio_unitario);
        $('#porcdescuento'+span+'_'+contador).text(porc_descuento+' %');
        $('#monto_descuento'+span+'_'+contador).text(monto_descuento);
        $('#porc_impuesto'+span+'_'+contador).text(porc_impuesto+' %');
        $('#comentario'+span+'_'+contador).text(comentario);   
        
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
        
        add();
        resetAgregar();
    }
    
    function resetAgregar(){
        $('#Articulo').val('');
        $('#Articulo_desc').val('');
        $('#btn-nuevo').attr('disabled', true);
        $('#ACTUALIZA').val('1');
    }
    
    function add(){
        var cuentaLineas = $('#CAMPO_ACTUALIZA').val();
        cuentaLineas = parseInt(cuentaLineas, 10) + 1;        
        $('#CAMPO_ACTUALIZA').val(cuentaLineas);
    }
    
    //limpiar formulario
    function limpiarForm(){
        //$("#FacturaLinea_UNIDAD").val('');
        $("#FacturaLinea_CANTIDAD").val('');
        $("#FacturaLinea_PRECIO_UNITARIO").val('');
        $("#FacturaLinea_PORC_DESCUENTO").val('');
        $("#FacturaLinea_MONTO_DESCUENTO").val('');
        $("#FacturaLinea_PORC_IMPUESTO").val('');
        $("#FacturaLinea_VALOR_IMPUESTO").val('');
        $("#FacturaLinea_COMENTARIO").val('');
    }
    
    //actualizar una linea
    function actualiza(){
    
        limpiarForm();
        
        var contador = $(this).attr('name');
        var model = 'LineaNuevo';
        
        //values de los campos ocultos de la fila para actualizar
        var articulo = $('#'+model+'_'+contador+'_ARTICULO').val();
        var unidad = $('#'+model+'_'+contador+'_UNIDAD').val();
        var tipo_precio = $('#'+model+'_'+contador+'_TIPO_PRECIO').val();
        var cantidad = $('#'+model+'_'+contador+'_CANTIDAD').val();
        var precio_unitario = $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val();
        var porc_descuento = $('#'+model+'_'+contador+'_PORC_DESCUENTO').val();
        var monto_descuento = $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val();
        var porc_impuesto = $('#'+model+'_'+contador+'_PORC_IMPUESTO').val();
        var valor_impuesto = $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val();
        var comentario = $('#'+model+'_'+contador+'_COMENTARIO').val();        
        
        //asignacion a los campos del formulario para su actualizacion
        $('#FacturaLinea_ARTICULO').val(articulo);
        $('#FacturaLinea_UNIDAD').val(unidad);
        $('#FacturaLinea_CANTIDAD').val(cantidad);
        $('#FacturaLinea_PRECIO_UNITARIO').val(precio_unitario);
        $('#FacturaLinea_PORC_DESCUENTO').val(porc_descuento);
        $('#FacturaLinea_MONTO_DESCUENTO').val(monto_descuento);
        $('#FacturaLinea_PORC_IMPUESTO').val(porc_impuesto);
        $('#FacturaLinea_VALOR_IMPUESTO').val(valor_impuesto);
        $('#FacturaLinea_COMENTARIO').val(comentario);
        $('#FacturaLinea_TIPO_PRECIO').val(tipo_precio);
        $('#CAMPO_ACTUALIZA').val(contador);
        $('#ACTUALIZA').val('0');
        $('select[id$=FacturaLinea_TIPO_PRECIO] > option').remove();
        $('#'+model+'_'+contador+'_TIPO_PRECIO option').clone().appendTo('#FacturaLinea_TIPO_PRECIO');
        $('#FacturaLinea_TIPO_PRECIO').val($('#'+model+'_'+contador+'_TIPO_PRECIO').val());
        
        $('select[id$=FacturaLinea_UNIDAD] > option').remove();
        $('#'+model+'_'+contador+'_UNIDAD option').clone().appendTo('#FacturaLinea_UNIDAD');
        $('#FacturaLinea_UNIDAD').val($('#'+model+'_'+contador+'_UNIDAD').val());
        
        $('#nuevo').modal();
        
    
    }
</script>
<?php 
    /*$nombre_bodega = isset($Pnombre_bodega) ? $Pnombre_bodega : '';
    $nombre_bodega_destino = isset($Pnombre_bodega_destino) ? $Pnombre_bodega_destino : '';
    $nombre_articulo = isset($Pnombre_articulo) ? $Pnombre_articulo : '';
    $subtipos = isset($Psubtipos) ? $Psubtipos : array();
    $cantidades = isset($Pcantidades) ? $Pcantidades : array();*/
    $total = isset($_POST['TOTAL'])? $_POST['TOTAL'] : '';
    $actualiza = isset($_POST['ACTUALIZA'])? $_POST['ACTUALIZA'] : '1';
    $tipo_precio = isset($_POST['FacturaLinea']['TIPO_PRECIO']) && isset($_POST['FacturaLinea']['ARTICULO'])? CHtml::ListData(ArticuloPrecio::model()->findAll('ARTICULO = "'.$_POST['FacturaLinea']['ARTICULO'].'" AND ACTIVO = "S"'),'ID','nIVELPRECIO.DESCRIPCION') : array();
    $unidad = isset($_POST['FacturaLinea']['UNIDAD'])? CHtml::ListData(UnidadMedida::model()->findAll('ID = "'.$_POST['FacturaLinea']['UNIDAD'].'" AND ACTIVO = "S"'),'ID','NOMBRE') : array();
    
    //$campoActualiza = isset($PcampoActualiza) ? $PcampoActualiza : '';    
    //$actualiza = isset($Pactualiza) ? $Pactualiza : 0;
    
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'factura-linea-form',
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
            <?php echo $form->textFieldRow($linea,'CANTIDAD', array('size'=>4,)); ?>
            <?php echo $form->dropDownListRow($linea,'UNIDAD', $unidad); ?>
            <?php echo $form->dropDownListRow($linea, 'TIPO_PRECIO', $tipo_precio); ?>
            <?php echo $form->textFieldRow($linea,'PRECIO_UNITARIO',array('size'=>10,'prepend'=>'$')); ?>
            <?php echo $form->textFieldRow($linea,'PORC_DESCUENTO',array('size'=>4,'append'=>'%')); ?>
            <?php echo $form->hiddenField($linea,'MONTO_DESCUENTO'); ?>
            <?php echo $form->hiddenField($linea,'PORC_IMPUESTO'); ?>
            <?php echo $form->hiddenField($linea,'VALOR_IMPUESTO'); ?>            
            <?php echo $form->textAreaRow($linea,'COMENTARIO'); ?>
            <?php //echo CHtml::hiddenField('CAMPO_ACTUALIZA',$campoActualiza); ?>
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