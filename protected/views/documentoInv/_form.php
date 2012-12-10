<script>
    $(document).ready(inicio);
    
    function inicio(){
        
        <?php if(!$model->isNewRecord):?>
                var contador = $('#contador').val();
                var maxLineas = $('#maxLineas').val();

                if(contador == maxLineas)
                    $('#btn-nuevo').attr('disabled',true);
            
                $.getJSON('<?php echo $this->createUrl('cargarconsecutivo')?>&id='+$('#DocumentoInv_CONSECUTIVO').val(),
                    function(data){
                        
                        $('#consecutivo').val($('#DocumentoInv_CONSECUTIVO').val());

                        $('select[id$=DocumentoInvLinea_TIPO_TRANSACCION ] > option').remove();
                        $('#DocumentoInvLinea_TIPO_TRANSACCION').append("<option value=''>Seleccione</option>");

                        $.each(data.TIPO_TRANSACCION, function(value, name) {
                              $('#DocumentoInvLinea_TIPO_TRANSACCION').append("<option value='"+value+"'>"+name+"</option>");
                        });
                    }
                );
        <?php endif?>
        
        $('#DocumentoInv_CONSECUTIVO').change(function(){
            $.getJSON('<?php echo $this->createUrl('cargarconsecutivo')?>&id='+$(this).val(),
                function(data){
                    
                    $('#DocumentoInv_DOCUMENTO_INV').val(data.SIGUIENTE_VALOR);
                    $('#consecutivo').val($(this).val());
                    
                }
            );
        });
        
        $('#btn-nuevo').click(cargarTipos);
        
    }
    
    function cargarTipos(){
        $.getJSON('<?php echo $this->createUrl('cargarconsecutivo')?>&id='+$('#DocumentoInv_CONSECUTIVO').val(),
                function(data){
                    $('#consecutivo').val($('#DocumentoInv_CONSECUTIVO').val());
                    
                    $('select[id$=DocumentoInvLinea_TIPO_TRANSACCION ] > option').remove();
                    $('#DocumentoInvLinea_TIPO_TRANSACCION').append("<option value=''>Seleccione</option>");

                    $.each(data.TIPO_TRANSACCION, function(value, name) {
                          $('#DocumentoInvLinea_TIPO_TRANSACCION').append("<option value='"+value+"'>"+name+"</option>");
                    });
                }
            );
        
        
    }

</script>

<div class="form" >

<?php 
    $cs=Yii::app()->clientScript;
            $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
            $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
            $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
            
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id'=>'documento-inv-form',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
            ),
            'type'=>'horizontal',
    )); 
    echo '<br>'.$form->errorSummary($model);
    $calendario = $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                              'model'=>$model,
                              'attribute'=>'FECHA_DOCUMENTO',
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
                              'htmlOptions'=>array('style'=>'width:80px;vertical-align:top',),
                ),true);
?>

        <table>
            <tr>
                <td>
                    <div align="left" style="width: 60px;">
                        <?php echo $form->dropDownListRow($model,'CONSECUTIVO',CHtml::ListData(ConsecutivoCi::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione','disabled'=>$model->isNewRecord ? false :true)); ?>
                    </div>
                </td>
                <td>
                    <div align="left" style="width: 120px;;">
                        <?php echo $form->textFieldRow($model,'DOCUMENTO_INV',array('readonly'=>true));?>
                    </div>
                </td>
            </tr>
           
        </table>
        
	<?php
            
            $this->widget('bootstrap.widgets.BootTabbable', array(
                        'type'=>'tabs',
                        'tabs'=>array(
                            array(
                                'label'=>'Documento',
                                'content'=>
                                    $form->labelEx($model,'FECHA_DOCUMENTO',array('class'=>'control-label'))
                                    .'<div class="controls">'
                                        .$calendario
                                        .'<br>'
                                        .$form->error($model,'FECHA_DOCUMENTO')
                                 .'</div>'
                                    .$form->textAreaRow($model,'REFERENCIA',array('style'=>'width: 500px; height: 100px;'))
                                    .$form->hiddenField($model,'ESTADO',array('value'=>'P'))
                                ,   
                                'active'=>true
                            ),
                           array(
                                'label'=>'Lineas',
                                'content'=>
                                        $this->renderPartial('lineas',
                                                array(
                                                    'form'=>$form,
                                                    'model'=>$model,
                                                    'modelLi'=>$modelLi,
                                                    'modelLinea'=>$model->isNewRecord ? '' : $modelLinea,
                                                    'countLineas'=>$model->isNewRecord ? 0 : $countLineas
                                                ),true),
                           ),
                        ),
            ));
            
         ?>
	<div class="row buttons" align="center">
              <?php
                     $this->widget('bootstrap.widgets.BootButton', array(
                               'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
                               'buttonType'=>'submit',
                               'type'=>'primary',
                               'icon'=>'ok-circle white',
                               'id'=>'enviar'
                            )
                    );
                    
             ?>
              <?php
                   $this->widget('bootstrap.widgets.BootButton', array(
                                   'label'=>'Cancelar',
                                   'type'=>'action',
                                   'icon'=>'remove ', 
                                   'url'=>array('admin'),
                                )
                    );
             ?>
      </div>

<?php $this->endWidget(); ?>

</div>
 
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'nuevo')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Nueva Linea</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
        <div id="form-lineas">
            <?php  $this->renderPartial('_form_lineas', 
                        array(
                            'model'=>$model,
                            'modelLi'=>$modelLi,
                            'bodega'=>$bodega,
                            'articulo'=>$articulo,
                            'countLineas'=>$model->isNewRecord ? 0 :$countLineas,
                            'ruta'=>$ruta,
                        )
                    ); ?>
        </div>
 
<?php $this->endWidget(); ?>

<?php
    //MODAL DE LAS BODEGAS
     $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id'=>'bodega',
                'options'=>array(
                    'title'=>'Bodegas',
                    'width'=>550,
                    'height'=>'auto',
                    'autoOpen'=>false,
                    'resizable'=>false,
                    'modal'=>true,
                    'zIndex'=>1200,
                    'overlay'=>array(
                        'backgroundColor'=>'#000',
                        'opacity'=>'0.5'
                    ),
                    'buttons'=>array(
                        'Aceptar'=>'js:function(){$(this).dialog("close");}',
                    ),
                ),
     )); 
            $funcion = 'updateCampos';
            $id = 'bodega-grid';
            echo $this->renderPartial('/bodega/bodegas', array('bodega'=>$bodega,'funcion'=>$funcion,'id'=>$id,'check'=>true));

   $this->endWidget('zii.widgets.jui.CJuiDialog');
    //MODAL DE LAS BODEGAS DESTINO
     $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id'=>'bodega_destino',
                'options'=>array(
                    'title'=>'Bodegas',
                    'width'=>550,
                    'height'=>'auto',
                    'autoOpen'=>false,
                    'resizable'=>false,
                    'modal'=>true,
                    'zIndex'=>1200,
                    'overlay'=>array(
                        'backgroundColor'=>'#000',
                        'opacity'=>'0.5'
                    ),
                    'buttons'=>array(
                        'Aceptar'=>'js:function(){$(this).dialog("close");}',
                    ),
                ),
     )); 
            $funcion = 'updateCampos';
            $id = 'bodega-grid-destino';
            echo $this->renderPartial('/bodega/bodegas', array('bodega'=>$bodega,'funcion'=>$funcion,'id'=>$id,'check'=>true));

   $this->endWidget('zii.widgets.jui.CJuiDialog');
    //MODAL DE LOS ARTICULOS
     $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id'=>'articulo',
                'options'=>array(
                    'title'=>'Articulos',
                    'width'=>550,
                    'height'=>'auto',
                    'autoOpen'=>false,
                    'resizable'=>false,
                    'modal'=>true,
                    'zIndex'=>1200,
                    'overlay'=>array(
                        'backgroundColor'=>'#000',
                        'opacity'=>'0.5'
                    ),
                    'buttons'=>array(
                        'Aceptar'=>'js:function(){$(this).dialog("close");}',
                    ),
                ),
     )); 
            $funcion = 'updateCampos';
            $id = 'articulo-grid';
            echo $this->renderPartial('/articulo/articulos', array('articulo'=>$articulo,'funcion'=>$funcion,'id'=>$id,'check'=>true));

   $this->endWidget('zii.widgets.jui.CJuiDialog');
?>