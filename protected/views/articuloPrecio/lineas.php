<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<?php $i=-1; ?>
    <div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
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
                                                    <?php echo CHtml::textField('Nuevo[{0}][MARGEN_MULTIPLICADOR]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][PRECIO]','',array()); ?>
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
                            <?php echo CHtml::textField("NivelPrecio[$i]_ID", $item->NIVEL_PRECIO, array('readonly'=>true)); ?>
                            		</td>
                        <td>
                            <?php echo CHtml::textField("NivelPrecio2[$i]_ESQUEMA_TRABAJO",$item->ESQUEMA_TRABAJO,array('readonly' => true)); ?>
                        </td>
                        <td>
                            <?php 
                                if($item->ESQUEMA_TRABAJO == 'NORM'){
                                    echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", '', array('readonly'=>true)); 
                                }
                                else{
                                    echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", $item->MARGEN_MULTIPLICADOR, array('class'=>'calculosGen')); 
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("NivelPrecio4[$i]_PRECIO", $item->PRECIO, array('readonly'=>true)); ?>
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
                                if($item->ESQUEMA_TRABAJO == 'NORM'){
                                    echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", '', array('readonly'=>true)); 
                                }
                                else{
                                    echo CHtml::textField("NivelPrecio3[$i]_MARGEN_MULTIPLICADOR", '', array('class'=>'calculosGen')); 
                                }
                            ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("NivelPrecio4[$i]_PRECIO", '', array('readonly'=>true)); ?>
                        </td>
                      </tr>   
                      <?php $i++; ?>
                      <?php endforeach; ?> 
                </tbody>
             </table>
         </div><!--panel-->
      </div><!--complex-->
      <?php echo CHtml::HiddenField('ciclos',$i); ?>
    </div>