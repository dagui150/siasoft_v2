<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>
<script>
$(document).ready(function() {
	// validate the comment form when it is submitted
	$("#solicitud-oc-form").validate();
        $('.edit').live('click',function(){
                $('#SPAN').val('');
                $('#NAME').val($(this).attr('name'));
                actualiza();
        });
        $('.editU').live('click',function(){
                $('#SPAN').val('U');
                $('#NAME').val($(this).attr('name'));
                actualiza();
        });
        $(function() {                    
            $( "#SolicitudOcLinea_FECHA_REQUERIDA" ).datepicker({dateFormat: 'yy-mm-dd'});
            $.datepicker.setDefaults($.datepicker.regional['es']);
        });
        if($('#readonly').val() == 'true'){
            $('#oculta-cancela').hide('fast');
            $('#alert-cancela').show('fast');
        }
});
</script>
<?php
    ($model->ESTADO != 'C') ? $readonly = false : $readonly = true;
    echo CHtml::hiddenField('readonly', ($model->ESTADO != 'C') ? 'false' : 'true');
?>
 <div class="form">
    
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'solicitud-oc-form',
	'type'=>'horizontal',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                  'validateOnSubmit'=>true,
             ),	
)); ?>

    <?php 
    // Boton modal
    $boton = $this->darBotonBuscar('#articulo',true); ?>
    
        <?php 
        // Validacion de Rubros en la configuracion        
         if($config->USAR_RUBROS == "S") {
                    $rubros = '<div class="row">';
                    if($config->RUBRO1_SOLNOM != ''){
                        $rubros .= '<label>'.$config->RUBRO1_SOLNOM.'</label>'
                        .$form->textField($model,'RUBRO1',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO1')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO2_SOLNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO2_SOLNOM.'</label>'
                        .$form->textField($model,'RUBRO2',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO2')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO3_SOLNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO3_SOLNOM.'</label>'
                        .$form->textField($model,'RUBRO3',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO3')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO4_SOLNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO4_SOLNOM.'</label>'
                        .$form->textField($model,'RUBRO4',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO4')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO5_SOLNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO5_SOLNOM.'</label>'
                        .$form->textField($model,'RUBRO5',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO5');                        
                    }
                    $rubros .= '</div>';
         }
         else{
             $rubros='<div id="alert-info" class="alert alert-info">
                        <img src="'.Yii::app()->baseUrl.'/images/warning.png'.'" style="margin-right: 20px;" />Para usar esta opcion debes habilitarla en configuracion
                      </div>';
         }
?>
    
    
        <?php
        // Campos de fecha
        
		$tab = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'attribute'=>'FECHA_SOLICITUD',
                'model'=>$model,
		'language'=>'es',
		'options'=>array(
			'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'dateFormat'=>'yy-mm-dd',
			'changeMonth'=>true,
			'changeYear'=>true,
			'showOn'=>'both', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'), 
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif', 
			'buttonImageOnly'=>true,
		),
                    'htmlOptions'=>array(
                        'style'=>'width:80px;vertical-align:top',
                        'disabled' => $readonly
                    ),  
                ), true); 
                
		$tab2 = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'attribute'=>'FECHA_REQUERIDA',
                'model'=>$model,
		'language'=>'es',
		'options'=>array(
			'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'dateFormat'=>'yy-mm-dd',
			'changeMonth'=>true,
			'changeYear'=>true,
			'showOn'=>'both', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'), 
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif', 
			'buttonImageOnly'=>true,
		),
                    'htmlOptions'=>array(
                        'style'=>'width:80px;vertical-align:top',
                        'disabled' => $readonly
                    ),  
                ), true); ?>

<?php       
            if($model->SOLICITUD_OC == ''){
                $mascara = $config->ULT_SOLICITUD_M;
                $retorna = substr($mascara,0,2);
                $mascara = strlen($mascara);
                $longitud = $mascara - 2;
                $sql = "SELECT count(SOLICITUD_OC) FROM solicitud_oc";
                $consulta = SolicitudOc::model()->findAllBySql($sql);
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $row=$command->queryRow();
                $bandera=$row['count(SOLICITUD_OC)'];
                $retorna .= str_pad($bandera, $longitud, "0", STR_PAD_LEFT);
                
                
                $render = 'lineas';
                $items = '';
                $pestana = $this->renderPartial($render, array('form'=>$form, 'linea'=>$linea, 'items'=>$items, 'model'=>$model, 'readonly'=>$readonly, 'form'=>$form, 'ruta2'=>$ruta2),true);
            }
            else{
                $retorna = $model->SOLICITUD_OC;
                $render = 'lineas';
                $pestana = $this->renderPartial($render, array('form'=>$form, 'linea'=>$linea, 'items'=>$items, 'ruta2'=>$ruta2, 'model'=>$model, 'readonly'=>$readonly),true);
            }
?>
    <div id="alert-cancela" class="alert alert-warning" style="display: none">
        <img src="<?php echo Yii::app()->baseUrl.'/images/warning.png'; ?>" style="margin-right: 20px;" />No se puede actualizar una solicitud en estado cancelada
    </div>
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
                <?php
                switch ($model->ESTADO){
                    case 'N':
                        echo $form->hiddenField($model,'ESTADO');
                        echo CHtml::textField('Estado','No Asignado',array('readonly'=>true));
                    break; 
                    case 'A':
                        echo $form->hiddenField($model,'ESTADO');
                        echo CHtml::textField('Estado','Asignado',array('readonly'=>true));
                    break;
                    default:
                        echo $form->hiddenField($model,'ESTADO',array('value'=>'P'));
                        echo CHtml::textField('Estado','Planeada',array('readonly'=>true));
                    break;
                    } 
                    
               ?>
		<?php echo $form->error($model,'ESTADO'); ?>
	</div>
            </td>
        </tr>

    

    </table>
    
	<?php echo $form->errorSummary($model); ?>

        <?php $this->widget('bootstrap.widgets.TbTabs', array(
            'type'=>'tabs', // 'tabs' or 'pills'
            'tabs'=>array(
                array('label'=>'Líneas', 'content'=>
                    $pestana
                    , 'active'=>true),
               
                array('label'=>'General', 'content'=>
                    '<div class="row">
                        <table>
                            <tr>
                                <td width="50%">'
                    .$form->labelEx($model,'DEPARTAMENTO')
                    .$form->dropDownList($model,'DEPARTAMENTO', CHtml::listData(Departamento::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...', 'disabled'=>$readonly))
                    .$form->error($model,'DEPARTAMENTO')
                    .'</td>'
                    .'<td>'
                    .'<b>Fecha Solicitud:</b> '.$tab.' '.$form->error($model,'FECHA_SOLICITUD').''
                    .'</div>'
                    .'<div class="row">
                        <tr>
                            <td>'
                    .$form->labelEx($model,'PRIORIDAD')
                    .$form->dropDownList($model,'PRIORIDAD',array('A'=>'Alta','M'=>'Media','B'=>'Baja'), array('disabled' => $readonly))
                    .$form->error($model,'PRIORIDAD')
                            .'</td><td>'
                    .'<b>Fecha Requerida:</b> '.$tab2.' '.$form->error($model,'FECHA_REQUERIDA').''
                    .'</td></tr></table></div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'COMENTARIO')
                    .$form->textArea($model,'COMENTARIO',array('rows'=>6, 'cols'=>50, 'readonly' => $readonly))
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
                    array('label'=>'Campos adicionales', 'content'=>$rubros),
                
            ),
        )); ?>
        
	<div align="center">
            <?php if($readonly == false){ ?>
                <?php $this->darBotonEnviar($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php } ?>    
            <?php $this->darBotonCancelar(); ?>
	</div>

<?php $this->endWidget(); ?>
   
     <?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'articulo')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php
            $funcion = 'cargaArticuloGrilla';
            $id = 'articulo-grid';
            $data=$articulo->searchModal();
            $this->renderPartial('/articulo/articulos', array('articulo'=>$articulo,'funcion'=>$funcion,'id'=>$id,'check'=>false,'data'=>$data));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>
     
     <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'nuevo')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Línea</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
        <div id="form-lineas">
            <?php  $this->renderPartial('modal', 
                        array(
                            'model'=>$model,
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    ); ?>
        </div>
 
<?php $this->endWidget(); ?>

</div><!-- form -->