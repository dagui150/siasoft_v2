<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>
<script>
$.validator.setDefaults({
	//submitHandler: function() { alert("submitted!"); }
});
$().ready(function() {
	// validate the comment form when it is submitted
	$("#orden-compra-form").validate();
});
</script>
<script>
function obtenerSeleccion(grid_id){

    var idcategoria = $.fn.yiiGridView.getSelection(grid_id);
    $('#check').val(idcategoria);
}

function cargaProveedorGrilla (grid_id){
    var buscar = $.fn.yiiGridView.getSelection(grid_id);
    
    $.getJSON(
        '<?php echo $this->createUrl('ordenCompra/CargarProveedor'); ?>&buscar='+buscar,
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
}

$(document).ready(function(){
    $('.edit').live('click',function(){
        $('#SPAN').val('');
        $('#NAME').val($(this).attr('name'));
        actualiza();
    });
    $('#OrdenCompra_DIRECCION_EMBARQUE').val('<?php echo $config->DIRECCION_EMBARQUE; ?>');
    $('#OrdenCompra_DIRECCION_COBRO').val('<?php echo $config->DIRECCION_COBRO; ?>');
    $(".escritoProv").live("change", function (e) {
       $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarProveedor'); ?>&buscar='+$(this).attr('value'),
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
});
</script>
<?php
    ($model->ESTADO != 'C' && $model->ESTADO != 'E') ? $readonly = false : $readonly = true;
    echo CHtml::hiddenField('readonly', ($model->ESTADO != 'C' && $model->ESTADO != 'E') ? 'false' : 'true');
?>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'orden-compra-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <?php
    // evalua si el estado es vacio para la casilla de estado
        if($model->ESTADO == ''){
            $estado = $form->textFieldRow($model,'ESTADO',array('size'=>1,'maxlength'=>1, 'readonly'=>true, 'value'=>'P'));
        }else{
            $estado = $form->textFieldRow($model,'ESTADO',array('size'=>1,'maxlength'=>1, 'readonly'=>true));
        }
    ?>
    
        <?php
            //Campos de fecha
            $fecha = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'attribute'=>'FECHA',
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
            'htmlOptions'=>array('style'=>'width:80px;vertical-align:top', 'value'=>date("Y-m-d"), 'disabled'=>$readonly),  
            ), true); 
            
            $fecha2 = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'attribute'=>'FECHA_COTIZACION',
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
            'htmlOptions'=>array('style'=>'width:80px;vertical-align:top', 'disabled'=>$readonly),  
            ), true); 
            
            $fecha3 = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'attribute'=>'FECHA_OFRECIDA',
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
            'htmlOptions'=>array('style'=>'width:80px;vertical-align:top', 'disabled'=>$readonly),  
            ), true); 
            
            $fecha4 = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
            'htmlOptions'=>array('style'=>'width:80px;vertical-align:top', 'disabled'=>$readonly),  
            ), true); 
            
            $fecha5 = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'attribute'=>'FECHA_REQ_EMBARQUE',
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
            'htmlOptions'=>array('style'=>'width:80px;vertical-align:top', 'disabled'=>$readonly),  
            ), true); 
        ?>
    
	<?php 
        // Validacion de Rubros en la configuracion        
         if($config->USAR_RUBROS == "S") {
                    $rubros = '';
                    if($config->RUBRO1_ORDNOM != ''){
                        $rubros .= '<div class="row"><label>'.$config->RUBRO1_ORDNOM.'</label>'
                        .$form->textField($model,'RUBRO1',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO1')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO2_ORDNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO2_ORDNOM.'</label>'
                        .$form->textField($model,'RUBRO2',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO2')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO3_ORDNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO3_ORDNOM.'</label>'
                        .$form->textField($model,'RUBRO3',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO3')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO4_ORDNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO4_ORDNOM.'</label>'
                        .$form->textField($model,'RUBRO4',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO4')
                        .'</div>';
                    }
                    
                    if($config->RUBRO5_ORDNOM != ''){
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO5_ORDNOM.'</label>'
                        .$form->textField($model,'RUBRO5',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO5')
                        .'</div>';
                    }
                    
         }
         else{
             $rubros='Para usar esta opcion debes habilitarla en configuracion';
         }
        ?>
    
    <?php
        if ($config->IMP1_AFECTA_DESCTO == 'A'){
            $porcentaje = $form->textFieldRow($model,'PORC_DESCUENTO',array('size'=>6,'maxlength'=>28, 'readonly'=>$readonly, 'class'=>'ambos', 'onFocus'=> "if (this.value=='0') this.value='';"));
        }
        else{
            $porcentaje = $form->textFieldRow($model,'PORC_DESCUENTO',array('size'=>6,'maxlength'=>28, 'class'=>'calculoMonto', 'readonly'=>$readonly, 'onFocus'=> "if (this.value=='0') this.value='';"));
        }
    ?>
    <?php       
            //Consecutivo
            if($model->ORDEN_COMPRA == ''){
                $mascara = $config->ULT_ORDEN_COMPRA_M;
                $retorna = substr($mascara,0,2);
                $mascara = strlen($mascara);
                $longitud = $mascara - 2;
                $sql = "SELECT count(ORDEN_COMPRA) FROM orden_compra";
                $consulta = OrdenCompra::model()->findAllBySql($sql);
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $row=$command->queryRow();
                $bandera=$row['count(ORDEN_COMPRA)'];
                $retorna .= str_pad($bandera, $longitud, "0", STR_PAD_LEFT);
              
                $pestana = $this->renderPartial('lineas', array('form'=>$form, 'linea'=>$linea, 'model'=>$model, 'readonly'=>$readonly, 'ruta'=>$ruta, 'ruta2'=>$ruta2),true);
            }
            else{
                $retorna = $model->ORDEN_COMPRA;
                $pestana = $this->renderPartial('lineas', array('form'=>$form, 'linea'=>$linea, 'items'=>$items, 'model'=>$model, 'readonly'=>$readonly, 'ruta'=>$ruta, 'ruta2'=>$ruta2),true);
            }
    ?>

	<?php echo $form->errorSummary($model); ?>
        <table style="margin-left: -50px;">
            <tr>
                <td><?php echo $form->textFieldRow($model,'ORDEN_COMPRA',array('size'=>10,'maxlength'=>10, 'readonly' => true, 'value' => $retorna)); ?></td>
                <td width="10%"><?php echo $form->textFieldRow($model,'PROVEEDOR',array('size'=>20,'maxlength'=>20, 'class'=>'escritoProv', 'readonly'=>$readonly)); ?></td>
                <td width="25%"><?php echo CHtml::textField('ProvNombre2','', array('readonly' => true));  echo '<span style="margin-left: 2px;margin-top:-5px;">'.$this->darBotonBuscar('#proveedor',true).'<span>'; ?></td>
            </tr>
        </table>
   
        <?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        array('label'=>'General', 'content'=>'
            <fieldset><table>
                <tr>
                    <td width="50%"><label class="control-label">Fecha:</label> <div class="controls">'.$fecha.'</div></div></td>            
                    <td>'.$estado.'</td>
                </tr>
                <tr>
                    <td>'.$form->dropDownListRow($model,'BODEGA',CHtml::listData(Bodega::model()->findAll(array('select'=>'t.ID, t.DESCRIPCION','join'=>'LEFT JOIN conf_co fv on fv.BODEGA_DEFAULT = t.ID','order'=>'fv.BODEGA_DEFAULT desc')),'ID','DESCRIPCION')).'</td>
                    <td>'.$form->dropDownListRow($model,'DEPARTAMENTO',CHtml::listData(Departamento::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...')).'</td>
                </tr>
            </table></fieldset><p>&nbsp;</p>
            <fieldset><table width="100%">
                <tr>
                    <td width="50%"><div class="control-group  validating"><label class="control-label">Fecha Cotización:</label> <div class="controls">'.$fecha2.'</div></div></td>
                    <td><label class="control-label">Fecha Requerida:</label> <div class="controls">'.$fecha4.'</div></div></td>
                </tr>
                <tr>
                    <td width="50%"><label class="control-label">Fecha Requerida Embarque:</label> <div class="controls">'.$fecha5.'</div></div></td>
                    <td align="right"><label class="control-label">Fecha Ofrecida:</label> <div class="controls">'.$fecha3.'</div></div></td>
                </tr>
                <tr>
                    <td colspan="2">'.$form->dropDownListRow($model,'PRIORIDAD',array('A'=>'Alta','M'=>'Media','B'=>'Baja')).'</td>
                </tr>
            </table></fieldset>', 'active'=>true),
        
        array('label'=>'Líneas', 'content'=>$pestana),
        
        array('label'=>'Proveedor', 'content'=>
            '<fieldset>'.
            '<div class="control-group  validating"><label class="control-label">Nombre de proveedor: </label> <div class="controls">'.CHtml::textField('ProvNombre','', array('readonly' => true)).'</div></div>'.
            '<div class="control-group  validating"><label class="control-label">E-mail: </label><div class="controls">'.CHtml::textField('ProvMail','', array('readonly' => true)).'</div></div>'.
            '<div class="control-group  validating"><label class="control-label">Contacto: </label><div class="controls">'.CHtml::textField('ProvContacto','', array('readonly' => true)).'</div></div>'.
            '<div class="control-group  validating"><label class="control-label">Telefono: </label><div class="controls">'.CHtml::textField('ProvTelefono','', array('readonly' => true)).'</div></div>'.
            $form->dropDownListRow($model,'CONDICION_PAGO',CHtml::listData(CodicionPago::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
            .'</fieldset>'),
        
        array('label'=>'Dirección', 'content'=>
            '<fieldset>'.
            $form->textAreaRow($model,'DIRECCION_EMBARQUE',array('cols' => '50', 'rows' => '5')).
            $form->textAreaRow($model,'DIRECCION_COBRO',array('cols' => '50', 'rows' => '5')).
            '</fliedset>'),
             
        array('label'=>'Campos adicionales', 'content'=>$rubros),
        
        array('label'=>'Textos', 'content'=>
            '<fieldset>'.
            $form->textFieldRow($model,'COMENTARIO_CXP',array('size'=>60,'maxlength'=>250)).
            $form->textAreaRow($model,'INSTRUCCIONES',array('cols' => '50', 'rows' => '5')).
            $form->textAreaRow($model,'OBSERVACIONES',array('cols' => '50', 'rows' => '5')).
            '</fieldset>'),
        
        array('label'=>'Montos', 'content'=>
            '<fieldset>'.
            '<table><tr>'.
                '<td>'.$porcentaje.'</td>
                <td><div class="control-group  validating"><label class="control-label">Total Mercaderia: </label><div class="controls">'.CHtml::textField('TotalMerc','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>'.
                '<td>'.$form->textFieldRow($model,'MONTO_FLETE',array('size'=>6,'maxlength'=>28, 'class'=>'calculoMonto', 'onFocus'=> "if (this.value=='0') this.value='';")).'</td>
                <td><div class="control-group  validating"><label class="control-label">- Descuento: </label><div class="controls">'.CHtml::textField('MenosDescuento','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>'.$form->textFieldRow($model,'MONTO_SEGURO',array('size'=>6,'maxlength'=>28, 'class'=>'calculoMonto', 'onFocus'=> "if (this.value=='0') this.value='';")).'</td>
                <td><div class="control-group  validating"><label class="control-label">+ Imp. de ventas: </label><div class="controls">'.CHtml::textField('ImpVentas','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>'.$form->textFieldRow($model,'MONTO_ANTICIPO',array('size'=>6,'maxlength'=>28, 'class'=>'calculoMonto', 'onFocus'=> "if (this.value=='0') this.value='';")).'</td>
                <td><div class="control-group  validating"><label class="control-label">+ Flete: </label><div class="controls">'.CHtml::textField('Flete','', array('readonly'=>true)).'</div></div></td>
            </tr>
            <tr>
                <td>'.$form->dropDownListRow($model,'TIPO_PRORRATEO_OC',array('CAN'=>'Cantidad','PRE'=>'Precio','PRO'=>'Promedio', 'NIN'=>'Ninguno')).'</td>
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
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('solicitudOc/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); ?>

    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'proveedor')); ?>
    <div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
                <?php 
                    $funcion = 'cargaProveedorGrilla';
                    $id = 'proveedor-grid';
                    $data=$proveedor->search();
                    $data->pagination = array('pageSize'=>4);
                    echo $this->renderPartial('/proveedor/proveedores', array('proveedor'=>$proveedor,'funcion'=>$funcion,'id'=>$id,'data'=>$data,'check'=>false));
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
    
 <?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'articulo')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
                    $funcion = 'cargaArticuloGrilla';
                    $id = 'articulo-grid';
                    $data=$articulo->search();
                    $data->pagination = array('pageSize'=>4);
                    echo $this->renderPartial('/articulo/articulos', array('articulo'=>$articulo,'funcion'=>$funcion,'id'=>$id,'data'=>$data,'check'=>false));
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
       
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'lineas')); ?>
    <div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
                <?php 
            $this->widget('bootstrap.widgets.TbGridView', array(
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
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cargar Líneas',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal', 'onclick' => 'cargaSolicitud()'),
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
    <?php echo CHtml::HiddenField('check',''); ?>
    <?php echo CHtml::HiddenField('contador', '0'); ?>
    <?php echo CHtml::hiddenField('oculto', ''); ?>
    <?php echo CHtml::hiddenField('afecta', $config->IMP1_AFECTA_DESCTO); ?>
    <?php echo CHtml::hiddenField('numLineas', $config->MAXIMO_LINORDEN); ?>    
</div><!-- form -->