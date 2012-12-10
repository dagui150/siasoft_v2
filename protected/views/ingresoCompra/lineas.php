<script>
    function obtenerSeleccion(grid_id){
        var idcategoria = $.fn.yiiGridView.getSelection(grid_id);
        $('#check').val(idcategoria);
    }
    
    function cargaSolicitud (){
        $('#over').css('display', 'block');
        var myString = $('#check').val();
        var myArray = myString.split(',');
        var a;
        var i;
        
        if($('#contador').val() != 0){
           a = $('body').find('.rowIndex').max();
           a++;
        }
        else{
            a = $('#contador').val();
        }
        for(var i=0;i<myArray.length;i++){
            $('#nuevo').click();
            //$("#OrdenCompraLinea_" + i + "_ID_SOLICITUD_LINEA").val(myArray[i]);
            $.getJSON(
                '<?php echo $this->createUrl('ingresoCompra/CargarLineas'); ?>&seleccion='+myArray[i],
                function(data){
                    i = a + 1;
                    //span
                    $('#articulo_' + a).text(data.ARTICULO + ' - ' + data.DESCRIPCION);
                    $('#unidad_ordenada_' + a).text(data.UNIDAD_ORDENADA + ' - ' + data.UNIDAD_ORDENADA_NOMBRE);
                    $('#bodega_' + a).text(data.BODEGA + ' - ' + data.BODEGA_NOMBRE);
                    $('#cantidad_ordenada_' + a).text(data.CANTIDAD_ORDENADA);
                    $('#cantidad_aceptada_' + a).text(data.CANTIDAD_ORDENADA);               
                    $('#precio_unitario_' + a).text(data.PRECIO_UNITARIO);   
                    $('#costo_fiscal_unitario_' + a).text(data.COSTO_FISCAL_UNITARIO); 
                    $('#linea_num_' + a).text(parseInt(i));
                    $('#orden_compra_linea_' + a).text(data.ID); 
                    
                    //input
                    $('#LineaNuevo_' + a + '_ARTICULO').val(data.ARTICULO);
                    $('#LineaNuevo_' + a + '_UNIDAD_ORDENADA').val(data.UNIDAD_ORDENADA);
                    $('#LineaNuevo_' + a + '_BODEGA').val(data.BODEGA);
                    $('#LineaNuevo_' + a + '_CANTIDAD_ORDENADA').val(data.CANTIDAD_ORDENADA);
                    $('#LineaNuevo_' + a + '_CANTIDAD_ACEPTADA').val(data.CANTIDAD_ORDENADA);               
                    $('#LineaNuevo_' + a + '_PRECIO_UNITARIO').val(data.PRECIO_UNITARIO);   
                    $('#LineaNuevo_' + a + '_COSTO_FISCAL_UNITARIO').val(data.COSTO_FISCAL_UNITARIO);                
                    $('#LineaNuevo_' + a + '_LINEA_NUM').val(parseInt(i));                
                    $('#LineaNuevo_' + a + '_ORDEN_COMPRA_LINEA').val(data.ID);                
                    a++;
                    $('#contador').val(a);
                }
            )
        }
    }
</script>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'type'=>'',
    'size'=>'mini',
    'url'=>'#lineas',
    'label' => 'Cargar Lineas',
    'icon'=>'icon-download-alt',
    'htmlOptions'=>array('data-toggle'=>'modal', 'id'=>"cargar"),
)); ?>
<p>&nbsp;</p>
<?php

    // lineas para playground
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);

?>
     <div id="over" style="overflow-x: scroll; width: 850px; margin-bottom: 10px; display: none;">
         <div style="width: 1470px;">
                        <table class="templateFrame grid table table-bordered" cellspacing="0">
                            <thead class="templateHead">
                                <tr>
                                    <td width="100px" align="center"><strong>Numero Linea</strong></td>
                                    <td width="300px" align="center"><strong>Articulo</strong></td>
                                    <td width="200px" align="center"><strong>Unidad Ordenada</strong></td>
                                    <td width="200px" align="center"><strong>Bodega</strong></td> 
                                    <td width="100px" align="center"><strong>Cantidad Ordenada</strong></td>
                                    <td width="100px" align="center"><strong>Cantidad Aceptada</strong></td>                                    
                                    <td width="100px" align="center"><strong>Cantidad Rechazada</strong></td>                                    
                                    <td width="100px" align="center"><strong>Precio Unitario</strong></td>
                                    <td width="100px" align="center"><strong>Costo Fiscal Unitario</strong></td>                                    
                                    <td width="100px" align="center"><strong>Orden Compra</strong></td>
                                    <td width="100px">&nbsp;</td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                <td colspan="11">
                      <span class="add" id="nuevo" ></span>
                       <?php 
                            $contador = '0';
                             $this->widget('bootstrap.widgets.BootButton', array(
                                        'buttonType'=>'button',
                                        'type'=>'success',
                                        'label'=>'Nuevo',
                                         'icon'=>'plus white',
                                        'htmlOptions'=>array('id'=>'btn-nuevo','name'=>'','onclick'=>'limpiarForm();', 'style'=>'display:none;')
                             ));
                             
                             echo CHtml::hiddenField('contador',$contador);
                             echo CHtml::hiddenField('contadorLineas',$contador);
                       ?>
                       <textarea class="template" rows="0" cols="0" style="display:none;">
                                <tr class="templateContent">
                                    <td>
                                        <span id='linea_num_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][LINEA_NUM]',''); ?>
                                    </td>
                                    <td>
                                        <span id='articulo_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][ARTICULO]',''); ?>
                                    </td>
                                    <td>
                                        <span id='unidad_ordenada_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][UNIDAD_ORDENADA]',''); ?>
                                    </td>
                                    <td>
                                        <span id='bodega_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][BODEGA]',''); ?>
                                    </td>
                                    <td>
                                        <span id='cantidad_ordenada_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][CANTIDAD_ORDENADA]',''); ?>
                                    </td>
                                    <td>
                                        <span id='cantidad_aceptada_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][CANTIDAD_ACEPTADA]',''); ?>
                                    </td>
                                    <td>
                                        <span id='cantidad_rechazada_<?php echo '{0}';?>'>0</span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][CANTIDAD_RECHAZADA]','0'); ?>
                                    </td>
                                    <td>
                                        <span id='precio_unitario_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][PRECIO_UNITARIO]',''); ?>
                                    </td>
                                    <td>
                                        <span id='costo_fiscal_unitario_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][COSTO_FISCAL_UNITARIO]',''); ?>
                                    </td>                                    
                                    <td>
                                        <span id='orden_compra_linea_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][ORDEN_COMPRA_LINEA]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][ACTIVO]','S'); ?>
                                    </td>
                                    <td>
                                        <span style="float: left">
                                            <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'normal',
                                                             'size'=>'mini',
                                                             'icon'=>'pencil',
                                                             'htmlOptions'=>array('class'=>'edit','name'=>'{0}',  )
                                                         ));
                                            ?>
                                        </span>
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
                                        <?php echo '<span id="linea_numU_'.$i.'">'.$linea->LINEA_NUM.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]LINEA_NUM"); ?>                                        
                                </td>
                                <td width="200px">
                                        <?php echo '<span id="articuloU_'.$i.'">'.$linea->ARTICULO.' - '.Articulo::darNombre($linea->ARTICULO).'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]ARTICULO"); ?>
                               </td>
                               <td> 
                                        <?php echo '<span id="unidad_ordenadaU_'.$i.'">'.$linea->UNIDAD_ORDENADA.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]UNIDAD_ORDENADA"); ?>
                               </td>
                               <td>
                                        <?php echo '<span id="bodegaU_'.$i.'">'.$linea->BODEGA.' - '.Bodega::darDescripcion($linea->BODEGA).'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]BODEGA"); ?>
                                </td>
                                <td>
                                        <?php echo '<span id="cantidad_ordenadaU_'.$i.'">'.$linea->CANTIDAD_ORDENADA.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]CANTIDAD_ORDENADA"); ?>                                        
                                </td>
                                <td>
                                        <?php echo '<span id="cantidad_aceptadaU_'.$i.'">'.$linea->CANTIDAD_ACEPTADA.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]CANTIDAD_ACEPTADA"); ?>                                        
                                </td>
                                <td>
                                        <?php echo '<span id="cantidad_rechazadaU_'.$i.'">'.$linea->CANTIDAD_RECHAZADA.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]CANTIDAD_RECHAZADA"); ?>                                        
                                </td>
                                <td>
                                        <?php echo '<span id="precio_unitarioU_'.$i.'">'.$linea->PRECIO_UNITARIO.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]PRECIO_UNITARIO"); ?>                                        
                                </td>
                                <td>
                                        <?php echo '<span id="costo_fiscal_unitarioU_'.$i.'">'.$linea->COSTO_FISCAL_UNITARIO.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]COSTO_FISCAL_UNITARIO"); ?>                                        
                                </td>                                
                                <td>
                                        <?php echo '<span id="orden_compra_lineaU_'.$i.'">'.$linea->ORDEN_COMPRA_LINEA.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]ORDEN_COMPRA_LINEA"); ?>
                                </td>
                                  <td width="70px">
                                        <span style="float: left">
                                                       <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'normal',
                                                             'size'=>'mini',
                                                             'icon'=>'pencil',
                                                             'htmlOptions'=>array('class'=>'editUpdate','name'=>$i)
                                                          ));
                                                       ?>
                                        </span>
                                       <div class="remove" id ="remover" style="float: left; margin-left: 5px;">
                                                  <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                                 'buttonType'=>'button',
                                                                 'type'=>'danger',
                                                                 'size'=>'mini',
                                                                 'icon'=>'minus white',
                                                                 'htmlOptions'=>array('id'=>'remover','onclick'=>'eliminar()','class'=>'eliminaRegistro','name'=>$i)

                                                         ));
                                                 ?>
                                       </div>
                                   </td>
                         </tr>
                   <?php  endforeach ?>
                   <?php echo CHtml::hiddenField('eliminar','' ); ?>
          <?php endif; ?>
    </tbody>
</table>
</div>
</div> <!-- overflow -->
<?php echo CHtml::HiddenField('check',''); //campo que guarda los id de las lineas a cargar ?>
<?php echo CHtml::HiddenField('contador','0'); //campo contador ?>