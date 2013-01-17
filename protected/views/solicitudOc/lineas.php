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
        
        var contador, model,id;
        $('.cambiar').live('dblclick',function(){          
            model = $(this).attr('id').split('_')[0];
            contador = $(this).attr('id').split('_')[1];
            id = '#campo_'+model+'_'+contador;
            $(this).hide('fast');
            $(id).show('fast');
            switch(model){
                case 'cantidad':
                    $('#Nuevo_'+contador+'_CANTIDAD').focus();
                    break;
                case 'unidad':
                    $('#Nuevo_'+contador+'_UNIDAD').focus();
                    break;
            }
                
            
        });
        
        $('.blur').live('blur',function(){
            
            
            contador =  $(this).attr('id').split('_')[1];
            //alert(contador);
            switch(model){
                case 'cantidad':
                    $('#cantidad_'+contador).text($(this).val());
                    $('#campo_cantidad_'+contador).hide('fast');                    
                    $('#cantidad_'+contador).show('fast');
                break;
                case 'unidad':
                    $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
                    $('#campo_unidad_'+contador).hide('fast');
                    $('#unidad_'+contador).show('fast');
                break;
            }
        });
        
        $('.unidad').live('change',function(){
            contador =  $(this).attr('id').split('_')[1];
            var modelo = $(this).attr('id').split('_')[0];
            var nombre = $('#'+modelo+'_'+contador+'_UNIDAD option:selected').html()
            $('#NOMBRE_UNIDAD').val('');
            $('#NOMBRE_UNIDAD').val(nombre);
        });
    
        $('#agregar').click(function(){
            
                $('.clonar').click();
                var contador = $('body').find('.rowIndex').max();
                var model ='Nuevo'; 
                agregarCampos(contador,model);
                $.getJSON('<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+$('#SolicitudOc_ARTICULO').val(),
                    function(data){
                        $('#unidad_'+contador).text($('#NOMBRE_UNIDAD').val());
                        
                        $('select[id$='+model+'_'+contador+'_UNIDAD]>option').remove();
                         
                        $.each(data.UNIDADES, function(value, name) {
                            if(value == $('#SolicitudOc_UNIDAD').val())
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                            else
                               $('#'+model+'_'+contador+'_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                        });
                    });
                $('#carga').ajaxSend(function(){
                    $("#carga").html('<div align="left" style="margin-bottom: 9px; margin-left: 7px;"><?php echo CHtml::image($ruta2);?></div>');
                });
                $('#carga').ajaxComplete(function(){
                    $('#carga').html('');
					$(function() {                    
						$( "#SolicitudOcLinea_FECHA_REQUERIDA" ).datepicker({dateFormat: 'yy-mm-dd'});
						$.datepicker.setDefaults($.datepicker.regional['es']);
					});
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
    
    $('.eliminaLinea').live('click',function(){
        var contador = $(this).attr('name');
        var model = 'Nuevo';       
           
        $('#remover_'+contador).click();
        var contadorMax = $('body').find('.rowIndex').max();        
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){           
            var campos = ['LINEA_NUM','ARTICULO', 'DESCRIPCION','UNIDAD','CANTIDAD','FECHA_REQUERIDA','SALDO','COMENTARIO'];
            var span = ['numero','articulo','descripcion','unidad','cantidad','fecha_requerida','saldo','remover','edit','eliminaLinea','rowIndex'];
            //CAMBIAR IDS DE LOS SPAN
            for(var x =0 ; x<=span.length;x++){
                switch(span[x]){
                    case 'edit':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'eliminaLinea':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'rowIndex':
                         $('[name="'+span[x]+'_'+i+'"]').attr({
                        name: span[x]+'_'+linea,
                        value:linea
                    });
                    break
                }
                $('#'+span[x]+'_'+i).attr('id',span[x]+'_'+linea);
            }
            //CAMBIAR IDS Y NAMES DE LOS CAMPOS DE LAS LINEAS
            for(var y =0 ; y<=campos.length;y++){
               /* alert('editar :'+model+'_'+i+'_'+campos[y]);
                alert('editado :'+model+'_'+linea+'_'+campos[y]);*/
                 $('#'+model+'_'+i+'_'+campos[y]).attr({
                    id: model+'_'+linea+'_'+campos[y],
                    name: model+'['+linea+']['+campos[y]+']'
                });
            }            
            contador++;
            linea++;
        }        
    });
    
    $('.eliminaLineaU').live('click',function(){
        var contador = $(this).attr('name');
        var model = 'SolicitudOcLinea';        
        var numLinea = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
        var eliminar = $('#eliminar').val();
        eliminar = eliminar + $('#SolicitudOcLinea_'+contador+'_SOLICITUD_OC_LINEA').val() + ',';
        $('#eliminar').val(eliminar);
           
        $('#remover_'+contador).click();
        var contadorMax = $('body').find('.rowIndexU').max();        
        var contFor = parseInt(contador, 10)+1;
        var linea = parseInt(contador, 10); 
        //cambiar ids y span
        for(var i = contFor ; i <=contadorMax; i++){           
            var campos = ['LINEA_NUM','ARTICULO', 'DESCRIPCION','UNIDAD','CANTIDAD','FECHA_REQUERIDA','SALDO','COMENTARIO', 'SOLICITUD_OC_LINEA', 'ESTADO'];
            var span = ['numeroU','articuloU','descripcionU','unidadU','cantidadU','fecha_requeridaU','saldoU','removerU','editU','eliminaLineaU','rowIndexU'];
            //CAMBIAR IDS DE LOS SPAN
            for(var x =0 ; x<=span.length;x++){
                switch(span[x]){
                    case 'editU':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'eliminaLineaU':
                        $('#'+span[x]+'_'+i).attr('name',linea);
                    break
                    case 'rowIndexU':
                         $('[name="'+span[x]+'_'+i+'"]').attr({
                        name: span[x]+'_'+linea,
                        value:linea
                    });
                    break
                }
                $('#'+span[x]+'_'+i).attr('id',span[x]+'_'+linea);
            }
            //CAMBIAR IDS Y NAMES DE LOS CAMPOS DE LAS LINEAS
            for(var y =0 ; y<=campos.length;y++){
               /* alert('editar :'+model+'_'+i+'_'+campos[y]);
                alert('editado :'+model+'_'+linea+'_'+campos[y]);*/
                 $('#'+model+'_'+i+'_'+campos[y]).attr({
                    id: model+'_'+linea+'_'+campos[y],
                    name: model+'['+linea+']['+campos[y]+']'
                });
            }            
            contador++;
            linea++;
        }        
    });
	
     function agregarCampos(contador,model){
        
        var articulo = $('#SolicitudOc_ARTICULO').val();
        var descripcion = $('#Articulo_desc').val();
        var cantidad = $('#SolicitudOc_CANTIDAD').val();
        var requerida = $('#SolicitudOc_FECHA_LINEA_REQUERIDA').val();
        var cuentaActualiza = parseInt($('#CAMPO_ACTUALIZA').val(), 10);
        
        //copia a campos ocultos
        $('#'+model+'_'+contador+'_ARTICULO').val(articulo);
        $('#'+model+'_'+contador+'_DESCRIPCION').val(descripcion);
        $('#'+model+'_'+contador+'_CANTIDAD').val(cantidad);
        $('#'+model+'_'+contador+'_FECHA_REQUERIDA').val(requerida);
        $('#'+model+'_'+contador+'_SALDO').val(0);
        $('#'+model+'_'+contador+'_ESTADO').val('P')
        $('#'+model+'_'+contador+'_COMENTARIO').val('');
        $('#SolicitudOc_UNIDAD').clone().appendTo('#'+model+'_'+contador+'_UNIDAD');
        $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+articulo,
            
		  function(data)
                  {                        
                        $('select[id$='+model+'_'+contador+'_UNIDAD]>option').remove();

                        $.each(data.UNIDADES, function(value, name) {
                                if(value == data.UNIDAD)
                                  $('#'+model+'_'+contador+'_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                else
                                   $('#'+model+'_'+contador+'_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                            });
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
		  });
        
        //copia a spans para visualizar detalles
        $('#numero_'+contador).text(parseInt(contador, 10) + 1 + cuentaActualiza);
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
                                    <td width="180px">
                                        Descripcion
                                    </td>
                                    <td width="130px">
                                        Unidad
                                    </td>
                                    <td width="100px">
                                        Cantidad
                                    </td>
                                    <td width="120px">
                                        Requerida
                                    </td>
                                    <td width="50px">
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
                                                     $this->darBotonAddLinea(false,$htmlOptions);
                                                 ?></div>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>
                                                    <span id="numero_<?php echo '{0}';?>"></span>
                                                    <span id='campo_numero_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][LINEA_NUM]','',array('readonly'=>true, 'size'=>'5')); ?></span>
                                                </td>
                                                <td>
                                                    <span id="articulo_<?php echo '{0}';?>"></span>
                                                    <span id='campo_articulo_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][ARTICULO]','',array()); ?></span>
                                                </td>
                                                
                                                <td>
                                                    <span id="descripcion_<?php echo '{0}';?>"></span>
                                                    <span id='campo_descripcion_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][DESCRIPCION]','',array()); ?></span>
                                                </td>
                                                <td>
                                                    <span id="unidad_<?php echo '{0}';?>" class="cambiar"></span>
                                                    <span id='campo_unidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::dropDownList('Nuevo[{0}][UNIDAD]','',array('prompt'=>'Seleccione articulo', 'class'=>'blur unidad')); ?></span>
                                                    <?php echo CHtml::hiddenField('Nuevo[{0}][ESTADO]','',array()); ?>
                                                </td>
                                                <td>
                                                    <span id="cantidad_<?php echo '{0}';?>" class="cambiar"></span>
                                                    <span id='campo_cantidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][CANTIDAD]','',array('class'=>'blur decimal')); ?></span>
                                                </td>
                                                <td>
                                                    <span id="fecha_requerida_<?php echo '{0}';?>"></span>
                                                    <span id='campo_fecha_requerida_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][FECHA_REQUERIDA]','',array('class'=>'blur fecha_requerida')); ?>
                                                    <?php echo CHtml::hiddenField('Nuevo[{0}][COMENTARIO]','',array()); ?>
                                                </td>
                                                <td>
                                                    <span id="saldo_<?php echo '{0}';?>"></span>
                                                    <span id='campo_cantidad_<?php echo '{0}';?>' style="display:none;"><?php echo CHtml::textField('Nuevo[{0}][SALDO]','',array()); ?></span>
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
                                                        <div style="float: left; margin-left: 5px;">
                                                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                         'buttonType'=>'button',
                                                                         'type'=>'danger',                                                                        
                                                                         'icon'=>'minus white',
                                                                         'htmlOptions'=>array('id'=>'eliminaLinea_{0}','class'=>'eliminaLinea','name'=>'{0}')
                                                                     ));
                                                               ?>
                                                        </div>
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
                                        <?php echo '<span id="numeroU_'.$i.'">'.$item->LINEA_NUM.'</span>'; ?>
                                        <?php echo  CHtml::activeHiddenField($item,"[$i]LINEA_NUM",array()); ?>                                       
                                    </td>
                                    <td>
                                        <?php echo '<span id="articuloU_'.$i.'">'.$item->ARTICULO.'</span>'; ?>
                                        <?php echo  CHtml::activeHiddenField($item,"[$i]ARTICULO", array()); ?>                                        
                                    </td>
                                    <td>
                                        <?php echo '<span id="descripcionU_'.$i.'">'.$item->DESCRIPCION.'</span>'; ?>
                                        <?php echo  CHtml::activeHiddenField($item,"[$i]DESCRIPCION",array()); ?>                                        
                                    </td>
                                    <td>
                                        <?php echo '<span id="unidadU_'.$i.'">'.$item->uNIDAD->NOMBRE.'</span>'; ?>
                                        <div style="display:none;"><?php echo CHtml::activeDropDownList($linea,"[$i]UNIDAD",CHtml::listData(UnidadMedida::model()->findAll('ACTIVO = "S" AND TIPO = "'.$item->uNIDAD->TIPO.'"'), 'ID', 'NOMBRE'),array('style'=>'width:65px;', 'options'=>array($item->UNIDAD => array('selected'=>'selected')))); ?></div>                                        
                                    </td>
                                    <td>
                                        <?php echo '<span id="cantidadU_'.$i.'">'.$item->CANTIDAD.'</span>'; ?>
                                        <?php echo  CHtml::activeHiddenField($item,"[$i]CANTIDAD",array()); ?>
                                    </td>
                                    <td>
                                        <?php echo '<span id="fecha_requeridaU_'.$i.'">'.$item->FECHA_REQUERIDA.'</span>'; ?>
                                        <?php echo  CHtml::activeHiddenField($item,"[$i]FECHA_REQUERIDA",array()); ?>
                                         <?php echo  CHtml::activeHiddenField($item,"[$i]COMENTARIO",array()); ?>
                                    </td>
                                    <td>
                                        <?php echo '<span id="saldoU_'.$i.'">'.$item->SALDO.'</span>'; ?>
                                        <?php echo  CHtml::activeHiddenField($item,"[$i]SALDO",array()); ?>
                                         <?php echo  CHtml::activeHiddenField($item,"[$i]SOLICITUD_OC_LINEA",array()); ?>
                                    </td>
                                                <td>
                                                    <span style="float: left">
                                                <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                                 'buttonType'=>'button',
                                                                 'type'=>'normal',
                                                                 'icon'=>'pencil',
                                                                 'htmlOptions'=>array('class'=>'editU','name'=>"$i",'id'=>"editU_$i")
                                                             ));
                                                ?>
                                            </span>
                                           <div class="remove" id ="removerU" style="float: left; margin-left: 5px;">
                                                      <?php $this->widget('bootstrap.widgets.TbButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',                                                             
                                                             'icon'=>'minus white',
                                                             'htmlOptions'=>array('id'=>"eliminaLineaU_$i",'class'=>'eliminaLineaU','name'=>"$i")
                                                         ));
                                                   ?>
                                           </div>
                                        <?php echo CHtml::hiddenField("rowIndexU_$i", $i, array('class'=>'rowIndexU')); ?>
                                                </td>
                                            </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                <?php $model->isNewRecord ? $i=0 : $i++; ?>  
                <?php echo CHtml::HiddenField('CAMPO_ACTUALIZA', $i); ?>
                <?php echo CHtml::HiddenField('oculto',''); ?>
                <?php echo CHtml::HiddenField('eliminar',''); ?>
                <?php echo CHtml::HiddenField('NAME', ''); ?>