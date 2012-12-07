<script>
$(document).ready(function(){
    inicio();
});

function nuevo(){    
    //Limpiar Fromulario
    $("#FacturaLinea_ARTICULO").val('');
    //$("#PedidoLinea_UNIDAD").val('');
    $("#FacturaLinea_CANTIDAD").val('');
    $("#FacturaLinea_PRECIO_UNITARIO").val('');
    $("#FacturaLinea_PORC_DESCUENTO").val('');
    $("#FacturaLinea_MONTO_DESCUENTO").val('');
    $("#FacturaLinea_PORC_IMPUESTO").val('');
    $("#FacturaLinea_VALOR_IMPUESTO").val('');
    $("#FacturaLinea_COMENTARIO").val('');
    
    //llamar modal
    $("#nuevo").modal();
    
    //llenar datos
    $("#FacturaLinea_ARTICULO").val($('#Articulo').val());
    $("#DESCRIPCION").val($('#Articulo_desc').val());
}

function inicio(){ 
    
    $('#agregar').click(function(){            
            $.getJSON('<?php echo $this->createUrl('/pedido/cargarTipoPrecio')?>&art='+$('#Articulo').val(),
                function(data){
                    
                     $('select[id$=PedidoLinea_TIPO_PRECIO ] > option').remove();
                      $('#FacturaLinea_TIPO_PRECIO').append("<option value=''>Seleccione</option>");
                    
                    $.each(data, function(value, name) {
                              $('#FacturaLinea_TIPO_PRECIO').append("<option value='"+value+"'>"+name+"</option>");
                        });
                });
        });
    $('#Factura_CONSECUTIVO').change(function(){
            $.getJSON('<?php echo $this->createUrl('cargarconsecutivo')?>&id='+$(this).val(),
                function(data){
                    
                    $('#Factura_PEDIDO').val(data.VALOR);
                    
                }
            );
        });
    $(".escritoBodega").autocomplete({
        change: function() { 
            $.getJSON(
                '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=BO&ID='+$(this).attr('value'),
                function(data)
                {
                    $('#Factura_BODEGA').val(data.ID);
                    $('#Bodega').val(data.NOMBRE);
                }
           )
        }
    });    
    
    $(".escritoCondicion").autocomplete({
        change: function(e) { 
            $.getJSON(
                '<?php echo $this->createUrl('proveedor/CargarNit'); ?>&FU=BOA&ID='+$(this).attr('value'),
                function(data)
                {
                    $('#Proveedor_NIT').val(data.ID);
                    $('#Nit2').val(data.NOMBRE);                    
                }
           )
        }
    });    
}

function cargaGrilla(grid_id){
    var ID = $.fn.yiiGridView.getSelection(grid_id);
    var url;
    var campo;
    var campo_nombre;
    
    if (grid_id == 'cliente-grid'){
        url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CL&ID='+ID;
        campo = '#Factura_CLIENTE';
        campo_nombre = '#Cliente_desc';
    }
    else if (grid_id == 'articulo-grid'){
        url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=AR&ID='+ID;
        campo = '#Articulo';
        campo_nombre = '#Articulo_desc';
        $('#agregar').attr('disabled', false);
    }
    else if (grid_id == 'condicion-grid'){
        url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=CO&ID='+ID;
        campo = '#Factura_CONDICION_PAGO';
        campo_nombre = '#Condicion';
    }
    else if(grid_id == 'bodega-grid'){
        url = '<?php echo $this->createUrl('/pedido/dirigir'); ?>&FU=BO&ID='+ID;
        campo = '#Factura_BODEGA';
        campo_nombre = '#Bodega';
    }
    $.getJSON(url,function(data){
                $(campo).val(ID);
                $(campo_nombre).val(data.NOMBRE); 
                if(data.UNIDAD){
                    $("#FacturaLinea_UNIDAD").val(data.UNIDAD);
                }
            });    
}
</script>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'pedido-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),	
)); ?>
    
<!--Inicio de Autocompletar-->
<?php
    $autocompletarBodega = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model'=>$model,
                    'attribute'=>'BODEGA',
                    'source'=>$this->createUrl('/pedido/completarbodega'),
                    'htmlOptions'=>array(
                        'size'=>4,
                        'class'=>'escritoBodega',
                        'maxlength'=>4
                    ),
                ), true);
?>
<!--Fin de Autocompletar-->


<!--Inicio de Botones que llaman a modal-->

<?php $btnBodega = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#bodega',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true); 
?>
<?php $btnCondicion = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#condicion',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true); 
?>

<!--Fin de Botones que llaman a modal-->

<!--Inicio de fechas-->
<?php
    $fechaPedido = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_FACTURA',
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
?>

<?php
    $fechaPrometida = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_DESPACHO',
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
?>

<?php
    $fechaEmbarque = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'attribute'=>'FECHA_ENTREGA',
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
?>

<!--Fin de fechas    -->

<!--render lineas-->
<?php $renderLineas = $this->renderPartial('lineas', array('linea'=>$linea, 'form'=>$form, 'model'=>$model, 'ruta'=>$ruta),true); ?>
<!--fin render lineas-->

	<?php echo $form->errorSummary($model); ?>
    
<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <label>Consecutivo: </label>
                    </td>
                    <td width="10%">
                        <?php echo $form->dropDownList($model,'CONSECUTIVO',CHtml::listData(ConsecutivoFa::model()->findAllByAttributes(array('ACTIVO'=>'S','CLASIFICACION'=>'F')),'CODIGO_CONSECUTIVO','DESCRIPCION'),array('empty'=>'Seleccione','style'=>'width: 160px;')); ?>
                    </td>
                    <td width="2%"></td>
                    <td>
                        <?php echo $form->textField($model,'PEDIDO',array('size'=>20,'maxlength'=>50,'disabled'=>true)); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Cliente: </label>
                    </td>
                    <td>
                        <?php echo $form->textField($model,'CLIENTE',array('size'=>20,'maxlength'=>20)); ?>
                    </td>
                    <td>
                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#cliente',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    )); ?>
                    </td>
                    <td>
                        <?php echo CHtml::textField('Cliente_desc','',array('disabled'=>true)); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Articulo: </label>
                    </td>
                    <td>
                        <?php echo CHtml::textField('Articulo',''); ?>
                    </td>
                    <td>
                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#articulo',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    )); ?>
                    </td>
                    <td>
                        <?php echo CHtml::textField('Articulo_desc',''); ?>
                        <?php
                            $this->widget('bootstrap.widgets.BootButton', array(
                                        'buttonType'=>'button',
                                        'type'=>'success',
                                        'label'=>'Agregar',
                                        'size'=>'mini',
                                        'htmlOptions'=>array('id'=>'agregar','name'=>'','onclick'=>'nuevo();', 'disabled'=>true)
                             ));
                        ?>
                    </td>
                </tr>
            </table>
        </td>
        <td valign="center">
            <div style="font-size: 20px; float: left; border: 1px solid #CCC; padding: 10px; margin-top: 40px;">$ <span id="calculos">Total</span></div>
        </td>
    </tr>
</table>
        <?php $this->widget('bootstrap.widgets.BootTabbable', array(
                'type'=>'tabs', // 'tabs' or 'pills'
                'tabs'=>array( 
                    array('label'=>'Líneas', 'content'=>$renderLineas, 'active'=>true),
                    
                    array('label'=>'General', 'content'=>
                        '<table>
                            <tr>
                                <td width="2%">'
                                    .$form->labelEx($model,'BODEGA',array('class'=>'control-label'))
                                    .' <div class="controls">'.$autocompletarBodega.'</div>
                                </td>
                                <td width="2%">'.$btnBodega.'</td>
                                <td>'.CHtml::textField('Bodega', '', array('size'=>40,'disabled'=>true)).'</td>
                            </tr>
                            <tr>
                                <td>'.$form->textFieldRow($model,'CONDICION_PAGO',array('size'=>4,'maxlength'=>4)).'</td>   
                                <td>'.$btnCondicion.'</td>
                                <td>'.CHtml::textField('Condicion', '', array('size'=>40,'disabled'=>true)).'</td>
                            </tr>
                        </table>'
                        .$form->dropDownListRow($model,'NIVEL_PRECIO', CHtml::listData(NivelPrecio::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
                        .'<div class="row">'
                        .'<div class="control-group "><label for="Pedido_FECHA_PEDIDO" class="control-label required">Fecha pedido<span class="required"> *</span></label><div class="controls">'   
                        .$fechaPedido
                        .'</span></div></div>'                        
                        .'<div class="control-group "><label for="Pedido_FECHA_PROMETIDA" class="control-label required">Fecha prometida<span class="required"> *</span></label><div class="controls">'   
                        .$fechaPrometida
                        .'</span></div></div>'
                        .'<div class="control-group "><label for="Pedido_FECHA_EMBARQUE" class="control-label required">Fecha de ingreso<span class="required"> *</span></label><div class="controls">'   
                        .$fechaEmbarque
                        .'</span></div></div>'
                        .'</div>'
                        ),

                    array('label'=>'Textos', 'content'=>
                        $form->textFieldRow($model,'RUBRO1',array('size'=>50,'maxlength'=>50))
                        .$form->textFieldRow($model,'RUBRO2',array('size'=>50,'maxlength'=>50))
                        .$form->textFieldRow($model,'RUBRO3',array('size'=>50,'maxlength'=>50))
                        .$form->textFieldRow($model,'RUBRO4',array('size'=>50,'maxlength'=>50))
                        .$form->textFieldRow($model,'RUBRO5',array('size'=>50,'maxlength'=>50))
                        .$form->textFieldRow($model,'COMENTARIOS_CXC',array('size'=>50,'maxlength'=>50))
                        .$form->textAreaRow($model,'OBSERVACIONES',array('rows'=>6, 'cols'=>50))
                        ),

                    

                    array('label'=>'Montos', 'content'=>
                        $form->textFieldRow($model,'TOTAL_MERCADERIA',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'MONTO_ANTICIPO',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'MONTO_FLETE',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'MONTO_SEGURO',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'TOTAL_IMPUESTO1',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'TOTAL_A_FACTURAR',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'REMITIDO',array('size'=>1,'maxlength'=>1))
                        .$form->textFieldRow($model,'RESERVADO',array('size'=>1,'maxlength'=>1))
                        .'<div class="control-group "><label for="total_grande" class="control-label">Gran total: </label><div class="controls">'
                        .CHtml::textField('total_grande', '0', array('readonly'=>true))
                        .'</div></div>'
                        ),
                    
                    array('label'=>'Auitoria', 'content'=>
                        $form->textFieldRow($model,'ESTADO',array('size'=>1,'maxlength'=>1, 'readonly'=>true))
                        .$form->textFieldRow($model,'CREADO_POR',array('size'=>20,'maxlength'=>20, 'readonly'=>true))
                        .$form->textFieldRow($model,'CREADO_EL', array('readonly'=>true))
                        .$form->textFieldRow($model,'ACTUALIZADO_POR',array('size'=>20,'maxlength'=>20, 'readonly'=>true))
                        .$form->textFieldRow($model,'ACTUALIZADO_EL', array('readonly'=>true))
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
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'articulo-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$articulo->search(),
            'selectionChanged'=>'cargaGrilla',
            'filter'=>$articulo,
            'columns'=>array(
                array(  'name'=>'ARTICULO',
                        'header'=>'Codigo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ARTICULO,"#")'
                    ),
                    'NOMBRE',
                    'TIPO_ARTICULO',
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