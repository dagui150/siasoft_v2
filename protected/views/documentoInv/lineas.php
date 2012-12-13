<table class="templateFrame table table-bordered" cellspacing="0">
      <thead>
           <tr>
                <td><strong>Línea</strong></td>
                <td><strong>Artículo</strong></td>
                <td><strong>Descripción</strong></td>
                <td><strong>Bodega</strong></td>
                <td><strong>Cantidad</strong></td>
                <td></td>
           </tr>
     </thead>
     <tfoot>
           <tr>
                <td colspan="6">
                      <span class="add" id="nuevaLinea" ></span>
                       <?php 
                            $config = ConfCi::model()->find();
                            $contador = $countLineas;
                             $this->widget('bootstrap.widgets.BootButton', array(
                                        'buttonType'=>'button',
                                        'type'=>'success',
                                        'label'=>'Nuevo',
                                         'icon'=>'plus white',
                                        'htmlOptions'=>array('id'=>'btn-nuevo','name'=>'','onclick'=>'$("#nuevo").modal(); limpiarForm();','disabled'=>$model->ESTADO == 'P' ? false : true)
                             ));
                             
                             echo CHtml::hiddenField('maxLineas',$config->LINEAS_MAX_TRANS);
                             echo CHtml::hiddenField('contador',$contador);
                             echo CHtml::hiddenField('contadorLineas',$contador);
                       ?>
                       <textarea class="template" rows="0" cols="0" style="display:none;">
                                <tr class="templateContent">
                                    <td>
                                        <span id='linea_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][TIPO_TRANSACCION]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][SUBTIPO]',''); ?>
                                    </td>
                                    <td>
                                        <span id='articulo_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][ARTICULO]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][NOMBRE_ARTICULO]',''); ?>
                                    </td>
                                    <td>
                                        <span id='descripcion_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][TIPO_TRANSACCION_CANTIDAD]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][BODEGA]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][NOMBRE_BODEGA]',''); ?>
                                    </td>
                                    <td>
                                        <span id='bodega_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][BODEGA_DESTINO]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][NOMBRE_BODEGA_DESTINO]',''); ?>
                                        
                                    </td>
                                    <td>
                                        <span id='cantidad_<?php echo '{0}';?>'></span>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][CANTIDAD]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][UNIDAD]',''); ?>
                                        <?php echo CHtml::hiddenField('LineaNuevo[{0}][COSTO_UNITARIO]',''); ?>
                                        
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
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]DOCUMENTO_INV_LINEA"); ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]TIPO_TRANSACCION"); ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]SUBTIPO"); ?>
                               </td>
                               <td>
                                        <?php echo '<span id="articuloU_'.$i.'">'.$linea->ARTICULO.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]LINEA_NUM"); ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]ARTICULO"); ?>
                                        <?php echo CHtml::hiddenField("DocumentoInvLinea[$i][NOMBRE_ARTICULO]",Articulo::darNombre($linea->ARTICULO)); ?>
                               </td>
                               <td> 
                                        <?php echo '<span id="descripcionU_'.$i.'">'.Articulo::darNombre($linea->ARTICULO).'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]TIPO_TRANSACCION_CANTIDAD"); ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]BODEGA"); ?>
                                        <?php echo CHtml::hiddenField("DocumentoInvLinea[$i][NOMBRE_BODEGA]",Bodega::darDescripcion($linea->BODEGA)); ?>
                               </td>
                               <td>
                                        <?php echo '<span id="bodegaU_'.$i.'">'.$linea->BODEGA.' - '.Bodega::darDescripcion($linea->BODEGA).'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]BODEGA_DESTINO"); ?>
                                        <?php echo CHtml::hiddenField("DocumentoInvLinea[$i][NOMBRE_BODEGA_DESTINO]",Bodega::darDescripcion($linea->BODEGA_DESTINO)); ?>
                                        
                                </td>
                                <td>
                                        <?php echo '<span id="cantidadU_'.$i.'">'.$linea->CANTIDAD.'</span>'; ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]CANTIDAD"); ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]UNIDAD"); ?>
                                        <?php echo CHtml::activeHiddenField($linea,"[$i]COSTO_UNITARIO"); ?>
                                        
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
