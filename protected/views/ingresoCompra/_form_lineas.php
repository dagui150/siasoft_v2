<script>
    $(document).ready(inicio);    
    $('.edit').live('click',actualiza);
    
    function inicio(){
        $(".suma").live("change", function (e) {
            
            var total = parseFloat($('#IngresoCompraLinea_CANTIDAD_ORDENADA').val());
            var aceptada = parseFloat($('#IngresoCompraLinea_CANTIDAD_ACEPTADA').val());
            var rechazada = parseFloat($('#IngresoCompraLinea_CANTIDAD_RECHAZADA').val());
            var suma = aceptada + rechazada;            
            
            if (suma > total){
                $("#error").addClass("alert alert-error");
                $("#error").text("La suma entre cantidad aceptada y cantidad rechazada no puede superar la cantidad ordenada");   
                $("#error").fadeIn(1000);    
                $(".modal-footer").fadeOut(1000);
            }
            else{
                $("#error").fadeOut(1000);
                $(".modal-footer").fadeIn(1000);
            }
        });
    }
    
    function cargando(){
            $("#form-lineas").html('<div align="center" style="height: 300px; margin-top: 150px;"><?php echo CHtml::image($ruta);?></div>');
    }
    
    function limpiarForm(){
        
            $('#IngresoCompraLinea_ARTICULO').val('');
            $('#IngresoCompraLinea_UNIDAD_ORDENADA').val('');
            $('#IngresoCompraLinea_BODEGA').val('');
            $('#IngresoCompraLinea_CANTIDAD_ORDENADA').val('');
            $('#IngresoCompraLinea_CANTIDAD_ACEPTADA').val('');
            $('#IngresoCompraLinea_CANTIDAD_RECHAZADA').val('');
            $('#IngresoCompraLinea_PRECIO_UNITARIO').val('');
            $('#IngresoCompraLinea_COSTO_FISCAL_UNITARIO').val('');
            $('#IngresoCompraLinea_ORDEN_COMPRA_LINEA').val('');
            $('#ACTUALIZA').val('');
     }

    function actualiza(){
    
       limpiarForm();
        
        var  contador = $(this).attr('name');
        
        //values de los campos ocultos de la fila para actualizar
        var articulo = $('#LineaNuevo_'+contador+'_ARTICULO').val();
        var unidadOrdenada = $('#LineaNuevo_'+contador+'_UNIDAD_ORDENADA').val();
        var bodega = $('#LineaNuevo_'+contador+'_BODEGA').val();
        var cantidadOrdenada = $('#LineaNuevo_'+contador+'_CANTIDAD_ORDENADA').val();
        var cantidadAceptada = $('#LineaNuevo_'+contador+'_CANTIDAD_ACEPTADA').val();
        var cantidadRechazada = $('#LineaNuevo_'+contador+'_CANTIDAD_RECHAZADA').val();
        var precioUnitario = $('#LineaNuevo_'+contador+'_PRECIO_UNITARIO').val();
        var costoFiscalUnitario = $('#LineaNuevo_'+contador+'_COSTO_FISCAL_UNITARIO').val();
        var ordenCompraLinea = $('#LineaNuevo_'+contador+'_ORDEN_COMPRA_LINEA').val();
        
        //asignacion a los campos del formulario para su actualizacion
        $('#IngresoCompraLinea_ARTICULO').val(articulo);
        $('#IngresoCompraLinea_UNIDAD_ORDENADA').val(unidadOrdenada);
        $('#IngresoCompraLinea_BODEGA').val(bodega);
        $('#IngresoCompraLinea_CANTIDAD_ORDENADA').val(cantidadOrdenada);
        $('#IngresoCompraLinea_CANTIDAD_ACEPTADA').val(cantidadAceptada);
        $('#IngresoCompraLinea_CANTIDAD_RECHAZADA').val(cantidadRechazada);
        $('#IngresoCompraLinea_PRECIO_UNITARIO').val(precioUnitario);
        $('#IngresoCompraLinea_COSTO_FISCAL_UNITARIO').val(costoFiscalUnitario);
        $('#IngresoCompraLinea_ORDEN_COMPRA_LINEA').val(ordenCompraLinea);
        $('#ACTUALIZA').val(contador);
        
        $('#actualizarLinea').modal();
    }
    
     //agregar una linea
     function agregar(span){
        var contador = $('#ACTUALIZA').val();
        var model = 'LineaNuevo';
        
        if(span == 'U')
            model = 'DocumentoInvLinea';
        
        $('.close').click();   
        copiarCampos(contador,model,span);
                
        $('#alert').remove();
        $('#form-cargado').slideDown('slow');
        $('#boton-cargado').remove();
        limpiarForm();
    }
    
    function copiarCampos(contador,model,span){
                
        var bodega = $('#IngresoCompraLinea_BODEGA').val();
        
        var bodegaNombre= $('[value="'+bodega+'"]').text();
        var cantidadAceptada = $('#IngresoCompraLinea_CANTIDAD_ACEPTADA').val();
        var cantidadRechazada = $('#IngresoCompraLinea_CANTIDAD_RECHAZADA').val();
        
        //copia a spans para visualizar detalles
        $('#bodega'+span+'_'+contador).text(bodega + ' - ' + bodegaNombre);
        $('#cantidad_aceptada'+span+'_'+contador).text(cantidadAceptada);
        $('#cantidad_rechazada'+span+'_'+contador).text(cantidadRechazada);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_BODEGA').val(bodega);
        $('#'+model+'_'+contador+'_CANTIDAD_ACEPTADA').val(cantidadAceptada);
        $('#'+model+'_'+contador+'_CANTIDAD_RECHAZADA').val(cantidadRechazada);  
    }
</script>
<?php 
      $actualiza = isset($Pactualiza) ? $Pactualiza : '';

      $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ingreso-compra-linea-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

<div class="form">
    <div class="modal-body" >    
        <div id="error"></div>
	<?php echo $form->errorSummary($linea); ?>
        
                <?php echo $form->dropDownListRow($linea,'BODEGA',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION')); ?>
        	<?php echo $form->textFieldRow($linea,'CANTIDAD_ACEPTADA',array('size'=>10,'maxlength'=>28, 'class'=>'suma')); ?>
		<?php echo $form->textFieldRow($linea,'CANTIDAD_RECHAZADA',array('size'=>10,'maxlength'=>28, 'class'=>'suma')); ?>
                <p style="border-bottom: dashed 2px #060; color: #060;" align="center"><b>Información.</b></p>
                <?php echo $form->textFieldRow($linea,'ARTICULO',array('size'=>10,'readonly'=>true)); ?>
		<?php echo $form->textFieldRow($linea,'CANTIDAD_ORDENADA',array('size'=>10,'readonly'=>true)); ?>
		<?php echo $form->textFieldRow($linea,'UNIDAD_ORDENADA', array('readonly'=>true, 'size'=>15)); ?>
		<?php echo $form->textFieldRow($linea,'PRECIO_UNITARIO',array('size'=>10,'maxlength'=>28, 'readonly'=>true)); ?>
                <?php echo $form->textFieldRow($linea,'ORDEN_COMPRA_LINEA', array('readonly'=>true, 'size'=>10)); ?>
		<?php echo $form->textFieldRow($linea,'COSTO_FISCAL_UNITARIO',array('size'=>10,'maxlength'=>28, 'readonly'=>true)); ?>
                <?php echo CHtml::hiddenField('ACTUALIZA',$actualiza); ?>
                <?php echo CHtml::hiddenField('SPAN',''); ?>
        
     </div> <!-- fin modal body-->
    
	<div class="modal-footer">
		<?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                         'buttonType'=>'ajaxSubmit',
                         'type'=>'primary',
                         'label'=>'Aceptar',
                         'icon'=>'ok white',
                         'url'=>array('actlinea'),
                         'ajaxOptions'=>array(
                             'type'=>'POST',
                             'update'=>'#form-lineas',
                             'beforeSend' => 'cargando()' ,
                          ),
                          'htmlOptions'=>array('id'=>'linea')
                      ));
                ?>
                 <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                         'buttonType'=>'button',
                         'type'=>'normal',
                         'label'=>'Cancelar',
                         'icon'=>'remove',
                         'htmlOptions'=>array('onclick'=>'$(".close").click();')
                      ));
                ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->