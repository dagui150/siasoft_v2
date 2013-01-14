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
            model = 'SolicitudOcLinea';
        
        
        $('.close').click();
        
        copiarCampos(contador,model,span);
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
        var unidad = $('#SolicitudOcLinea_UNIDAD').val();
        var unidad_span = $('#SolicitudOcLinea_UNIDAD option:selected').html();       
        var cantidad = $('#SolicitudOcLinea_CANTIDAD').val();
        var comentario = $('#SolicitudOcLinea_COMENTARIO').val();        
        var requerida = $('#SolicitudOcLinea_FECHA_REQUERIDA').val();
        
        //copia a spans para visualizar detalles
        $('#unidad'+span+'_'+contador).text(unidad_span);       
        $('#cantidad'+span+'_'+contador).text(cantidad);
        $('#fecha_requerida'+span+'_'+contador).text(requerida);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_UNIDAD').val(unidad);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_FECHA_REQUERIDA').val(requerida);
        $('#'+model+'_'+contador+'_COMENTARIO').val(comentario);
        $('#alert').remove();
        
        
    }
    
    //limpiar formulario
    function limpiarForm(){        
        $("#SolicitudOcLinea_CANTIDAD").val('');
        $("#SolicitudOcLinea_COMENTARIO").val('');
        $("#SolicitudOcLinea_FECHA_REQUERIDA").val('');
    }
    
    //actualizar una linea
    function actualiza(){    
        limpiarForm();
        var contador = $('#NAME').val();
        var span = $('#SPAN').val();
        if (span == 'U'){
            var model = 'SolicitudOcLinea';
        }
        else{
            var model = 'Nuevo';
        }        
        //values de los campos ocultos de la fila para actualizar        
        var unidad = $('#'+model+'_'+contador+'_UNIDAD').val();
        var requerida = $('#'+model+'_'+contador+'_FECHA_REQUERIDA').val();
        var cantidad = $('#'+model+'_'+contador+'_CANTIDAD').val();
        var comentario = $('#'+model+'_'+contador+'_COMENTARIO').val();        
        
        //asignacion a los campos del formulario para su actualizacion       
        $('#SolicitudOcLinea_UNIDAD').val(unidad);
        $('#SolicitudOcLinea_CANTIDAD').val(cantidad);
        $('#SolicitudOcLinea_FECHA_REQUERIDA').val(requerida);
        $('#SolicitudOcLinea_COMENTARIO').val(comentario);
        $('#CAMPO_ACTUALIZA').val(contador);
        $('#ACTUALIZA').val('0');
        
        $('select[id$=SolicitudOcLinea_UNIDAD] > option').remove();
        $('#'+model+'_'+contador+'_UNIDAD option').clone().appendTo('#SolicitudOcLinea_UNIDAD');
        $('#SolicitudOcLinea_UNIDAD').val($('#'+model+'_'+contador+'_UNIDAD').val());
        
        $('#nuevo').modal();
    }
</script>
<?php 
    $campoActualiza = isset($_POST['CAMPO_ACTUALIZA'])? $_POST['CAMPO_ACTUALIZA'] : '';    
    $span = isset($_POST['SPAN'])? $_POST['SPAN'] : '';
    $actualiza = isset($_POST['ACTUALIZA'])? $_POST['ACTUALIZA'] : '1';
    $unidad = isset($_POST['SolicitudOcLinea']['UNIDAD'])? CHtml::ListData(UnidadMedida::model()->findAll('ID = "'.$_POST['SolicitudOcLinea']['UNIDAD'].'" AND ACTIVO = "S"'),'ID','NOMBRE') : array();
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

            <?php echo $form->textFieldRow($linea,'CANTIDAD', array('size'=>4,)); ?>
            <?php echo $form->dropDownListRow($linea,'UNIDAD', $unidad); ?>
            <?php echo $form->textFieldRow($linea, 'FECHA_REQUERIDA'); ?>          
            <?php echo $form->textAreaRow($linea,'COMENTARIO'); ?>
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