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
                            <div style="margin-left: -30px">
                                <label for="FECHA" class="control-label">Fecha - Desde</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'fecha_desde'); ?>
                                </div>
                                   <br />
                                <label for="FECHA_2" class="control-label">Fecha - Hasta</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'fecha_hasta'); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -70px">
                                <?php echo $form->dropDownListRow($model,'bodegas',CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','DESCRIPCION'),array('empty'=>'Todas')); ?>
                                <?php echo $form->dropDownListRow($model,'clientes',CHtml::listData(Cliente::model()->findAllByAttributes(array('ACTIVO'=>'S')),'CLIENTE','NOMBRE'),array('empty'=>'Todos')); ?>
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