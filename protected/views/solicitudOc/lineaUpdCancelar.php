<?php

    // lineas para playground
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);

?>


 <div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
     
         <!-- Inicio tabla playground -->
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ARTICULO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'DESCRIPCION');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'UNIDAD');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ESTADO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FECHA_REQUERIDA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'COMENTARIO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'SALDO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'LINEA_NUM');?>
                                    </td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][ARTICULO]','',array('class' => 'tonces', 'readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][DESCRIPCION]','',array('readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('SolicitudOcLinea[{0}][UNIDAD]','',array('readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][ESTADO]','P',array('readonly'=>true, 'size'=>'1')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][CANTIDAD]','',array('size'=>'5', 'readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][FECHA_REQUERIDA]','',array('class' => 'fecha', 'size'=>'10', 'readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][COMENTARIO]','',array('readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][SALDO]','0',array('readonly'=>true, 'size'=>'5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][LINEA_NUM]','0',array('readonly'=>true, 'size'=>'5')); ?>
                                                   
                                                </td>                                                
                                                <td>
                                                   <input type="hidden" class="rowIndex" value="{0}" />
                                                </td>
                                            </tr>
                                        </textarea>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody class="templateTarget">
                                <?php 
                                    $persons = array();
                                    foreach($items as $i=>$item):
                                ?>
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($item,"[$i]ARTICULO", array('class'=>'tonces', 'readonly' => true)); ?>
                            		</td>
                        <td>
                            <?php echo $form->textField($item,"[$i]DESCRIPCION",array('readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($item,"[$i]UNIDAD", $linea->getCombo($item->ARTICULO), array('prompt'=>'Seleccione articulo', 'disabled' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]ESTADO",array('value'=>'P', 'readonly'=>true, 'size'=>'1')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]CANTIDAD",array('size'=>'5', 'readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]FECHA_REQUERIDA",array('class' => 'fecha', 'size'=>'10', 'readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]COMENTARIO",array('readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]SALDO",array('readonly'=>true, 'size'=>'5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]LINEA_NUM",array('readonly'=>true, 'size'=>'2')); ?>
                        </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!--panel-->
                </div><!--complex-->
                
                 <!-- Fin tabla playground -->            
 </div>      