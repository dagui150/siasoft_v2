<div class="form">

<?php $form= $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'reportes-ventas-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
		
        <?php
            $calendario = $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                              'name'=>'FECHA',
                              'language'=>'es',
                              'options'=>array(
                                     'changeMonth'=>true,
                                     'changeYear'=>true,
                                     'dateFormat'=>'yy-mm-dd',
                                     'constrainInput'=>'false',
                                     'showAnim'=>'fadeIn',
                                     'showOn'=>'button',
                                     'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
                                     'buttonImageOnly'=>true,
                              ),
                              'htmlOptions'=>array('style'=>'width:80px;vertical-align:top'),
                ),true);
            $calendario2 = $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                              'name'=>'FECHA2',
                              'language'=>'es',
                              'options'=>array(
                                     'changeMonth'=>true,
                                     'changeYear'=>true,
                                     'dateFormat'=>'yy-mm-dd',
                                     'constrainInput'=>'false',
                                     'showAnim'=>'fadeIn',
                                     'showOn'=>'button',
                                     'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
                                     'buttonImageOnly'=>true,
                              ),
                              'htmlOptions'=>array('style'=>'width:80px;vertical-align:top'),
                ),true);
        ?>
    <br />
        <div class="well form "style="margin-top: 10px;-webkit-box-shadow: #666 0px 0px 10px;-moz-box-shadow: #666 0px 0px 10px;box-shadow: #666 0px 0px 10px;">
            <p class="text-info"><i>* Para generar un reporte general, no seleccione ninguna fecha.</i></p>
            <fieldset >
                <legend><font size="3" face="arial">Fecha</font></legend>
                
                <label for="FECHA" class="control-label">Desde</label>
                <div class="controls">
                    <?php echo $calendario; ?>
                </div>

                <label for="FECHA_2" class="control-label">Hasta</label>
                <div class="controls">
                    <?php echo $calendario2; ?>
                </div>

                <?php //echo CHtml::textField('Articulo_desc',''); ?>
            </fieldset>
            <fieldset >
                <legend><font size="3" face="arial">Bodega</font></legend>
                
                <label for="FECHA" class="control-label">Bodegas</label>
                <div class="controls">
                    <?php echo CHtml::dropDownList('BODEGA','',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Todas')); ?>
                </div>
                
            </fieldset>
            <fieldset >
                <legend><font size="3" face="arial">Cliente</font></legend>
                
                <label for="FECHA" class="control-label">Clientes</label>
                <div class="controls">
                    <?php echo CHtml::dropDownList('BODEGA','',CHtml::listData(Cliente::model()->findAll(),'CLIENTE','NOMBRE'),array('empty'=>'Todos')); ?>
                </div>
                
            </fieldset>
            <br />
            <div class="row-buttons" align="center">
                <?php $this->darBotonEnviar('Generar'); ?>
                <?php $this->darBotonCancelar(false, array('site/index')); ?>
            </div>
        </div>
		


<?php $this->endWidget(); ?>

</div><!-- form -->