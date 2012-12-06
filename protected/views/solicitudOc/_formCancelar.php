<div class="form">
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'solicitud-oc-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        <?php 
        
        // Validacion de Rubros en la configuracion
        
         if($config->USAR_RUBROS == "S") {
                    $rubros = '<div class="row">'
                    .$form->labelEx($model,'RUBRO1')
                    .$form->textField($model,'RUBRO1',array('size'=>50,'maxlength'=>50))
                    .$form->error($model,'RUBRO1')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO2')
                    .$form->textField($model,'RUBRO2',array('size'=>50,'maxlength'=>50))
                    .$form->error($model,'RUBRO2')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO3')
                    .$form->textField($model,'RUBRO3',array('size'=>50,'maxlength'=>50))
                    .$form->error($model,'RUBRO3')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO4')
                    .$form->textField($model,'RUBRO4',array('size'=>50,'maxlength'=>50))
                    .$form->error($model,'RUBRO4')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO5')
                    .$form->textField($model,'RUBRO5',array('size'=>50,'maxlength'=>50))
                    .$form->error($model,'RUBRO5')
                    .'</div>';
         }
         else{
             $rubros='Para usar esta opcion debes habilitarla en configuracion';
         }
?>
    
<?php     
                $retorna = $model->SOLICITUD_OC;
                $render = 'lineaUpdCancelar';
                $pestana = $this->renderPartial($render, array('form'=>$form, 'linea'=>$linea, 'items'=>$items, 'linea2'=>$linea2),true);
?>
    
    <table>
        <tr>
            <td>
        <div class="row">
		<?php echo $form->labelEx($model,'SOLICITUD_OC'); ?>
		<?php echo $form->textField($model,'SOLICITUD_OC',array('size'=>10,'maxlength'=>10, 'readonly'=>true, 'value' => $retorna)); ?>
		<?php echo $form->error($model,'SOLICITUD_OC'); ?>
	</div> 
            </td>
            <td>
        <div class="row">
		<?php echo $form->labelEx($model,'ESTADO'); ?>
                <?php echo $form->hiddenField($model,'ESTADO',array('value'=>'C')) ?>
                <?php echo CHtml::textField('Estado','Cancelada',array('readonly'=>true)); ?>
		<?php echo $form->error($model,'ESTADO'); ?>
	</div>
            </td>
        </tr>

    

    </table>
    
	<?php echo $form->errorSummary($model); ?>

        <?php $this->widget('bootstrap.widgets.BootTabbable', array(
            'type'=>'tabs', // 'tabs' or 'pills'
            'tabs'=>array(
                array('label'=>'Líneas', 'content'=>
                    $pestana
                    , 'active'=>true),
               
                array('label'=>'General', 'content'=>
                    '<div class="row">'
                    .$form->labelEx($model,'DEPARTAMENTO')
                    .$form->dropDownList($model,'DEPARTAMENTO', CHtml::listData(Departamento::model()->findAll(),'ID','DESCRIPCION'),array('disabled'=>true))
                    .$form->error($model,'DEPARTAMENTO')
                    .'</div>'
                    .'<table border="0" cellspacing="0" cellpadding="10">
                        <tr>
                            <td width="40%"><b>Fecha Solicitud:</b> '.$form->textField($model,'FECHA_SOLICITUD', array('readonly' => true)).' '.$form->error($model,'FECHA_SOLICITUD').'</td>
                            <td width="40%"><b>Fecha Requerida:</b> '.$form->textField($model,'FECHA_REQUERIDA', array('readonly' => true)).' '.$form->error($model,'FECHA_REQUERIDA').'</td>
                        </tr>
                      </table>'
                    .'<div class="row">'
                    .$form->labelEx($model,'PRIORIDAD')
                    .$form->textField($model,'PRIORIDAD',array('readonly'=>true))
                    .$form->error($model,'PRIORIDAD')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'COMENTARIO')
                    .$form->textArea($model,'COMENTARIO',array('rows'=>6, 'cols'=>50, 'readonly'=>true))
                    .$form->error($model,'COMENTARIO')
                    .'</div>'),
                                 
                
               array('label'=>'Auditoria', 'content'=>
                     '<div class="row">'
                    .$form->labelEx($model,'AUTORIZADA_POR')
                    .$form->textField($model,'AUTORIZADA_POR',array('size'=>20,'maxlength'=>20, 'disabled'=>true))
                    .$form->error($model,'AUTORIZADA_POR')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'FECHA_AUTORIZADA')
                    .$form->textField($model,'FECHA_AUTORIZADA', array('disabled'=>true))
                    .$form->error($model,'FECHA_AUTORIZADA')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'LINEAS_NO_ASIG')
                    .$form->textField($model,'LINEAS_NO_ASIG',array('size'=>50,'maxlength'=>50, 'disabled'=>true))
                    .$form->error($model,'LINEAS_NO_ASIG')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'CANCELADA_POR')
                    .$form->textField($model,'CANCELADA_POR', array('disabled'=>true))
                    .$form->error($model,'CANCELADA_POR')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'FECHA_CANCELADA')
                    .$form->textField($model,'FECHA_CANCELADA', array('disabled'=>true))
                    .$form->error($model,'FECHA_CANCELADA')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'ESTADO')
                    .$form->textField($model,'ESTADO', array('size'=>1, 'disabled'=>true))
                    .$form->error($model,'ESTADO')
                    .'</div>',),
                
                    array('label'=>'Rubros', 'content'=>$rubros),
                
            ),
        )); ?>
        
	<div align="center">
            <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('solicitudOc/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->