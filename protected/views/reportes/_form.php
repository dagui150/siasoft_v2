<div class="form">

<?php $form= $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'reportes-form',
	'type'=>'horizontal',
        'method'=>'get',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <br />
    <div class="well form "style="margin-top: 10px;-webkit-box-shadow: #666 0px 0px 10px;-moz-box-shadow: #666 0px 0px 10px;box-shadow: #666 0px 0px 10px;">
        <p class="text-info"><i>* Para crear un reporte general, solo dar clic en el botón "Generar".</i></p>

        <table>
        <tr>
            <td>
                <?php switch ($tipo){
                    /* VENTAS */
                    case 'ventas': ?>
    
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'FECHA_DESDE',array('class'=>'control-label'));?>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'FECHA_DESDE', null, array('size'=>'10','style'=>'width:80px;vertical-align:top')); ?>
                                </div>                                
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <label for="FECHA_HASTA" class="control-label">Fecha - Hasta</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'FECHA_HASTA', null, array('size'=>'10','style'=>'width:80px;vertical-align:top')); ?>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'BODEGAS',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'BODEGAS',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione...',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => array(
                                                'Consumo'=>CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S', 'TIPO'=>'C')),'ID','DESCRIPCION'),
                                                'Ventas'=>CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S', 'TIPO'=>'V')),'ID','DESCRIPCION'),
                                                'No disponible'=>CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S', 'TIPO'=>'N')),'ID','DESCRIPCION')
                                            ),
                                         ));
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <?php echo $form->label($model,'CLIENTES',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'CLIENTES',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione...',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => $model->getCombo('C'),
                                         ));
                                    ?>
                                </div>
                            </div>
       
                        <?php break;
                    
                    
                    /* INVENTARIO */
                    case 'inventario': ?>
                            
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'BODEGAS',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'BODEGAS',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione...',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => array(
                                                'Consumo'=>CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S', 'TIPO'=>'C')),'ID','DESCRIPCION'),
                                                'Ventas'=>CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S', 'TIPO'=>'V')),'ID','DESCRIPCION'),
                                                'No disponible'=>CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S', 'TIPO'=>'N')),'ID','DESCRIPCION')
                                            ),
                                         ));
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <?php echo $form->label($model,'CANTIDADES',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'CANTIDADES',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione...',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => CHtml::listData(TipoCantidadArticulo::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','NOMBRE'),
                                         ));
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'TIPO_ARTICULOS',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'TIPO_ARTICULOS',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione...',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => CHtml::listData(TipoArticulo::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','NOMBRE'),
                                         ));
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <?php echo $form->radioButtonListInlineRow($model,'ARTICULOS_ACTIVO',array('S'=>'Si','N'=>'No')); ?>
                            </div>
                            
                        <?php break;
                    
                    
                    /* ORDENES DE COMPRA */
                    case 'ordenCompra': ?>
                            
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'FECHA_DESDE',array('class'=>'control-label'));?>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'FECHA_DESDE', null, array('size'=>'10','style'=>'width:80px;vertical-align:top')); ?>
                                </div>                                
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <label for="FECHA_HASTA" class="control-label">Fecha - Hasta</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'FECHA_HASTA', null, array('size'=>'10','style'=>'width:80px;vertical-align:top')); ?>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'ESTADO_ORDEN_COMP',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'ESTADO_ORDEN_COMP',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione...',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => array(
                                                'A'=>'Autorizado',
                                                'B'=>'BackOrder',
                                                'C'=>'Cancelado',
                                                'E'=>'Cerrado',
                                                'R'=>'Recibido',
                                                'P'=>'Planeado',
                                            ),
                                         ));
                                    ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <?php echo $form->label($model,'PROVEEDOR',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'PROVEEDOR',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione...',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => $model->getCombo('P'),
                                         ));
                                    ?>
                                </div>
                            </div>
                            
                        <?php break;
                } ?>
                </td>
            </tr>
        </table>
        <div class="row-buttons" align="center">
            <?php $this->darBotonGenerarReporte(); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->