<script>
	$(".tonces").live("change", function (e) {
            var nombreDescripcion = 'Articulo_desc';
            var contador = $('body').find('.rowIndex').max();
            $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+$(this).attr('value'),
            
		  function(data)
                  {
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('select[id$=SolicitudOc_UNIDAD]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#SolicitudOc_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#SolicitudOc_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
		  });
    });

$(document).ready(function(){
        $('#agregar').click(function(){
            
                $('.clonar').click();
                var contador = $('body').find('.rowIndex').max();
                var model ='Nuevo'; 
                agregarCampos(contador,model);
                $('#carga').ajaxSend(function(){
                    $("#carga").html('<div align="left" style="margin-bottom: 9px; margin-left: 7px;"><?php echo CHtml::image($ruta2);?></div>');
                });
                $('#carga').ajaxComplete(function(){
                    $('#carga').html('');
                });
     });
    }) 

    function cargaArticuloGrilla (grid_id){
       var att = $.fn.yiiGridView.getSelection(grid_id);       
       var nombreDescripcion = 'Articulo_desc'; 
       var articulo = 'SolicitudOc_ARTICULO';
            $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+att,
            
		  function(data)
                  {                        
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + articulo).val(data.ID);
                        $('select[id$=SolicitudOc_UNIDAD]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#SolicitudOc_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#SolicitudOc_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
		  });
    }
	
	function Eliminar (id){
		var eliminar = $('#eliminar').get(0).value;
		var cuentaLineas;
		
		eliminar = eliminar + id + ",";
		$('#eliminar').val(eliminar);
		cuentaLineas = $('#contadorCrea').val();
		
		if (cuentaLineas <= '1'){
			$('#remover').removeClass('remove');
		}
		else{
			cuentaLineas = parseInt(cuentaLineas, 10) - 1;
			$('#contadorCrea').val(cuentaLineas);
		}
	}
     function agregarCampos(contador,model){
        
        var articulo = $('#SolicitudOc_ARTICULO').val();
        var descripcion = $('#Articulo_desc').val();
        var cantidad = $('#SolicitudOc_CANTIDAD').val();
        var requerida = $('#SolicitudOc_FECHA_LINEA_REQUERIDA').val();
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_FECHA_REQUERIDA').val(requerida);
        $('#'+model+'_'+contador+'_SALDO').val(0);
        $('#'+model+'_'+contador+'_ESTADO').val('P')
        $('#'+model+'_'+contador+'_COMENTARIO').val('');
        $('#SolicitudOc_UNIDAD').clone().appendTo('#'+model+'_'+contador+'_UNIDAD');
        
        //copia a spans para visualizar detalles
        $('#numero_'+contador).text(parseInt(contador, 10) + 1);
        $('#articulo_'+contador).text(articulo);
        $('#descripcion_'+contador).text(descripcion);
        $('#fecha_requerida_'+contador).text(requerida);
        $('#cantidad_'+contador).text(cantidad);
        $('#saldo_'+contador).text(0);
        $('#porcdescuento_'+contador).text(0);
        $('#monto_descuento_'+contador).text(0);
        $('#unidad_'+contador).text($('#SolicitudOc_UNIDAD option:selected').html());
    }
</script>
<?php
    // lineas para playground
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<table style="margin-left: -100px;">
    <tr>
        <td>
            <?php echo $form->textFieldRow($model,'ARTICULO',array('size'=>15, 'class'=>'tonces')); ?>
        </td>
        <td>
            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#articulo',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => '{0}'),
             )); ?>
        </td>
        <td>
            <?php echo CHtml::textField('Articulo_desc','',array('readonly'=>true,'size'=>20)); ?>
        </td>
        <td>
            <table style="margin-left: -100px;margin-top:-4px;">
                <tr>
                    <td>
                        <?php echo $form->textFieldRow($model,'CANTIDAD',array('size'=>4)); ?>
                    </td>
                </tr>
            </table>
        </td>       
        <td>
            <table style="margin-left: -100px;margin-top:-4px; width: 300px">
                <tr>
                    <td>
                        <div class="control-group "><label for="SolicitudOc_FECHA_LINEA_REQUERIDA" class="control-label required">Requerida</label><div class="controls">
                        <?php
                        $tab = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'attribute'=>'FECHA_LINEA_REQUERIDA',
                            'model'=>$model,
                            'language'=>'es',
                            'options'=>array(
                                    'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
                                    'dateFormat'=>'yy-mm-dd',
                                    'changeMonth'=>true,
                                    'changeYear'=>true,
                                    'showOn'=>'focus', // 'focus', 'button', 'both'
                                    'buttonText'=>false, 
                                    'buttonImage'=>false, 
                                    'buttonImageOnly'=>false,
                            ),
                            'htmlOptions'=>array(
                                'style'=>'width:20px;vertical-align:top',
                                'size'=>'9',                                
                            ),  
                        ));
                        ?>
                        </div></div>
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <?php echo $form->dropDownList($model,'UNIDAD',array(),array('empty'=>'Seleccione','style'=>'width: 120px; display: none'));?>
            <?php echo CHtml::hiddenField('NOMBRE_UNIDAD','');?>
            <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'button',
                    'type'=>'success',
                    'icon'=>'white plus',
                    'size'=>'mini',
                    'htmlOptions'=>array('id'=>'agregar','style'=>'margin-top: 5px;')
                    ));    
            ?> 
        </td>
    </tr>
</table>
<span id="carga" style="height:30px;width:30px;"></span>
                        <table class="templateFrame grid table table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>
                                        #
                                    </td>                                    
                                    <td>
                                        Articulo
                                    </td>
                                    <td>
                                        Descripcion
                                    </td>
                                    <td>
                                        Unidad
                                    </td>
                                    <td>
                                        Cantidad
                                    </td>
                                    <td>
                                        Requerida
                                    </td>
                                    <td>
                                       Saldo
                                    </td>
                                    <td>
                                        &nbsp;
                                    </td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <div id="add" class="add">
                                                <?php 
                                                     $htmlOptions = array('class'=>'clonar', 'style'=>'display:none');
                                                     $this->darBoton(false, 'success', 'normal', false, 'plus white',$htmlOptions);
                                                 ?>
                                                <?php 
						/*$this->widget('bootstrap.widgets.BootButton', array(
							'buttonType'=>'button',
							'type'=>'success',
							'label'=>'Nuevo',
							'icon'=>'plus white',
							'htmlOptions' => array('class'=>'clonar', 'style'=>'display:none'),
                                                ));*/
									   ?></div>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>
                                                    <span id="numero_<?php echo '{0}';?>"></span>
                                                    <span id='campo_numero_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][LINEA_NUM]','',array('readonly'=>true, 'size'=>'5')); ?></span>
                                                </td>
                                                <td>
                                                    <span id="articulo_<?php echo '{0}';?>"></span>
                                                    <span id='campo_articulo_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][ARTICULO]','',array('class' => 'tonces')); ?></span>
                                                </td>
                                                
                                                <td>
                                                    <span id="descripcion_<?php echo '{0}';?>"></span>
                                                    <span id='campo_descripcion_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][DESCRIPCION]','',array('class' => 'required')); ?></span>
                                                </td>
                                                <td>
                                                    <span id="unidad_<?php echo '{0}';?>"></span>
                                                    <span id='campo_unidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::dropDownList('Nuevo[{0}][UNIDAD]','',array('prompt'=>'Seleccione articulo')); ?></span>
                                                    <?php echo CHtml::hiddenField('Nuevo[{0}][ESTADO]','',array()); ?>
                                                </td>
                                                <td>
                                                    <span id="cantidad_<?php echo '{0}';?>"></span>
                                                    <span id='campo_cantidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][CANTIDAD]','',array('size'=>'5', 'class' => 'cantidad','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')); ?></span>
                                                </td>
                                                <td>
                                                    <span id="fecha_requerida_<?php echo '{0}';?>"></span>
                                                    <span id='campo_fecha_requerida_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][FECHA_REQUERIDA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                    <?php echo CHtml::hiddenField('Nuevo[{0}][COMENTARIO]','',array()); ?>
                                                </td>
                                                <td>
                                                    <span id="saldo_<?php echo '{0}';?>"></span>
                                                    <span id='campo_cantidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][SALDO]','',array('readonly'=>true, 'size'=>'5')); ?></span>
                                                </td>
                                                <td>
                                                    <span style="float: left">
                                                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                         'buttonType'=>'button',
                                                                         'type'=>'normal',                                                                         
                                                                         'icon'=>'pencil',
                                                                         'htmlOptions'=>array('class'=>'edit','name'=>'{0}','id'=>'edit_{0}')
                                                                     ));
                                                        ?>
                                                    </span>
                                                    <div id="remover" class="remove">
                                                        <?php 
                                                
                                                            $this->widget('bootstrap.widgets.TbButton', array(
                                                                    'buttonType'=>'button',
                                                                    'type'=>'danger',                                                                    
                                                                    'label'=>'',
                                                                    'icon'=>'minus white',
                                                                    'size' => 'normal',                                                                    
                                                                    
                                                              ));
                                                         ?>
                                                    </div>
                                                    <input type="hidden" class="rowIndex" value="{0}" />
                                                </td>
                                            </tr>
                                        </textarea>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody class="templateTarget">
                                <?php if(!$model->isNewRecord) : ?>
                                    <?php foreach($items as $i=>$item): ?>
                                
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($item,"[$i]ARTICULO", array('class'=>'tonces2', 'readonly'=>$readonly)); ?>
                            		</td>
                                    <td>
                                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo2',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => "$i", 'disabled'=>$readonly),
                                                        )); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]DESCRIPCION",array('class'=>'required', 'readonly'=>$readonly)); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($item,"[$i]UNIDAD", $linea->getCombo($item->ARTICULO), array('prompt'=>'Seleccione articulo', 'disabled'=>$readonly)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]ESTADO",array('readonly'=>true, 'size'=>'1')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]CANTIDAD",array('size'=>'5', 'class' => 'cantidad','onkeyup'=>'formato(this)', 'onchange'=>'formato(this)', 'readonly'=>$readonly)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]FECHA_REQUERIDA",array('class' => 'fecha', 'size'=>'10', 'readonly'=>$readonly)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]COMENTARIO",array('readonly'=>$readonly)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]SALDO",array('readonly'=>true, 'size'=>'5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]LINEA_NUM",array('readonly'=>true, 'size'=>'2')); ?>
                            <?php echo $form->hiddenField($item,"[$i]SOLICITUD_OC_LINEA",array()); ?>
                        </td>
                                    <td>
                                        <span style="float: left">
                                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                 'buttonType'=>'button',
                                                                 'type'=>'normal',                                                                 
                                                                 'htmlOptions'=>array('class'=>'editU','name'=>"$i",'id'=>"editU_$i")
                                                             ));
                                                ?>
                                       </span>
                                        <div id="remover" class="remove">
                                              <?php 
                                                
                                                 $this->widget('bootstrap.widgets.TbButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',                                                             
                                                             'label'=>'',
                                                             'icon'=>'minus white',
                                                             'htmlOptions' => array('id'=>$item["SOLICITUD_OC_LINEA"], 'onClick'=>'Eliminar(id)', 'disabled'=>$readonly),
                                                  ));

                                             ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                <?php $model->isNewRecord ? $i=0 : $i++; ?>
                <?php echo CHtml::HiddenField('contadorCrea', $i); ?>
                <?php echo CHtml::HiddenField('oculto',''); ?>
                <?php echo CHtml::HiddenField('eliminar',''); ?>
                <?php echo CHtml::HiddenField('siempreSuma', $i); ?>