<script>
$(document).ready(function(){
    inicio();
});

function nuevo(){    
    //Limpiar Fromulario
    $("#PedidoLinea_ARTICULO").val('');
    $("#PedidoLinea_UNIDAD").val('');
    $("#PedidoLinea_CANTIDAD").val('');
    $("#PedidoLinea_PRECIO_UNITARIO").val('');
    $("#PedidoLinea_PORC_DESCUENTO").val('');
    $("#PedidoLinea_MONTO_DESCUENTO").val('');
    $("#PedidoLinea_COMENTARIO").val('');
    
    //llamar modal
    $("#nuevo").modal();
    
    //llenar datos
    $("#PedidoLinea_ARTICULO").val($('#Articulo').val());
    $("#DESCRIPCION").val($('#Articulo_desc').val());
}

function inicio(){    
    $(".escritoBodega").autocomplete({
        change: function(e) { 
            $.getJSON(
                '<?php echo $this->createUrl('completarBodega'); ?>&buscar='+$(this).attr('value'),
                function(data)
                {
                    $('#Pedido_BODEGA').val(data.ID);
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
        url = '<?php echo $this->createUrl('dirigir'); ?>&FU=CL&ID='+ID;
        campo = '#Pedido_CLIENTE';
        campo_nombre = '#Cliente_desc';
    }
    else if (grid_id == 'articulo-grid'){
        url = '<?php echo $this->createUrl('dirigir'); ?>&FU=AR&ID='+ID;
        campo = '#Articulo';
        campo_nombre = '#Articulo_desc';        
    }
    else if (grid_id == 'condicion-grid'){
        url = '<?php echo $this->createUrl('dirigir'); ?>&FU=CO&ID='+ID;
        campo = '#Pedido_CONDICION_PAGO';
        campo_nombre = '#Condicion';
    }
    else if(grid_id == 'bodega-grid'){
        url = '<?php echo $this->createUrl('dirigir'); ?>&FU=BO&ID='+ID;
        campo = '#Pedido_BODEGA';
        campo_nombre = '#Bodega';
    }
    $.getJSON(url,function(data){
                $(campo).val(ID);
                $(campo_nombre).val(data.NOMBRE); 
                if(data.UNIDAD){
                    $("#PedidoLinea_UNIDAD").val(data.UNIDAD);
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
?>

<?php
    $fechaPrometida = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
?>

<?php
    $fechaEmbarque = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
?>

<?php
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
?>
<!--Fin de fechas    -->

<!--render lineas-->
<?php $renderLineas = $this->renderPartial('lineas', array('linea'=>$linea, 'form'=>$form, 'model'=>$model),true); ?>
<!--fin render lineas-->

	<?php echo $form->errorSummary($model); ?>
    
<table>
    <tr>
        <td>
            <table>
                <tr>
                    <td>
                        <label>Pedido: </label>
                    </td>
                    <td width="10%">
                        <?php echo $form->textField($model,'PEDIDO',array('size'=>20,'maxlength'=>50)); ?>
                    </td>
                    <td width="2%">
                        <?php /*$this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#condicion',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ));*/ ?>
                    </td>
                    <td>
                        <?php echo CHtml::textField('Pedido_desc',''); ?>
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
                        <?php echo CHtml::textField('Cliente_desc',''); ?>
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
                                        'htmlOptions'=>array('id'=>'btn-nuevo','name'=>'','onclick'=>'nuevo();')
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
                                <td width="2%">'.$form->textFieldRow($model,'BODEGA',array('size'=>4,'maxlength'=>4, 'class'=>'escritoBodega')).'</td>
                                <td width="2%">'.$btnBodega.'</td>
                                <td>'.CHtml::textField('Bodega', '', array('size'=>40)).'</td>
                            </tr>
                            <tr>
                                <td>'.$form->textFieldRow($model,'CONDICION_PAGO',array('size'=>4,'maxlength'=>4)).'</td>   
                                <td>'.$btnCondicion.'</td>
                                <td>'.CHtml::textField('Condicion', '', array('size'=>40)).'</td>
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
                        .'</div>
                        <table>
                            <tr>
                                <td width="10%">'.$form->textFieldRow($model,'ORDEN_COMPRA',array('size'=>30,'maxlength'=>30)).'</td>
                                <div class="row">
                                <td>
                                <div class="control-group "><label for="Pedido_FECHA_ORDEN" class="control-label required">Fecha orden</label><div class="controls">'   
                                .$fechaOrden
                                .'</span></div></div>'
                                .'</div>'
                                .'</td>
                            </tr>
                        </table>'
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
                        .$form->textFieldRow($model,'TIPO_DESCUENTO1',array('size'=>1,'maxlength'=>1))
                        .$form->textFieldRow($model,'TIPO_DESCUENTO2',array('size'=>1,'maxlength'=>1))
                        .$form->textFieldRow($model,'MONTO_DESCUENTO1',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'MONTO_DESCUENTO2',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'POR_DESCUENTO1',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'POR_DESCUENTO2',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'TOTAL_IMPUESTO1',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'TOTAL_A_FACTURAR',array('size'=>28,'maxlength'=>28))
                        .$form->textFieldRow($model,'REMITIDO',array('size'=>1,'maxlength'=>1))
                        .$form->textFieldRow($model,'RESERVADO',array('size'=>1,'maxlength'=>1))
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
                        )
                    ); ?>
        </div>
 
<?php $this->endWidget(); ?>

<!--Fin modales-->