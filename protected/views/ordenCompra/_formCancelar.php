<script>
$(document).ready(function(){
   var proveedor = $("#OrdenCompra_PROVEEDOR").val();
   //var porDescGen = $("#OrdenCompra_PORC_DESCUENTO").val();
   //var montFlete = $("#OrdenCompra_MONTO_FLETE").val();
   //var montSeguro = $("#OrdenCompra_MONTO_SEGURO").val();
   //var montAnticipo = $("#OrdenCompra_MONTO_ANTICIPO").val();
   //var ocultoUpd = $("#ocultoUpd");
   
   $.getJSON(
        '<?php echo $this->createUrl('ordenCompra/CargarProveedor'); ?>&buscar='+proveedor,
        function(data)
        {
            $('#ProvNombre').val(data.NOMBRE);
            $('#ProvNombre2').val(data.NOMBRE);
            $('#ProvMail').val(data.EMAIL);
            $('#ProvContacto').val(data.CONTACTO);
            $('#ProvTelefono').val(data.TELEFONO);
            $('#OrdenCompra_PROVEEDOR').val(data.ID);
            $('#OrdenCompra_PORC_DESCUENTO').val(data.DESCUENTO);
        }
    )
});
</script>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'orden-compra-form',
        'type'=>'horizontal',
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
                    .$form->textField($model,'RUBRO1',array('size'=>50,'maxlength'=>50, 'readonly'=>true))
                    .$form->error($model,'RUBRO1')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO2')
                    .$form->textField($model,'RUBRO2',array('size'=>50,'maxlength'=>50, 'readonly'=>true))
                    .$form->error($model,'RUBRO2')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO3')
                    .$form->textField($model,'RUBRO3',array('size'=>50,'maxlength'=>50, 'readonly'=>true))
                    .$form->error($model,'RUBRO3')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO4')
                    .$form->textField($model,'RUBRO4',array('size'=>50,'maxlength'=>50, 'readonly'=>true))
                    .$form->error($model,'RUBRO4')
                    .'</div>'
                    .'<div class="row">'
                    .$form->labelEx($model,'RUBRO5')
                    .$form->textField($model,'RUBRO5',array('size'=>50,'maxlength'=>50, 'readonly'=>true))
                    .$form->error($model,'RUBRO5')
                    .'</div>';
         }
         else{
             $rubros='Para usar esta opcion debes habilitarla en configuracion';
         }
        ?>
    
    <?php
        if ($config->IMP1_AFECTA_DESCTO == 'A'){
            $porcentaje = $form->textFieldRow($model,'PORC_DESCUENTO',array('size'=>6,'maxlength'=>28, 'value'=>'0', 'class'=>'ambos', 'onFocus'=> "if (this.value=='0') this.value='';", 'readonly'=>true));
        }
        else{
            $porcentaje = $form->textFieldRow($model,'PORC_DESCUENTO',array('size'=>6,'maxlength'=>28, 'value'=>'0', 'class'=>'calculoMonto', 'onFocus'=> "if (this.value=='0') this.value='';", 'readonly'=>true));
        }
    ?>
    
    <?php       
           $retorna = $model->ORDEN_COMPRA;
           $pestana = $this->renderPartial('lineaCancelar', array('form'=>$form, 'linea'=>$linea, 'items'=>$items),true);
    ?>

	<?php echo $form->errorSummary($model); ?>
        <table>
            <tr>
                <td><?php echo $form->textFieldRow($model,'ORDEN_COMPRA',array('size'=>10,'maxlength'=>10, 'readonly' => true, 'value' => $retorna)); ?></td>
                <td width="10%"><?php echo $form->textFieldRow($model,'PROVEEDOR',array('size'=>20,'maxlength'=>20, 'class'=>'escritoProv', 'readonly' => true,)); ?></td>
                <td width="25%"><?php echo CHtml::textField('ProvNombre2','', array('readonly' => true)); ?>
                <?php $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#proveedor',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    )); ?></td>
            </tr>
        </table>
   
        <?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        array('label'=>'General', 'content'=>'
            <fieldset><table>
                <tr>
                    <td width="50%"><label class="control-label">Fecha:</label> <div class="controls">'.$form->textField($model,'FECHA',array('readonly'=>true, 'size'=>'10')).'</div></div></td>            
                    <td>'.$form->textFieldRow($model,'ESTADO',array('size'=>1,'maxlength'=>1, 'readonly'=>true, 'value'=>'P')).'</td>
                </tr>
                <tr>
                    <td>'.$form->dropDownListRow($model,'BODEGA', CHtml::listData(Bodega::model()->findAll(), 'ID', 'DESCRIPCION'), array('disabled'=>true)).'</td>
                    <td>'.$form->dropDownListRow($model,'DEPARTAMENTO',CHtml::listData(Departamento::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...', 'disabled' => true,)).'</td>
                </tr>
            </table></fieldset><p>&nbsp;</p>
            <fieldset><table width="100%">
                <tr>
                    <td width="50%"><div class="control-group  validating"><label class="control-label">Fecha Cotización:</label> <div class="controls">'.$form->textField($model,'FECHA_COTIZACION',array('readonly'=>true, 'size'=>'10')).'</div></div></td>
                    <td><label class="control-label">Fecha Requerida:</label> <div class="controls">'.$form->textField($model,'FECHA_REQUERIDA',array('readonly'=>true, 'size'=>'10')).'</div></div></td>
                </tr>
                <tr>
                    <td width="50%"><label class="control-label">Fecha Requerida Embarque:</label> <div class="controls">'.$form->textField($model,'FECHA_REQ_EMBARQUE',array('readonly'=>true, 'size'=>'10')).'</div></div></td>
                    <td align="right"><label class="control-label">Fecha Ofrecida:</label> <div class="controls">'.$form->textField($model,'FECHA_OFRECIDA',array('readonly'=>true, 'size'=>'10')).'</div></div></td>
                </tr>
                <tr>
                    <td colspan="2">'.$form->dropDownListRow($model,'PRIORIDAD',array('A'=>'Alta','M'=>'Media','B'=>'Baja'), array('disabled'=>true)).'</td>
                </tr>
            </table></fieldset>', 'active'=>true),
        
        array('label'=>'Líneas', 'content'=>$pestana),
        
        array('label'=>'Proveedor', 'content'=>
            '<fieldset>'.
            '<div class="control-group  validating"><label class="control-label">Nombre de proveedor: </label> <div class="controls">'.CHtml::textField('ProvNombre','', array('readonly' => true)).'</div></div>'.
            '<div class="control-group  validating"><label class="control-label">E-mail: </label><div class="controls">'.CHtml::textField('ProvMail','', array('readonly' => true)).'</div></div>'.
            '<div class="control-group  validating"><label class="control-label">Contacto: </label><div class="controls">'.CHtml::textField('ProvContacto','', array('readonly' => true)).'</div></div>'.
            '<div class="control-group  validating"><label class="control-label">Telefono: </label><div class="controls">'.CHtml::textField('ProvTelefono','', array('readonly' => true)).'</div></div>'.
            $form->dropDownListRow($model,'CONDICION_PAGO',CHtml::listData(CodicionPago::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...', 'disabled'=>true))
            .'</fieldset>'),
        
        array('label'=>'Dirección', 'content'=>
            '<fieldset>'.
            $form->textAreaRow($model,'DIRECCION_EMBARQUE',array('cols' => '50', 'rows' => '5', 'readonly'=>true)).
            $form->textAreaRow($model,'DIRECCION_COBRO',array('cols' => '50', 'rows' => '5', 'readonly'=>true)).
            '</fliedset>'),
        
        array('label'=>'Rubros', 'content'=>$rubros),
        
        array('label'=>'Textos', 'content'=>
            '<fieldset>'.
            $form->textFieldRow($model,'COMENTARIO_CXP',array('size'=>60,'maxlength'=>250, 'readonly'=>true)).
            $form->textAreaRow($model,'INSTRUCCIONES',array('cols' => '50', 'rows' => '5', 'readonly'=>true)).
            $form->textAreaRow($model,'OBSERVACIONES',array('cols' => '50', 'rows' => '5', 'readonly'=>true)).
            '</fieldset>'),
        
        array('label'=>'Montos', 'content'=>
            '<fieldset>'.
            '<table><tr>'.
                '<td>'.$porcentaje.'</td>
                <td><div class="control-group  validating"><label class="control-label">Total Mercaderia: </label><div class="controls">'.CHtml::textField('TotalMerc','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>'.
                '<td>'.$form->textFieldRow($model,'MONTO_FLETE',array('size'=>6,'maxlength'=>28, 'value'=>'0', 'class'=>'calculoMonto', 'onFocus'=> "if (this.value=='0') this.value='';", 'readonly'=>true)).'</td>
                <td><div class="control-group  validating"><label class="control-label">- Descuento: </label><div class="controls">'.CHtml::textField('MenosDescuento','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>'.$form->textFieldRow($model,'MONTO_SEGURO',array('size'=>6,'maxlength'=>28, 'value'=>'0', 'class'=>'calculoMonto', 'onFocus'=> "if (this.value=='0') this.value='';", 'readonly'=>true)).'</td>
                <td><div class="control-group  validating"><label class="control-label">+ Imp. de ventas: </label><div class="controls">'.CHtml::textField('ImpVentas','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>'.$form->textFieldRow($model,'MONTO_ANTICIPO',array('size'=>6,'maxlength'=>28, 'value'=>'0', 'class'=>'calculoMonto', 'onFocus'=> "if (this.value=='0') this.value='';", 'readonly'=>true)).'</td>
                <td><div class="control-group  validating"><label class="control-label">+ Flete: </label><div class="controls">'.CHtml::textField('Flete','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>'.$form->dropDownListRow($model,'TIPO_PRORRATEO_OC',array('CAN'=>'Cantidad','PRE'=>'Precio','PRO'=>'Promedio', 'NIN'=>'Ninguno'), array('disabled'=>true)).'</td>
                <td><div class="control-group  validating"><label class="control-label">+ Seguro: </label><div class="controls">'.CHtml::textField('Seguro','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>'.$form->textFieldRow($model,'TOTAL_A_COMPRAR',array('maxlength'=>28, 'readonly' => true)).'</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><div class="control-group  validating"><label class="control-label">- Anticipo </label><div class="controls">'.CHtml::textField('Anticipo', '', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><div class="control-group  validating"><label class="control-label">= Saldo</label><div class="controls">'.CHtml::textField('Saldo', '', array('readonly'=>true)).'</td>
            </tr></table></fieldset>'),
        
        array('label'=>'Auditoria', 'content'=>
            $form->textFieldRow($model,'USUARIO_CANCELA',array('disabled' => true)).
            $form->textFieldRow($model,'FECHA_CANCELA', array('disabled' => true)).
            $form->textFieldRow($model,'CREADO_POR',array('disabled' => true)).
            $form->textFieldRow($model,'CREADO_EL',array('disabled' => true)).
            $form->textFieldRow($model,'ACTUALIZADO_POR',array('disabled' => true)).
            $form->textFieldRow($model,'ACTUALIZADO_EL',array('disabled' => true))),
    ),
)); ?>

	<div align="center">
           <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small', 'url' => array('solicitudOc/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); ?>

    <?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'proveedor')); ?>
    <div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
                <?php 
    $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'proveedor-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$proveedor->search(),
            'selectionChanged'=>'cargaProveedorGrilla',
            'filter'=>$proveedor,
            'columns'=>array(
                array(  'name'=>'PROVEEDOR',
                        'header'=>'Código Proveedor',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->PROVEEDOR,"#")'
                    ),
                    'NOMBRE',
                    'CATEGORIA',
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
            'selectionChanged'=>'cargaArticuloGrilla',
            'filter'=>$articulo,
            'columns'=>array(
                array(  'name'=>'ARTICULO',
                        'header'=>'Código Artículo',
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
    
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'lineas')); ?>
    <div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
                <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'lineas-grid',
            'selectableRows'=>2,
            'selectionChanged'=>'obtenerSeleccion',
            'template'=>"{items} {pager}",
            'dataProvider'=>$solicitudLinea->search2(),
            'filter'=>$solicitudLinea,
            'columns'=>array(
                array('class'=>'CCheckBoxColumn'),
                array(  'name'=>'SOLICITUD_OC_LINEA',
                        'header'=>'Código Solicitud'),
                    'SOLICITUD_OC',
                    array('name' => 'ARTICULO', 'value'=>'$data->aRTICULO->NOMBRE'),
                    'FECHA_REQUERIDA',

            ),
    ));
             ?>
	</div>
        <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cargar Líneas',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal', 'onclick' => 'cargaSolicitud()'),
            )); ?>
        <?php //echo CHtml::ajaxButton('Cargar Líneas', array('ajax'), array('update'=>'#forAjaxRefresh'), array('data-dismiss'=>'modal', 'class' => 'btn', 'onclick' => 'cargaSolicitud()')); ?>
        </div>
    <?php $this->endWidget(); ?>
    <?php echo CHtml::HiddenField('check',''); ?>
    <?php echo CHtml::HiddenField('contador', '0'); ?>
    <?php echo CHtml::hiddenField('oculto', ''); ?>
    <?php echo CHtml::hiddenField('afecta', $config->IMP1_AFECTA_DESCTO); ?>
</div><!-- form -->