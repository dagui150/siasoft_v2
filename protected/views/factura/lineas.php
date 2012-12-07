<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('calculos.js'), CClientScript::POS_HEAD);
?>
<div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
<table class="templateFrame table table-bordered" cellspacing="0">
      <thead>
           <tr>
                <td><strong>Línea</strong></td>
                <td><strong>Artículo</strong></td>
                <td><strong>Descripción</strong></td>
                <td><strong>Unidad</strong></td>
                <td><strong>Tipo Precio</strong></td>
                <td><strong>Cantidad</strong></td>
                <td><strong>Precio Unitario</strong></td>                
                <td><strong>Porcentaje Descuento</strong></td>
                <td><strong>Monto Descuento</strong></td>
                <td><strong>Porcentaje Impuesto</strong></td>
                <td><strong>Valor Impuesto</strong></td>
                <td><strong>Estado</strong></td>
                <td><strong>Comentario</strong></td>
                <td><strong>Total</strong></td>
                <td></td>
           </tr>
     </thead>
     <tfoot>
           <tr>
                <td colspan="15">
                    <div id="add" class="add">
                       <?php 
                            //$config = ConfCi::model()->find();
                            //$contador = $countLineas;
                            $this->widget('bootstrap.widgets.BootButton', array(
                                                        'buttonType'=>'button',
                                                        'type'=>'success',
                                                        'label'=>'Nuevo',
                                                        'icon'=>'plus white',
                                                        'htmlOptions' => array('class'=>'clonar', 'style'=>'display:none'),
                                                  ));
                             
                             /*
                             echo CHtml::hiddenField('maxLineas',$config->LINEAS_MAX_TRANS);
                             echo CHtml::hiddenField('contador',$contador);
                             echo CHtml::hiddenField('contadorLineas',$contador);
                              */
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
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][UNIDAD]',''); ?>
                                    </td>
                                    <td>
                                        <span id='tipo_precio_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][TIPO_PRECIO]',''); ?>
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
                                        <span id='porc_descuento_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][PORC_DESCUENTO]',''); ?>                                        
                                    </td>
                                    <td>
                                        <span id='monto_descuento_<?php echo '{0}';?>'></span>
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
                                        <span id='estado_<?php echo '{0}';?>'></span>                                                                           
                                    </td>
                                    <td>
                                        <span id='comentario_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][COMENTARIO]',''); ?>
                                    </td>
                                    <td>
                                        <span id='total_<?php echo '{0}';?>'></span>                                                                           
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
</div>