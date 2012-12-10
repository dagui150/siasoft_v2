<?php

    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<?php $this->widget('bootstrap.widgets.BootButton', array(
    'type'=>'',
    'size'=>'mini',
    'url'=>'#lineas',
    'label' => 'Cargar Lineas',
    'icon'=>'icon-download-alt',
    'htmlOptions'=>array('data-toggle'=>'modal'),
)); ?>

<?php 
    $value = 0;
?>

     <div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid" cellspacing="0">
                            <thead class="templateHead">
                                <tr>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ARTICULO');?>
                                    </td>                                    
                                    <td>
                                        <?php echo $form->labelEx($linea,'DESCRIPCION');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'UNIDAD_COMPRA');?>
                                    </td>
                                    <td>
                                        <label>Solicitudes</label>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'BODEGA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FECHA_REQUERIDA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FACTURA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'PRECIO_UNITARIO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD_ORDENADA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'PORC_DESCUENTO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'MONTO_DESCUENTO');?>
                                    </td>
                                    <td>
                                        <label>Importe</label>
                                    </td>
                                    <td>
                                        <label>Porc. Impuesto</label>                                            
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'VALOR_IMPUESTO');?>
                                    </td>                                   
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD_RECIBIDA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD_RECHAZADA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FECHA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'OBSERVACION');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ESTADO');?>
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
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][ARTICULO]','',array('class' => 'tonces')); ?>
                                                </td>
                                                <td>
                                                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => '{0}'),
                                                        )); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][DESCRIPCION]','',array('class' => 'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('OrdenCompraLinea[{0}][UNIDAD_COMPRA]','',array('prompt'=>'Seleccione articulo', 'disabled'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][SOLICITUD]','',array('readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('OrdenCompraLinea[{0}][BODEGA]','',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('prompt'=>'Seleccione Bodega')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][FECHA_REQUERIDA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][FACTURA]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][PRECIO_UNITARIO]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][CANTIDAD_ORDENADA]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][PORC_DESCUENTO]','0',array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][MONTO_DESCUENTO]','',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][IMPORTE]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][PORC_IMPUESTO]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][VALOR_IMPUESTO]','0',array('readonly'=>true, 'size' => '10')); ?>
                                                </td>                                           
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][CANTIDAD_RECIBIDA]','',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][CANTIDAD_RECHAZADA]','',array('readonly'=>true, 'size' => '5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][FECHA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][OBSERVACION]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][ESTADO]','P',array('size'=>'1', 'readonly'=>true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('OrdenCompraLinea[{0}][LINEA_NUM]','',array('readonly'=>true, 'size'=>'5')); ?>
                                                   
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
                                    foreach($items as $i=>$person):
                                ?>
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($person,"[$i]ARTICULO",array('style'=>'width:100px', 'class' => 'tonces', 'readonly'=>true)); ?>
                                    </td>
                                   
                        <td>
                            <?php echo $form->textField($person,"[$i]DESCRIPCION",array('class'=>'required', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]UNIDAD_COMPRA",array('prompt'=>'Seleccione articulo', 'disabled'=>true)); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("[$i]SOLICITUD", $value, array('readonly'=>true)); ?>
                        </td>                     
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]BODEGA",CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('class'=>'required', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA_REQUERIDA",array('class' => 'fecha', 'size' => '10', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FACTURA",array('readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PRECIO_UNITARIO",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '10', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_ORDENADA",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]PORC_DESCUENTO",array('class'=>'calculos', 'onFocus'=> "if (this.value=='0') this.value='';", 'size' => '5', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]MONTO_DESCUENTO",array('readonly'=>true, 'size' => '10')); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("[$i]IMPORTE", $value, array('size' => '10', 'readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("[$i]PORC_IMPUESTO", $value, array('size' => '10', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]VALOR_IMPUESTO",array('readonly'=>true, 'value'=>'0', 'size' => '10')); ?>
                        </td>                       
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECIBIDA",array('readonly'=>true, 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD_RECHAZADA",array('readonly'=>true, 'size' => '5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA",array('class' => 'fecha', 'size'=>'10', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]OBSERVACION",array('readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]ESTADO",array('size'=>'1', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]LINEA_NUM",array('readonly'=>true, 'size'=>'5')); ?>
                        </td>
                                    <td>
                                        <div id="remover" class="remove">
                                              <?php 
                                                
                                                 $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'label'=>'',
                                                             'icon'=>'minus white',
                                                             'htmlOptions'=>array('onClick'=>'Eliminar()'),
                                                  ));

                                             ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!--panel-->
                </div><!--complex-->
    </div>
<?php echo CHtml::hiddenField('ocultoUpd', $i); ?>