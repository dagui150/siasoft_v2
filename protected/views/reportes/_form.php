<?php    
    Yii::app()->clientScript->registerScript('search', "
    $('#reportes-form').submit(function(){
            
            $('html,body').animate({scrollTop:'800px'}, 'slow');
            
            $('#grilla').slideDown('slow');
            
            $.fn.yiiGridView.update('ventas-grid', {
                    data: $(this).serialize()
            });
            
            return false;
    });
    ");
?>
<div class="form">
       
<?php $form= $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'reportes-form',
        'method'=>'get',
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
               
<div id="grilla" style="display: none">
    
    <div id="link" style="float: right; margin-bottom: 10px;">
        <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/pdfReportes.png'),array('formatoPDF','data'=>$array),array('target'=>'_blank','rel'=>'tooltip', 'data-original-title'=>'Exportar PDF')); ?>
    </div>
    
    
        <?php 
            /*Ventas*/
            
            switch ($tipo){
                case 'ventas':
                    
                        $this->widget('bootstrap.widgets.TbGridView', array(
                        'type'=>'striped bordered condensed',
                        'id'=>'ventas-grid',
                        'ajaxUpdate'=>'link',
                        'pagerCssClass' =>'pagination',
                        //'pager' => array('class'=>'BootPager'),
                        'dataProvider'=>$ventas,
                        'columns'=>array(

                            array(
                                'name'=>'FACTURA',                        
                            ),
                            array(
                                'name'=>'BODEGA',
                                'value'=>'$data->bODEGA->DESCRIPCION',
                            ),
                            array(
                                'name'=>'CLIENTE',
                                'value'=>'$data->cLIENTE->NOMBRE',
                            ),
                            array(
                                'name'=>'FECHA_FACTURA',                        
                            ),                    
                            array(
                                'name'=>'NIVEL_PRECIO',   
                                'value'=>'$data->nIVELPRECIO->DESCRIPCION',
                            ),

                            array(
                                'name'=>'TOTAL_A_FACTURAR',                        
                            ),
                        ),
                    ));                    
                    break;
                
                case 'inventario':
                    $this->widget('bootstrap.widgets.TbGridView', array(
                        'type'=>'striped bordered condensed',
                        'id'=>'ventas-grid',
                        'ajaxUpdate'=>'link',
                        'pagerCssClass' =>'pagination',
                        //'pager' => array('class'=>'BootPager'),
                        'dataProvider'=>$ventas,
                        'columns'=>array(

                            array(
                                'name'=>'FACTURA',                        
                            ),
                            array(
                                'name'=>'BODEGA',
                                'value'=>'$data->bODEGA->DESCRIPCION',
                            ),
                            array(
                                'name'=>'CLIENTE',
                                'value'=>'$data->cLIENTE->NOMBRE',
                            ),
                            array(
                                'name'=>'FECHA_FACTURA',                        
                            ),                    
                            array(
                                'name'=>'NIVEL_PRECIO',   
                                'value'=>'$data->nIVELPRECIO->DESCRIPCION',
                            ),

                            array(
                                'name'=>'TOTAL_A_FACTURAR',                        
                            ),
                        ),
                    )); 
                    break;
                
                case 'ordenCompra':
                    $this->widget('bootstrap.widgets.TbGridView', array(
                        'type'=>'striped bordered condensed',
                        'id'=>'ventas-grid',
                        'ajaxUpdate'=>'link',
                        'pagerCssClass' =>'pagination',
                        //'pager' => array('class'=>'BootPager'),
                        'dataProvider'=>$ventas,
                        'columns'=>array(

                            array(
                                'name'=>'FACTURA',                        
                            ),
                            array(
                                'name'=>'BODEGA',
                                'value'=>'$data->bODEGA->DESCRIPCION',
                            ),
                            array(
                                'name'=>'CLIENTE',
                                'value'=>'$data->cLIENTE->NOMBRE',
                            ),
                            array(
                                'name'=>'FECHA_FACTURA',                        
                            ),                    
                            array(
                                'name'=>'NIVEL_PRECIO',   
                                'value'=>'$data->nIVELPRECIO->DESCRIPCION',
                            ),

                            array(
                                'name'=>'TOTAL_A_FACTURAR',                        
                            ),
                        ),
                    ));
                    break;
            }
        
            

        ?>
    
    
    <div id="respuesta"></div>
</div>
