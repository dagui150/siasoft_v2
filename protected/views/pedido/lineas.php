<div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
<table class="templateFrame table table-bordered" cellspacing="0">
      <thead>
           <tr>
                <td><strong>Línea</strong></td>
                <td><strong>Artículo</strong></td>
                <td><strong>Descripción</strong></td>
                <td><strong>Unidad</strong></td>
                <td><strong>Cantidad</strong></td>
                <td><strong>Precio Unitario</strong></td>
                <td><strong>Estado</strong></td>
                <td><strong>Porcentaje Descuento</strong></td>
                <td><strong>Monto Descuento</strong></td>
                <td><strong>Comentario</strong></td>
                <td><strong>Porcentaje Retención</strong></td>
                <td><strong>Monto de Retención</strong></td>
                <td></td>
           </tr>
     </thead>
     <tfoot>
           <tr>
                <td colspan="6">
                      <span class="add" id="nuevaLinea" ></span>
                       <?php 
                            //$config = ConfCi::model()->find();
                            //$contador = $countLineas;
                             /*$this->widget('bootstrap.widgets.BootButton', array(
                                        'buttonType'=>'button',
                                        'type'=>'success',
                                        'label'=>'Nuevo',
                                         'icon'=>'plus white',
                                        'htmlOptions'=>array('id'=>'btn-nuevo','name'=>'','onclick'=>'$("#nuevo").modal(); limpiarForm();','disabled'=>$model->ESTADO == 'P' ? false : true)
                             ));*/
                             
                             /*
                             echo CHtml::hiddenField('maxLineas',$config->LINEAS_MAX_TRANS);
                             echo CHtml::hiddenField('contador',$contador);
                             echo CHtml::hiddenField('contadorLineas',$contador);
                              */
                       ?>
                       <textarea class="template" rows="0" cols="0" style="display:none;">
                                <tr class="templateContent">
                                    <td>
                                        <span id='linea_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][LINEA]',''); ?>                                        
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
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][UNIDAD]',''); ?>
                                    </td>
                                    <td>
                                        <span id='cantidad_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][CANTIDAD]',''); ?>                                        
                                    </td>
                                    <td>
                                        <span id='precio_unitario_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][PRECIO_UNITARIO]',''); ?>                                        
                                    </td>
                                    <td>
                                        <span id='estado_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][ESTADO]',''); ?>                                        
                                    </td>
                                    <td>
                                        <span id='porc_descuento_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][PORC_DESCUENTO]',''); ?>                                        
                                    </td>
                                    <td>
                                        <span id='monto_descuento_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][MONTO_DESCUENTO]',''); ?>
                                    </td>
                                    <td>
                                        <span id='comentario_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][COMENTARIO]',''); ?>
                                    </td>
                                    <td>
                                        <span id='porc_retencion_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][PORC_RETENCION]',''); ?>
                                    </td>
                                    <td>
                                        <span id='monto_retencion_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][MONTO_RETENCION]',''); ?>
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
                                        <?php echo '<span id="precio_unitarioU_'.$i.'">'.$linea->PRECIO_UNITARIO.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]PRECIO_UNITARIO"); ?>                                        
                                </td>
                                <td>
                                        <?php echo '<span id="estadoU_'.$i.'">'.$linea->ESTADO.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]ESTADO"); ?>                                        
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
                                        <?php echo '<span id="comentarioU_'.$i.'">'.$linea->COMENTARIO.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]COMENTARIO"); ?>                                        
                                </td>
                                <td>
                                        <?php echo '<span id="porc_retencionU_'.$i.'">'.$linea->PORC_RETENCION.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]PORC_RETENCION"); ?>                                        
                                </td>
                                <td>
                                        <?php echo '<span id="monto_retencionU_'.$i.'">'.$linea->MONTO_RETENCION.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]MONTO_RETENCION"); ?>                                        
                                </td>
                                <td>
                                        <span style="float: left">
                                                       <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'normal',
                                                             'size'=>'mini',
                                                             'icon'=>'pencil',
                                                             'htmlOptions'=>array('class'=>'editUpdate','name'=>$i,'disabled'=>$model->ESTADO == 'P' ? false : true)
                                                          ));
                                                       ?>
                                        </span>
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
                   <?php  endforeach ?>
                   <?php echo CHtml::hiddenField('eliminar','' ); ?>
          <?php endif; ?>
    </tbody>
</table>
</div>