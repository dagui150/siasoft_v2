<div class="form">

<?php $form= $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'reportes-form',
	'type'=>'horizontal',
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
                                <?php echo $form->label($model,'fecha_desde',array('class'=>'control-label'));?>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'fecha_desde', null, array('size'=>'8','style'=>'width:80px;vertical-align:top')); ?>
                                </div>                                
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -40px">
                                <label for="fecha_hasta" class="control-label">Fecha - Hasta</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'fecha_hasta', null, array('size'=>'8','style'=>'width:80px;vertical-align:top')); ?>
                                </div>
                                <?php //echo $form->dropDownListRow($model,'clientes',CHtml::listData(Cliente::model()->findAllByAttributes(array('ACTIVO'=>'S')),'CLIENTE','NOMBRE'),array('empty'=>'Todos')); ?>
                            </div>
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-left: -63px">
                                <?php echo $form->label($model,'bodegas',array('class'=>'control-label'));?>
                                <div class="controls">
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'bodegas',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione',
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
                                <?php echo $form->label($model,'clientes',array('class'=>'control-label'));?>
                                <div class="controls">
                                    <?php
                                    /*
                                     * ESTOY TERMINANDO ESTO  :D
                                        //echo CHtml::listData(Cliente::model()->findAllByAttributes(array('ACTIVO'=>'S')),'CLIENTE','NOMBRE');
                                        echo '<pre>';
                                        print_r(CHtml::listData(Categoria::model()->findAllByAttributes(array('ACTIVO'=>'S', 'TIPO'=>'C')),'ID','DESCRIPCION'));
                                        echo '</pre>';
                                        echo '<br />';
                                        Yii::app()->end();
                                     * 
                                     */
                                    ?>
                                     <?php 
                                        $this->widget('ext.chosen.Chosen',array(
                                            'model' => $model,
                                            'attribute' =>'clientes',
                                            'multiple' =>true,
                                            'noResults' =>'No hay resultados',
                                            'placeholderMultiple'=>'Seleccione',
                                            'htmlOptions' => array('style'=>'width:350px; !important'), 
                                            'data' => array(
                                                ''=>CHtml::listData(Cliente::model()->findAllByAttributes(array('ACTIVO'=>'S')),'CLIENTE','NOMBRE'),
                                            ),
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