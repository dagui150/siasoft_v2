<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<?php $i=-1; ?>
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid table table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>
                                        <label>Tipo Precio</label>
                                    </td>
                                    <td>
                                        <label>Esquema</label>
                                    </td>
                                    <td>
                                        <label>Margen / Multiplicador</label>
                                    </td>
                                    <td>
                                        <label>Precio</label>
                                    </td>                                   
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>                                                    
                                                    <?php echo CHtml::textField('Nuevo[{0}][NIVEL_PRECIO]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][ESQUEMA_TRABAJO]','',array('readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <span style="background-color:#EEEEEE;line-height:30px;text-align:center; text-shadow:#FFFFFF 0 1px 0;padding-left:5px;padding-top:0px;width:16px;height:24px;margin-top:2px;float:left;font-size: 14px;border:1px solid #CCCCCC;">%</span>
                                                    <?php echo CHtml::textField('Nuevo[{0}][MARGEN_MULTIPLICADOR]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][PRECIO]','0',array()); ?>
                                                </td>                                                                                                
                                                    <input type="hidden" class="rowIndex" value="{0}" />
                                            </tr>
                                        </textarea>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody class="templateTarget">                                    
                                    <?php foreach($cargar as $i=>$item): ?>
                                <tr class="templateContent">
                                    <td>
                                        <span id="precio[<?php echo $i ?>]_ID"><?php echo $item->nIVELPRECIO->DESCRIPCION ?></span>
                            <?php //echo CHtml::hiddenField("precio[$i]_ID", $item->nIVELPRECIO->DESCRIPCION, array('readonly'=>true)); ?>
                            <?php echo CHtml::hiddenField("NivelPrecio[$i]_ID", $item->NIVEL_PRECIO, array('readonly'=>true)); ?>
                            		</td>
                        <td>
                            <span id="NivelPrecio2[<?php echo $i ?>]_ESQUEMA_TRABAJO"><?php echo NivelPrecio::tipo($item->nIVELPRECIO->ESQUEMA_TRABAJO) ?></span>
                            <?php echo CHtml::hiddenField("NivelPrecio2[$i]_ESQUEMA_TRABAJO",$item->ESQUEMA_TRABAJO,array('readonly' => true)); ?>
                        </td>
                        <td>
                            <?php 
                                if($item->ESQUEMA_TRABAJO == 'NORM'){ ?>
                                    <div class="input-prepend">
                                        <span class="add-on">%</span>
                                        <input class="span2" id="NivelPrecio3_<?php echo $i?>_MARGEN_MULTIPLICADOR" type="text" readonly="true" name="NivelPrecio3[<?php echo $i?>]_MARGEN_MULTIPLICADOR">
                                    </div>
                                <?php    //echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", '', array('class'=>'input-prepend','readonly'=>true)); 
                                }
                                else{ ?>
                                    <div class="input-prepend">
                                        <span class="add-on">%</span>
                                        <input class="calculosGen decimal span2" id="NivelPrecio3_<?php echo $i?>_MARGEN_MULTIPLICADOR" type="text" value="<?php echo $item->MARGEN_MULTIPLICADOR?>" name="NivelPrecio3[<?php echo $i?>]_MARGEN_MULTIPLICADOR">
                                    </div>
                                <?php
                                   // echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", $item->MARGEN_MULTIPLICADOR, array('class'=>'calculosGen decimal span2')); 
                                }
                            ?>
                        </td>
                        <td>
                            <span id="spanNivelPrecio4_<?php echo $i ?>_PRECIO"><?php echo $item->PRECIO?></span>
                            
                            <?php echo CHtml::hiddenField("NivelPrecio4[$i]_PRECIO", $item->PRECIO, array('readonly'=>true, 'class'=> 'decimal')); ?>
                        </td>
                      </tr>                      
                      <?php endforeach; ?> 
                       <?php $i++; ?>
                      <?php foreach($precios as $item): ?>                                
                                <tr class="templateContent">
                                    <td>
                            <?php echo CHtml::textField("NivelPrecio[$i]_ID", $item->ID, array('readonly'=>true)); ?>
                            		</td>
                        <td>
                            <?php echo CHtml::textField("NivelPrecio2[$i]_ESQUEMA_TRABAJO",$item->ESQUEMA_TRABAJO,array('readonly' => true)); ?>
                        </td>
                        <td>
                            <?php 
                                if($item->ESQUEMA_TRABAJO == 'NORM'){?>
                                    <span style="background-color:#EEEEEE;line-height:30px;text-align:center; text-shadow:#FFFFFF 0 1px 0;padding-left:5px;padding-top:0px;width:16px;height:24px;margin-top:2px;float:left;font-size: 14px;border:1px solid #CCCCCC;">%</span>
                                <?php
                                    echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", '', array('readonly'=>true)); 
                                }
                                else{?>
                                    <span style="background-color:#EEEEEE;line-height:30px;text-align:center; text-shadow:#FFFFFF 0 1px 0;padding-left:5px;padding-top:0px;width:16px;height:24px;margin-top:2px;float:left;font-size: 14px;border:1px solid #CCCCCC;">%</span>
                                <?php
                                    echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", '', array('class'=>'calculosGen')); 
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("NivelPrecio4[$i]_PRECIO", '0', array('readonly'=>true)); ?>
                        </td>
                      </tr>   
                      <?php $i++; ?>
                      <?php endforeach; ?> 
                </tbody>
             </table>
         </div><!--panel-->
      </div><!--complex-->
      <?php echo CHtml::HiddenField('ciclos',$i); ?>