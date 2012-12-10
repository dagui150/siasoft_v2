<script>
    function Radio (radio){
        if (radio.value == "N"){
            document.getElementById('ConfCo_RUBRO1_SOLNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO2_SOLNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO3_SOLNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO4_SOLNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO5_SOLNOM').disabled = true;
            
            document.getElementById('ConfCo_RUBRO1_ORDNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO2_ORDNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO3_ORDNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO4_ORDNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO5_ORDNOM').disabled = true;
            
            document.getElementById('ConfCo_RUBRO1_EMBNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO2_EMBNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO3_EMBNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO4_EMBNOM').disabled = true;
            document.getElementById('ConfCo_RUBRO5_EMBNOM').disabled = true;
        }
        else{
            document.getElementById('ConfCo_RUBRO1_SOLNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO2_SOLNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO3_SOLNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO4_SOLNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO5_SOLNOM').disabled = false;
            
            document.getElementById('ConfCo_RUBRO1_ORDNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO2_ORDNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO3_ORDNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO4_ORDNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO5_ORDNOM').disabled = false;
            
            document.getElementById('ConfCo_RUBRO1_EMBNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO2_EMBNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO3_EMBNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO4_EMBNOM').disabled = false;
            document.getElementById('ConfCo_RUBRO5_EMBNOM').disabled = false;
        }
    }
</script>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'conf-co-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php
		$ver_sol = '';
		$mascaras = ConfCo::model()->findAll();
		foreach($mascaras as $data){
			$ver_sol = $data->ULT_SOLICITUD_M ? $this->widget('CMaskedTextField', array('model' => $model,'attribute' => 'ULT_SOLICITUD','mask' => $data->ULT_SOLICITUD_M), true) : '';
			$ver_ord = $data->ULT_ORDEN_COMPRA_M ? $this->widget('CMaskedTextField', array('model' => $model,'attribute' => 'ULT_ORDEN_COMPRA_M','mask' => $data->ULT_ORDEN_COMPRA_M), true) : '';
			$ver_emb = $data->ULT_EMBARQUE_M ? $this->widget('CMaskedTextField', array('model' => $model,'attribute' => 'ULT_EMBARQUE_M','mask' => $data->ULT_EMBARQUE_M), true) : '';
			$ver_dev = $data->ULT_DEVOLUCION_M ? $this->widget('CMaskedTextField', array('model' => $model,'attribute' => 'ULT_DEVOLUCION_M','mask' => $data->ULT_DEVOLUCION_M), true) : '';
		}
                
                $mascSolicitud = $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'ULT_SOLICITUD_M',
                    'mask' => "SC?99999999",
                    'htmlOptions' => array('size' => 11, 'readonly' => $model->ULT_SOLICITUD_M ? true : false)
                ), true);
                
                $mascOrden = $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'ULT_ORDEN_COMPRA_M',
                    'mask' => "OC?99999999",
                    'htmlOptions' => array('size' => 11, 'readonly' => $model->ULT_ORDEN_COMPRA_M ? true : false)
                ), true);
                
                $mascEmbarque = $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'ULT_EMBARQUE_M',
                    'mask' => "IC?99999999",
                    'htmlOptions' => array('size' => 11, 'readonly' => $model->ULT_EMBARQUE_M ? true : false)
                ), true);
                
	        $mascDevolucion = $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'ULT_DEVOLUCION_M',
                    'mask' => "DC?99999999",
                    'htmlOptions' => array('size' => 11, 'readonly' => $model->ULT_DEVOLUCION_M ? true : false)
                ), true);
	?>
<?php echo $form->HiddenField($model,'ULT_SOLICITUD'); ?>
<?php echo $form->HiddenField($model,'ULT_ORDEN_COMPRA'); ?>
<?php echo $form->HiddenField($model,'ULT_EMBARQUE'); ?>
<?php echo $form->HiddenField($model,'ULT_DEVOLUCION'); ?>
	<?php echo $form->errorSummary($model); ?>
<?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        array('label'=>'General', 'content'=> 
		'<div style="width:100%;"><fieldset>'
		.'<legend>Consecutivos</legend>'
		.'<div style="width:50%; float:left">'
		.'<div class="control-group "><label for="ConfCo_ULT_SOLICITUD_M" class="control-label required">Mascara - Solicitud</label><div class="controls">'.$mascSolicitud.'</div></div>'
                .'<div class="control-group "><label for="ConfCo_ULT_ORDEN_COMPRA_M" class="control-label required">Mascara - Orden compra</label><div class="controls">'.$mascOrden.'</div></div>'
                .'<div class="control-group "><label for="ConfCo_ULT_EMBARQUE_M" class="control-label required">Mascara - Embarque</label><div class="controls">'.$mascEmbarque.'</div></div>'
                .'<div class="control-group "><label for="ConfCo_ULT_DEVOLUCION_M" class="control-label required">Mascara - Devolucion</label><div class="controls">'.$mascDevolucion.'</div></div>'
		.'</div>'
		.'<div style="width:50%; float:right;">'
		.$form->textFieldRow($model,'ULT_SOLICITUD',array('size'=>10,'maxlength'=>10, 'readonly' => true))
		.$form->textFieldRow($model,'ULT_ORDEN_COMPRA',array('size'=>10,'maxlength'=>10, 'readonly' => true))
		.$form->textFieldRow($model,'ULT_EMBARQUE',array('size'=>10,'maxlength'=>10, 'readonly' => true))
		.$form->textFieldRow($model,'ULT_DEVOLUCION',array('size'=>10,'maxlength'=>10, 'readonly' => true))
		.'</div></fieldset></div>'
		.'<div style="width:100%; float:left;"><fieldset>'
		.'<legend>Usar Rubros</legend>'
		.$form->radioButtonListRow($model, 'USAR_RUBROS', array(
        'N'=>'No',
        'S'=>'Si',), array(
        'onchange'=>'Radio(this)',
    	))
		.'</div></fieldset>', 'active'=>true),
		
        array('label'=>'Ordenes', 'content'=>
		'<fieldset>'
		.$form->textFieldRow($model,'MAXIMO_LINORDEN')
		.$form->textAreaRow($model,'ORDEN_OBSERVACION',array('rows'=>6, 'cols'=>50))
		.'</fieldset>'),
		
        array('label'=>'Embarques', 'content'=>
		'<fieldset>'
		.'<legend>Varios</legend>'
		.$form->textFieldRow($model,'POR_VARIAC_COSTO',array('size'=>28,'maxlength'=>28, 'prepend'=>'%'))
		.$form->checkBoxRow($model,'CP_EN_LINEA').'</fieldset>'),
		
		array('label'=>'Varios', 'content'=>
		$form->dropDownListRow($model,'BODEGA_DEFAULT', CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
		.$form->dropDownListRow($model,'IMP1_AFECTA_DESCTO', array('L'=>'Linea', 'A'=>'Ambos descuentos', 'N'=>'Ningun descuento'))
		.'<fieldset><legend>Factor de redondeo</legend>'
		.$form->textFieldRow($model,'FACTOR_REDONDEO',array('size'=>28,'maxlength'=>28))
		.'</fieldset></legend>'
		.'<fieldset><legend>Decimales</legend>'
		.$form->textFieldRow($model,'PRECIO_DEC')
		.$form->textFieldRow($model,'CANTIDAD_DEC').'</fieldset>'),
		
		array('label'=>'Pedidos', 'content'=>
		'<fieldset>'
		.'<legend>Columnas de pedidos</legend>'
		.$form->checkBoxRow($model,'PEDIDOS_SOLICITUD')
		.$form->checkBoxRow($model,'PEDIDOS_ORDEN')
		.$form->checkBoxRow($model,'PEDIDOS_EMBARQUE')
		.'</fieldset>'),
		
		array('label'=>'Direcciones', 'content'=>
		'<fieldset>'
		.$form->textAreaRow($model,'DIRECCION_EMBARQUE',array('rows'=>6, 'cols'=>50))
		.$form->textAreaRow($model,'DIRECCION_COBRO',array('rows'=>6, 'cols'=>50))
		.'</fieldset>'),
		
		array('label'=>'Rubros', 'items'=>array( 
			array('label'=>'Solicitudes', 'content'=>
		'<fieldset>'
		.'<legend>Solicitudes</legend>'
		.$form->textFieldRow($model,'RUBRO1_SOLNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO2_SOLNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO3_SOLNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO4_SOLNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO5_SOLNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.'</fieldset>'),
		
		array('label'=>'Ordenes', 'content'=>
		'<fieldset>'
		.'<legend>Ordenes</legend>'
		.$form->textFieldRow($model,'RUBRO1_ORDNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO2_ORDNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO3_ORDNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO4_ORDNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO5_ORDNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.'</fieldset>'),
		
		array('label'=>'Embarques', 'content'=>
		'<fieldset>'
		.'<legend>Embarques</legend>'
		.$form->textFieldRow($model,'RUBRO1_EMBNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO2_EMBNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO3_EMBNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO4_EMBNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.$form->textFieldRow($model,'RUBRO5_EMBNOM',array('size'=>15,'maxlength'=>15, 'disabled'=>true))
		.'</fieldset>'),
		)),
    ),
)); 

?>
	<div align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('confCo/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->