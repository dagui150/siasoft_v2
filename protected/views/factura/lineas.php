<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('calculos.js'), CClientScript::POS_HEAD);
?>
<script>
    $(document).ready(function(){
        
        $('#Factura_UNIDAD').change(function(){
            $.getJSON('<?php echo $this->createUrl('/pedido/cargarUnidad')?>&id='+$(this).val(),
                    function(data){
                         $('#NOMBRE_UNIDAD').val('');
                         $('#NOMBRE_UNIDAD').val(data.NOMBRE);
                 });
        });
        
        $('#agregar').click(function(){
                $('.clonar').click();
                var contador = $('body').find('.rowIndex').max();
                var model ='LineaNuevo';
                var impuesto;
                var tipo_precio = $('#Factura_NIVEL_PRECIO').val();
                
                $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&art='+$('#Factura_ARTICULO').val()+'&tipo='+tipo_precio,
                    function(data){
                         $('#tipo_precio_'+contador).text(data.NOMBRE);
                         $('#precio_unitario_'+contador).text('$ '+data.PRECIO);
                         $('#'+model+'_'+contador+'_PRECIO_UNITARIO').val(data.PRECIO);
                         
                         $('select[id$='+model+'_'+contador+'_TIPO_PRECIO]>option').remove();
                         
                         $.each(data.COMBO, function(value, name) {
                                tipo_precio = data.SELECCION;
                                if(value == tipo_precio)
                                    $('#'+model+'_'+contador+'_TIPO_PRECIO').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                    $('#'+model+'_'+contador+'_TIPO_PRECIO').append("<option value='"+value+"'>"+name+"</option>");
                                    
                                    
                        });
                         
                 });
                 $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+$('#Factura_ARTICULO').val(),
                    function(data){
                         impuesto = data.IMPUESTO;
                         $('select[id$='+model+'_'+contador+'_UNIDAD]>option').remove();
                         
                         $.each(data.UNIDADES, function(value, name) {
                            if(value == $('#Factura_UNIDAD').val())
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                            else
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                        });
                        
                        $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
                        $('#porc_impuesto_'+contador).text(impuesto+" %");
                        $('#'+model+'_'+contador+'_PORC_IMPUESTO').val(impuesto);

                  });
                  agregarCampos(contador,model);
    });
    
    function agregarCampos(contador,model){
        
        var articulo = $('#Factura_ARTICULO').val();
        var descripcion = $('#Articulo_desc').val();
        var cantidad = $('#Factura_CANTIDAD').val(); 
        
        //copia a spans para visualizar detalles
        $('#linea_'+contador).text(parseInt(contador, 10) + 1);
        $('#articulo_'+contador).text(articulo);
        $('#descripcion_'+contador).text(descripcion);
        $('#cantidad_'+contador).text(cantidad);
        
        $('#porc_descuento_'+contador).text(0);
        $('#monto_descuento_'+contador).text(0);
        $('#valor_impuesto_'+contador).text(0);0   
        $('#total_'+contador).text(0);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_PORC_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_MONTO_DESCUENTO').val(0);
        $('#'+model+'_'+contador+'_VALOR_IMPUESTO').val(0);
        $('#'+model+'_'+contador+'_TOTAL').val(0);
        $('#'+model+'_'+contador+'_COMENTARIO').val('');     
  
    }
        
        
    
});



</script>
<table style="margin-left: -100px;">
         <tr>
             <td style="width: 289px">
                <?php echo $form->textFieldRow($model,'ARTICULO',array('size'=>15)); ?>
             </td>
             <td style="width: 28px;">
                 <?php $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#articulo',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal','style'=>'margin-top: 5px;'),
                 )); ?>
            </td>
            <td>
                 <?php echo CHtml::textField('Articulo_desc','',array('disabled'=>true,'size'=>30)); ?>
           </td>
           <td>
               <table style="margin-left: -100px;margin-top:-4px;">
                   <tr>
                       <td>
                            <?php echo $form->dropDownListRow($model,'UNIDAD',array(),array('empty'=>'Seleccione','style'=>'width: 120px;'));?>
                            <?php echo CHtml::hiddenField('NOMBRE_UNIDAD','');?>
                       </td>
                   </tr>
               </table>
           </td>
           <td>
               <table style="margin-left: -100px;margin-top:-4px;">
                   <tr>
                       <td style="width: 289px;">
                            <?php echo $form->textFieldRow($model,'CANTIDAD',array('size'=>4));?>
                       </td>
                       <td>
                           <?php
                                $this->widget('bootstrap.widgets.BootButton', array(
                                            'buttonType'=>'button',
                                            'type'=>'success',
                                            'icon'=>'white plus',
                                            'size'=>'mini',
                                            'htmlOptions'=>array('id'=>'agregar','disabled'=>true,'style'=>'margin-top: 5px;')
                                 ));    
                            ?> 
                       </td>
                   </tr>
               </table>
           </td>
        </tr>
</table>
<table class="templateFrame table table-bordered" cellspacing="0">
          <thead>
               <tr>
                    <td><strong>Línea</strong></td>
                    <td><strong>Artículo</strong></td>
                    <td><strong>Descripción</strong></td>
                    <td><strong>Unidad</strong></td>
                    <td><strong>Cantidad</strong></td>
                    <td><strong>Tipo Precio</strong></td>
                    <td><strong>Precio Unitario</strong></td>  
                    <td><strong>% Desc.</strong></td>
                    <td><strong>% Iva</strong></td>
                    <td><strong>Impuesto</strong></td>
                    <td><strong>Total</strong></td>
                    <td></td>
               </tr>
         </thead>
         <tfoot style="display:none;">
               <tr>
                    <td colspan="15">
                        <div id="add" class="add">
                           <?php 
                                $this->widget('bootstrap.widgets.BootButton', array(
                                                            'buttonType'=>'button',
                                                            'type'=>'success',
                                                            'label'=>'Nuevo',
                                                            'icon'=>'plus white',
                                                            'htmlOptions' => array('class'=>'clonar', 'style'=>'display:none'),
                                                      ));
                           ?>
                        </div>
                           <textarea class="template" rows="0" cols="0" style="display:none;">
                                    <tr class="templateContent">
                                        <td>
                                            <span id='linea_<?php echo '{0}';?>'></span>                                                                        
                                        </td>
                                        <td>
                                            <span id='articulo_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][ARTICULO]',''); ?>
                                        </td>
                                        <td>
                                            <span id='descripcion_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][DESCRIPCION]',''); ?>
                                        </td>
                                        <td>
                                            <span id='unidad_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::dropDownList('LineaNuevo[{0}][UNIDAD]','',array(),array('empty'=>'Seleccione')); ?>
                                        </td>
                                        <td>
                                            <span id='cantidad_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::textField('LineaNuevo[{0}][CANTIDAD]','',array('size'=>4)); ?>                                        
                                        </td>
                                        <td>
                                            <span id='tipo_precio_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::dropDownList('LineaNuevo[{0}][TIPO_PRECIO]','',array(),array('empty'=>'Seleccione')); ?>
                                        </td>
                                        <td>
                                            <span id='precio_unitario_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::textField('LineaNuevo[{0}][PRECIO_UNITARIO]','',array('size'=>10)); ?>                                        
                                        </td>                                    
                                        <td>
                                            <span id='porc_descuento_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::textField('LineaNuevo[{0}][PORC_DESCUENTO]','',array('size'=>4)); ?>    
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][MONTO_DESCUENTO]',''); ?>
                                        </td>
                                        <td>
                                            <span id='porc_impuesto_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][PORC_IMPUESTO]',''); ?>                                        
                                        </td>
                                        <td>
                                            <span id='valor_impuesto_<?php echo '{0}';?>'></span>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][VALOR_IMPUESTO]',''); ?>
                                        </td>
                                        <td>
                                            <span id='total_<?php echo '{0}';?>'></span>      
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][TOTAL]',''); ?>
                                            <?php echo CHtml::hiddenField('LineaNuevo[{0}][COMENTARIO]',''); ?>
                                        </td>                                            
                                        <td width="40px">
                                            <div class="remove" id ="remover"style="float: left; margin-left: 5px;">
                                                   <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'size'=>'mini',
                                                             'icon'=>'minus white',
                                                             'htmlOptions'=>array('onclick'=>'eliminar();','name'=>'{0}')
                                                         ));
                                                   ?>
                                            </div>
                                            <input type="hidden" class="rowIndex" value="{0}" />
                                       </td>
                                    </tr>
                             </textarea>
                      </td>
              </tr>
         </tfoot>
         <tbody class="templateTarget">
              <?php if(!$model->isNewRecord) :?>
                        <?php foreach($modelLinea as $i=>$linea): ?>
                                <tr class="templateContent">
                                    <td>
                                            <?php echo '<span id="lineaU_'.$i.'">'.$linea->LINEA_NUM.'</span>'; ?>
                                   </td>
                                   <td>
                                            <?php echo '<span id="articuloU_'.$i.'">'.$linea->ARTICULO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ARTICULO"); ?>
                                   </td>
                                   <td> 
                                            <?php echo '<span id="descripcionU_'.$i.'">'.$linea->DESCRIPCION.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]DESCRIPCION"); ?>
                                   </td>
                                   <td>
                                            <?php echo '<span id="unidadU_'.$i.'">'.$linea->UNIDAD.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]UNIDAD"); ?>
                                    </td>
                                   <td>
                                            <?php echo '<span id="tipo_precioU_'.$i.'">'.$linea->TIPO_PRECIO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]TIPO_PRECIO"); ?>
                                    </td>
                                    <td>
                                            <?php echo '<span id="precio_unitarioU_'.$i.'">'.$linea->PRECIO_UNITARIO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PRECIO_UNITARIO"); ?>                                        
                                    </td>                                
                                    <td>
                                            <?php echo '<span id="porc_descuentoU_'.$i.'">'.$linea->PORC_DESCUENTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="monto_descuentoU_'.$i.'">'.$linea->MONTO_DESCUENTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="porc_impuestoU_'.$i.'">'.$linea->PORC_IMPUESTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="valor_impuestoU_'.$i.'">'.$linea->VALOR_IMPUESTO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_DESCUENTO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="estadoU_'.$i.'">'.$linea->ESTADO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]ESTADO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="comentarioU_'.$i.'">'.$linea->COMENTARIO.'</span>'; ?>
                                            <?php echo CHtml::activeHiddenField($linea,"[$i]COMENTARIO"); ?>                                        
                                    </td>
                                    <td>
                                            <?php echo '<span id="totalU_'.$i.'">'.$linea->ESTADO.'</span>'; ?>
                                    </td>
                                    <td>                                     
                                           <div class="remove" id ="remover" style="float: left; margin-left: 5px;">
                                                      <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                                     'buttonType'=>'button',
                                                                     'type'=>'danger',
                                                                     'size'=>'mini',
                                                                     'icon'=>'minus white',
                                                                     'htmlOptions'=>array('id'=>'btn-remover','class'=>'eliminaRegistro','name'=>$i,'disabled'=>$model->ESTADO == 'P' ? false : true)

                                                             ));
                                                     ?>
                                           </div>
                                       </td>
                             </tr>
                       <?php  endforeach; ?>
                       <?php echo CHtml::hiddenField('eliminar','' ); ?>
              <?php endif; ?>
        </tbody>
</table>
<?php $model->isNewRecord ? $i=0 : $i++; ?>
<?php echo CHtml::HiddenField('CAMPO_ACTUALIZA', $i); ?>