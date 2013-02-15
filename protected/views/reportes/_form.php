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

    <?php switch ($tipo){
        case 'ventas': ?>
    
            <br />
                <div class="well form "style="margin-top: 10px;-webkit-box-shadow: #666 0px 0px 10px;-moz-box-shadow: #666 0px 0px 10px;box-shadow: #666 0px 0px 10px;">
                    <p class="text-info"><i>* Para crear un reporte general, solo dar clic en el botón "Generar".</i></p>

                    <table>
                    <tr>
                        <td>
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'FECHA_DESDE',array('class'=>'control-label'));?>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'FECHA_DESDE', null, array('size'=>'8','style'=>'width:80px;vertical-align:top')); ?>
                                </div>                                
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <label for="FECHA_HASTA" class="control-label">Fecha - Hasta</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'FECHA_HASTA', null, array('size'=>'8','style'=>'width:80px;vertical-align:top')); ?>
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
                                            'data' => $model->getCombo(),
                                         ));
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </table>
                    <div class="row-buttons" align="center">
                        <?php $this->darBotonGenerarReporte(); ?>
                    </div>
                </div>
       
            <?php break;
        case 'otro': ?>
            <?php break;
    } ?>
        

<?php $this->endWidget(); ?>

</div><!-- form -->