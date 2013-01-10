<script>
    function cargando(){
        $("#form-lineas").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
    }
    
    //agregar una linea
    function agregar(span){
        var contador = $('#CAMPO_ACTUALIZA').val();
        var span = $('#SPAN').val();        
        var model = 'LineaNuevo';
        var model2 = 'ExistenciaBodegas';
        
        if(span == 'U')
            model = 'ExistenciaBodegas';
        
        
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
        var existencia_minima = $('#ExistenciaBodegas_EXISTENCIA_MINIMA').val();
        
        //copia a spans para visualizar detalles
        $('#existencia_minima'+span+'_'+contador).text(existencia_minima);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_EXISTENCIA_MINIMA').val(existencia_minima);
        $('#alert').remove();
        
    }
    
    //limpiar formulario
    function limpiarForm(){
        //$("#FacturaLinea_UNIDAD").val('');
        $("#ExistenciaBodegas_EXISTENCIA_MINIMA").val('');
        $("#ExistenciaBodegas_EXISTENCIA_MAXIMA").val('');
        $("#ExistenciaBodegas_PUNTO_REORDEN").val('');
        $("#ExistenciaBodegas_MONTO_DESCUENTO").val('');
        $("#ExistenciaBodegas_PORC_IMPUESTO").val('');
        $("#ExistenciaBodegas_VALOR_IMPUESTO").val('');
    }
    
    //actualizar una linea
    function actualiza(){
    
        limpiarForm();
        var contador = $('#NAME').val();
        var span = $('#SPAN').val();
        if (span == 'U'){
            var model = 'ExistenciaBodegas';
        }
        else{
            var model = 'LineaNuevo';
        }
        //values de los campos ocultos de la fila para actualizar
        var articulo = $('#'+model+'_'+contador+'_ARTICULO').val();
        var existencia_minima = $('#'+model+'_'+contador+'_EXISTENCIA_MINIMA').val();      
        
        //asignacion a los campos del formulario para su actualizacion
        $('#ExistenciaBodegas_ARTICULO').val(articulo);

        $('#ExistenciaBodegas_EXISTENCIA_MINIMA').val(0);

        $('#CAMPO_ACTUALIZA').val(contador);
        $('#ACTUALIZA').val('0');
        
        $('#nuevo').modal();
        
    
    }
</script>
<?php 
    $campoActualiza = isset($_POST['CAMPO_ACTUALIZA'])? $_POST['CAMPO_ACTUALIZA'] : '';
    $span = isset($_POST['SPAN'])? $_POST['SPAN'] : '';
    $actualiza = isset($_POST['ACTUALIZA'])? $_POST['ACTUALIZA'] : '1';
    //$tipo_precio = isset($_POST['ExistenciaBodegas']['TIPO_PRECIO']) && isset($_POST['ExistenciaBodegas']['ARTICULO'])? CHtml::ListData(ArticuloPrecio::model()->findAll('ARTICULO = "'.$_POST['ExistenciaBodegas']['ARTICULO'].'" AND ACTIVO = "S"'),'ID','nIVELPRECIO.DESCRIPCION') : array();
    //$unidad = isset($_POST['ExistenciaBodegas']['UNIDAD'])? CHtml::ListData(UnidadMedida::model()->findAll('ID = "'.$_POST['ExistenciaBodegas']['UNIDAD'].'" AND ACTIVO = "S"'),'ID','NOMBRE') : array();
    
    //$campoActualiza = isset($PcampoActualiza) ? $PcampoActualiza : '';    
    //$actualiza = isset($Pactualiza) ? $Pactualiza : 0;
    
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'existencia-bodegas-linea-form',
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
            <?php echo $form->textFieldRow($linea,'EXISTENCIA_MINIMA',array('size'=>4)); ?>
            <?php echo $form->textFieldRow($linea,'EXISTENCIA_MAXIMA',array('size'=>4)); ?>
            <?php echo $form->textFieldRow($linea,'PUNTO_REORDEN',array('size'=>4)); ?>
            <?php echo CHtml::hiddenField('CAMPO_ACTUALIZA',$campoActualiza); ?>
            <?php echo CHtml::hiddenField('ACTUALIZA',$actualiza); ?>
            <?php echo CHtml::hiddenField('SPAN',$span); ?>
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