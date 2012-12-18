<script>
$(document).ready(function(){
    inicio();
});

function inicio(){ 
        $('.edit').live('click',actualiza);
    
        $('#Pedido_CONSECUTIVO').change(function(){
            $.getJSON('<?php echo $this->createUrl('/factura/cargarconsecutivo')?>&id='+$(this).val(),
                function(data){
                    
                    $('#Pedido_PEDIDO').val(data.VALOR);
                    
                }
            );
        });
        
    $('#Pedido_ARTICULO').change(function(){
            $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+$(this).val(),
                function(data){
                    $("#Articulo_desc").val(data.NOMBRE);
                    $('select[id$=Pedido_UNIDAD]>option').remove();                    
                    $.each(data.UNIDADES, function(value, name) {
                            if(value == data.UNIDAD)
                              $('#Pedido_UNIDAD').append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                            else
                               $('#Pedido_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                        });
                    $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
                    $('#agregar').attr('disabled', false);
                    
                }
            );
        });
        
    $('#Pedido_CLIENTE').change(function(){
            $.getJSON('<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+$(this).val(),
                function(data){
                    $("#Cliente_desc").val(data.NOMBRE);
                    
                }
            );
        });   
}

function cargaGrilla(grid_id){
    var ID = $.fn.yiiGridView.getSelection(grid_id);
    var url;
    var campo;
    var campo_nombre;
    
    if (grid_id == 'cliente-grid'){
        url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+ID;
        campo = '#Pedido_CLIENTE';
        campo_nombre = '#Cliente_desc';
    }
    else if (grid_id == 'articulo-grid'){
        url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+ID;
        campo = '#Pedido_ARTICULO';
        campo_nombre = '#Articulo_desc';
        $('#agregar').attr('disabled', false);
    }
    $.getJSON(url,function(data){
                $(campo).val(ID);
                $(campo_nombre).val(data.NOMBRE); 
                if(data.UNIDAD){
                    
                     $('select[id$=Pedido_UNIDAD]>option').remove();
                    
                    $.each(data.UNIDADES, function(value, name) {
                              $('#Pedido_UNIDAD').append("<option value='"+value+"'>"+name+"</option>");
                        });
                    $("#Pedido_UNIDAD").val(data.UNIDAD);
                }
            });    
}
</script>
<div class="form">

<?php
    $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id'=>'pedido-form',
            'type'=>'horizontal',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                  'validateOnSubmit'=>true,
             ),	
    )); 
    $conf = ConfFa::model()->find();
    $text_rubros =$conf->USAR_RUBROS == 0 ? '<div class="alert alert-info"><strong>Actualmente No usa Rubros</strong></div>' : '';
    $rubro1 =$conf->USAR_RUBROS == 1 && $conf->RUBRO1_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO1') : '';
    $rubro2 =$conf->USAR_RUBROS == 1 && $conf->RUBRO2_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO2') : '';
    $rubro3 =$conf->USAR_RUBROS == 1 && $conf->RUBRO3_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO3') : '';
    $rubro4 =$conf->USAR_RUBROS == 1 && $conf->RUBRO4_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO4') : '';
    $rubro5 =$conf->USAR_RUBROS == 1 && $conf->RUBRO5_NOMBRE != '' ? $form->textFieldRow($model,'RUBRO5') : '';
?>
    
<?php
    $fechaFactura = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_PEDIDO',
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
            'style'=>'width:80px;vertical-align:top'
        ),  
   ), true);
    
    $fechaDespacho = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_PROMETIDA',
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
            'style'=>'width:80px;vertical-align:top'
        ),  
   ), true); 
    
    $fechaEntrega = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_EMBARQUE',
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
            'style'=>'width:80px;vertical-align:top'
        ),  
   ), true); 
    
    $fechaOrden = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_ORDEN',
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
            'style'=>'width:80px;vertical-align:top'
        ),  
   ), true); 
    
    $renderLineas = $this->renderPartial('lineas', array('linea'=>$linea, 'form'=>$form, 'model'=>$model, 'ruta'=>$ruta),true);
    
?>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tr>
                <td>
            <table style="margin-left: -100px;">
                        <tr>
                            <td style="width: 315px">
                                <?php echo $form->dropDownListRow($model,'CONSECUTIVO',CHtml::listData(ConsecutivoFa::model()->findAllByAttributes(array('ACTIVO'=>'S','CLASIFICACION'=>'P')),'CODIGO_CONSECUTIVO','DESCRIPCION'),array('empty'=>'Seleccione','style'=>'width: 100px;')); ?>
                            </td>
                            <td style="width: 80px;">
                                <?php echo $form->textField($model,'PEDIDO',array('size'=>15,'maxlength'=>50,'readonly'=>true)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <div class="control-group ">
                                        <?php echo $form->labelEx($model,'FECHA_PEDIDO',array('class'=>'control-label')); ?>
                                        <div class="controls">   
                                            <?php 
                                                echo $fechaFactura; 
                                                echo $form->error($model,'FECHA_PEDIDO')
                                            ?>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                 <?php echo $form->dropDownListRow($model,'CONDICION_PAGO',CHtml::listData(CodicionPago::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 239px;','empty'=>'Seleccione','options'=>array($model->isNewRecord && $conf->COND_PAGO_CONTADO!= '' ? $conf->COND_PAGO_CONTADO : ''=>array('selected'=>'selected'))));?>
                            </td>
                        </tr>

                    </table>
                </td>
                <td>
            <table style="margin-left: -140px;">
                        <tr>
                            <td style="width: 315px">
                                <?php echo $form->textFieldRow($model,'CLIENTE',array('size'=>18,'maxlength'=>20)); ?>
                            </td>
                            <td style="width: 28px;padding-top:11px;">
                                <?php $this->widget('bootstrap.widgets.BootButton', array(
                                  'type'=>'info',
                                  'size'=>'mini',
                                  'url'=>'#cliente',
                                  'icon'=>'search',
                                  'htmlOptions'=>array('data-toggle'=>'modal'),
                            )); ?>
                            </td>
                            <td>
                                <?php echo CHtml::textField('Cliente_desc','',array('disabled'=>true,'size'=>32)); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo $form->dropDownListRow($model,'BODEGA',CHtml::listData(Bodega::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 150px;','empty'=>'Seleccione','options'=>array($model->isNewRecord && $conf->BODEGA_DEFECTO!= '' ? $conf->BODEGA_DEFECTO : ''=>array('selected'=>'selected'))));?>
                            </td>
                            <td rowspan="2" colspan="2">
                                  <span style="background-color:#EEEEEE;line-height:20px;text-align:center; text-shadow:#FFFFFF 0 1px 0;padding-left:5px;padding-top:9px;width:26px;height:28px;margin-top:57px;float:left;font-size: 42px;border:1px solid #CCCCCC;">$</span>
                                  <?php echo CHtml::textField('calculos','0',array('disabled'=>true,'style'=>'width:254px;height:40px;font-size: 34px;margin-top:56px;text-align:right;'));?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <?php echo $form->dropDownListRow($model,'NIVEL_PRECIO', CHtml::listData(NivelPrecio::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('style'=>'width: 150px;','empty'=>'Seleccione','options'=>array($model->isNewRecord && $conf->NIVEL_PRECIO!= '' ? $conf->NIVEL_PRECIO : ''=>array('selected'=>'selected'))));?>
                                <?php echo CHtml::hiddenField('NOMBRE_TIPO_PRECIO','');?>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <?php $this->widget('bootstrap.widgets.BootTabbable', array(
                'type'=>'tabs', // 'tabs' or 'pills'
                'tabs'=>array( 
                    array('label'=>'Líneas', 'content'=>$renderLineas, 'active'=>true),
                    array('label'=>'Otros', 'content'=>
                        '<table>
                            <tr>
                                <td style="width: 380px;">
                                    <fieldset >
                                        <legend ><font face="arial" size=3 >Fechas</font></legend>
                                        <div class="control-group ">'
                                            .$form->labelEx($model,'FECHA_DESPACHO',array('class'=>'control-label'))
                                            .'<div class="controls">'   
                                            .$fechaDespacho
                                            .'</div>
                                        </div>'
                                        .'<div class="control-group ">'
                                            .$form->labelEx($model,'FECHA_ENTREGA',array('class'=>'control-label'))
                                            .'<div class="controls">'   
                                            .$fechaEntrega
                                            .'</div>
                                        </div>'
                                   .'</fieldset>'
                                   .$form->textFieldRow($model,'COMENTARIOS_CXC',array('size'=>50,'maxlength'=>50))
                                   .$form->textAreaRow($model,'OBSERVACIONES',array('rows'=>6, 'cols'=>50))
                               .'</td>
                                <td>
                                    <fieldset>
                                        <legend ><font face="arial" size=3 >Rubros</font></legend>'
                                        .$text_rubros
                                        .$rubro1
                                        .$rubro2
                                        .$rubro3
                                        .$rubro4
                                        .$rubro5
                                    .'</fieldset>
                               </td>
                            </tr>
                       </table>
                       <fieldset>
                               <legend ><font face="arial" size=3 >Orden de Compra</font></legend>
                               <table>
                                    <tr>
                                        <td style="width: 380px;">'
                                            .$form->textFieldRow($model,'ORDEN_COMPRA',array('size'=>30,'maxlength'=>50))
                                         .'</td>
                                        <td>
                                            <div class="control-group ">'
                                                .$form->labelEx($model,'FECHA_ORDEN',array('class'=>'control-label'))
                                                .'<div class="controls">'   
                                                    .$fechaOrden
                                                .'</div>
                                            </div>
                                        </td>
                                    <tr>
                            </table>
                      </fieldset>'
                    ),
                    array('label'=>'Montos', 'content'=>
                        $form->textFieldRow($model,'TOTAL_MERCADERIA',array('size'=>28,'maxlength'=>28, 'readonly'=>true, 'value'=>'0'))
                        .$form->textFieldRow($model,'MONTO_DESCUENTO1',array('size'=>28,'maxlength'=>28, 'readonly'=>true, 'value'=>'0'))
                        .$form->textFieldRow($model,'MONTO_ANTICIPO',array('size'=>28,'maxlength'=>28, 'class'=>'calculos_montos', 'value'=>'0'))
                        .$form->textFieldRow($model,'MONTO_FLETE',array('size'=>28,'maxlength'=>28, 'class'=>'calculos_montos', 'value'=>'0'))
                        .$form->textFieldRow($model,'MONTO_SEGURO',array('size'=>28,'maxlength'=>28, 'class'=>'calculos_montos', 'value'=>'0'))
                        .$form->textFieldRow($model,'TOTAL_IMPUESTO1', array('size'=>28,'maxlength'=>28, 'value'=>'0', 'readonly'=>true))
                        .$form->textFieldRow($model,'TOTAL_A_FACTURAR',array('size'=>28,'maxlength'=>28, 'readonly'=>true, 'value'=>'0'))
                        .$form->textFieldRow($model,'ESTADO',array('size'=>28,'maxlength'=>28, 'readonly'=>true, 'value'=>'N'))
                        .$form->textFieldRow($model,'REMITIDO',array('size'=>1,'maxlength'=>1, 'value'=>'N', 'readonly'=>true))
                        .$form->textFieldRow($model,'RESERVADO',array('size'=>1,'maxlength'=>1, 'value'=>'N', 'readonly'=>true))
                        .'<div class="control-group "><label for="total_grande" class="control-label">Gran total: </label><div class="controls">'
                        .CHtml::textField('total_grande', '0', array('readonly'=>true))
                        .'</div></div>'
                        ),
                )
            )); ?>

        <div align="center">
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small', 'url' => array('pedido/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<!--ventanas modales-->

    <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'cliente')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'cliente-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$cliente->search(),
            'selectionChanged'=>'cargaGrilla',
            'filter'=>$cliente,
            'columns'=>array(
                array(  'name'=>'CLIENTE',
                        'header'=>'Codigo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->CLIENTE,"#")'
                    ),
                    'NOMBRE',
                    'NIT',
                    array(
                            'class'=>'bootstrap.widgets.BootButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'template'=>'',
                    ),
            ),
    ));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>

    <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'articulo')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php
            $funcion = 'cargaGrilla';
            $id = 'articulo-grid';
            $data=$articulo->searchModal();
            $this->renderPartial('/articulo/articulos', array('articulo'=>$articulo,'funcion'=>$funcion,'id'=>$id,'data'=>$data,'check'=>false));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>

    <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'bodega')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'bodega-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$bodega->search(),
            'selectionChanged'=>'cargaGrilla',
            'filter'=>$bodega,
            'columns'=>array(
                array(  'name'=>'ID',
                        'header'=>'Codigo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ID,"#")'
                    ),
                    'DESCRIPCION',
                    'TELEFONO',
                    array(
                            'class'=>'bootstrap.widgets.BootButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'template'=>'',
                    ),
            ),
    ));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>

    <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'condicion')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'condicion-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$condicion->search(),
            'selectionChanged'=>'cargaGrilla',
            'filter'=>$condicion,
            'columns'=>array(
                array(  'name'=>'ID',
                        'header'=>'Codigo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ID,"#")'
                    ),
                    'DESCRIPCION',
                    'DIAS_NETO',
                    array(
                            'class'=>'bootstrap.widgets.BootButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'template'=>'',
                    ),
            ),
    ));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>


<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'nuevo')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Nueva Línea</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
        <div id="form-lineas">
            <?php  $this->renderPartial('form_lineas', 
                        array(
                            'model'=>$model,
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    ); ?>
        </div>
 
<?php $this->endWidget(); ?>

<!--Fin modales-->