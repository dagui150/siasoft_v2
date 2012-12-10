<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.validate.js"></script>
<script>
$.validator.setDefaults({
	//submitHandler: function() { alert("submitted!"); }
});
$(document).ready(function(){
    $('#ingreso-compra-form').validate();
    $("#ingreso-compra-form").submit(function() {
    var x = $("#contador").val();
      if (x==0) {
        alert("Debe ingresar minimo una linea");
        return false;
      } else
          return true;
    });
    $(".escritoProv").live("change", function (e) {      
       //upModalLineas($(this).attr('value'));
       $.fn.yiiGridView.update('lineas-grid', {data : '0=' + $(this).val()});
       $.getJSON(
            '<?php echo $this->createUrl('ordenCompra/CargarProveedor'); ?>&buscar='+$(this).attr('value'),
            function(data)
            {
                $('#ProvNombre2').val(data.NOMBRE);
            }
       )
    });
});

function upModalLineas(buscar){
    alert(buscar);
    $.fn.yiiGridView.update('lineas-grid', {data:buscar});
}

function cargaProveedorGrilla (grid_id){    
    var buscar = $.fn.yiiGridView.getSelection(grid_id);
    upModalLineas(buscar);
    //$.fn.yiiGridView.update('lineas-grid', {data:buscar});
    $.getJSON(
        '<?php echo $this->createUrl('ingresoCompra/CargarProveedor'); ?>&buscar='+buscar,
        function(data)
        {
            $('#IngresoCompra_PROVEEDOR').val(data.ID);
            $('#ProvNombre2').val(data.NOMBRE);
        }
    )
}
</script>

<?php $prov_boton = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#proveedor',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true); ?>
<div class="form">


<?php
            //Campos de fecha
            $fecha = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'attribute'=>'FECHA_INGRESO',
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
            'htmlOptions'=>array('style'=>'width:80px;vertical-align:top', 'value'=>date("Y-m-d")),  
            ), true); ?>
    
    
    <?php 
        // Validacion de Rubros en la configuracion        
         if($config->USAR_RUBROS == "S") {
                    $rubros = $form->textFieldRow($model,'RUBRO1',array('size'=>50,'maxlength'=>50))
                            .$form->textFieldRow($model,'RUBRO2',array('size'=>50,'maxlength'=>50))
                            .$form->textFieldRow($model,'RUBRO3',array('size'=>50,'maxlength'=>50))
                            .$form->textFieldRow($model,'RUBRO4',array('size'=>50,'maxlength'=>50))
                            .$form->textFieldRow($model,'RUBRO5',array('size'=>50,'maxlength'=>50));
         }
         else{
             $rubros='Para usar esta opcion debes habilitarla en configuracion';
         }
        ?>
    
    
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'ingreso-compra-form',
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
            //Consecutivo
            if($model->INGRESO_COMPRA == ''){
                $mascara = $config->ULT_EMBARQUE_M;
                $retorna = substr($mascara,0,2);
                $mascara = strlen($mascara);
                $longitud = $mascara - 2;
                $sql = "SELECT count(INGRESO_COMPRA) FROM ingreso_compra";
                $consulta = OrdenCompra::model()->findAllBySql($sql);
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $row=$command->queryRow();
                $bandera=$row['count(INGRESO_COMPRA)'];
                $retorna .= str_pad($bandera, $longitud, "0", STR_PAD_LEFT);
                $pestana = $this->renderPartial('lineas', array('form'=>$form, 'linea'=>$linea, 'model'=>$model),true);
            }
            else{
                $retorna = $model->ORDEN_COMPRA;
                //$pestana = $this->renderPartial('lineaUpd', array('form'=>$form, 'linea'=>$linea, 'items'=>$items, 'linea2'=>$linea2),true);
            }
    ?> 

	<?php echo $form->errorSummary($model); ?>
    
    
    
    <table>
        <tr>
            <td><?php echo $estado; ?></td>
            <td><?php echo $form->textFieldRow($model,'INGRESO_COMPRA',array('size'=>10,'maxlength'=>10, 'value'=>$retorna, 'readonly'=>'true')); ?></td>
        </tr>
    </table>
        <?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'tabs'=>array(
        array('label'=>'General', 'content'=>'<table><tr>
            <td width=30%>'.$form->textFieldRow($model,'PROVEEDOR',array('size'=>20,'maxlength'=>20, 'class'=>'escritoProv'))."</td><td>".CHtml::textField('ProvNombre2','', array('readonly' => true))." ".$prov_boton."</td></tr></table>"
            .'<table><tr><td width= "50%"><div class="control-group "><label for="IngresoCompra_FECHA_INGRESO" class="control-label required">Fecha Ingreso <span class="required">*</span></label><div class="controls">'.$fecha.'</div></div></td>
                <td>
                    '.$form->checkBoxRow($model, 'TIENE_FACTURA').'
                </td></tr></table>'
	, 'active'=>true),
        
        array('label'=>'Líneas', 'content'=>$pestana),
        array('label'=>'Factura', 'content'=>'Factura'),
        array('label'=>'Devoluciones', 'content'=>'Devoluciones'),
        array('label'=>'Rubros', 'content'=>
             $rubros
            ),
        array('label'=>'Notas', 'content'=>
            $form->textAreaRow($model,'NOTAS',array('rows'=>6, 'cols'=>50))
            ),
        array('label'=>'Auditoria', 'content'=>
            '<table>
                <tr>
            <td>'.$form->textFieldRow($model,'APLICADO_POR',array('size'=>20,'maxlength'=>20, 'readonly'=>'true')).'</td>
            <td>'.$form->textFieldRow($model,'APLICADO_EL', array('readonly'=>'true')).'</td>
                </tr>
                <tr>
            <td>'.$form->textFieldRow($model,'CANCELADO_POR',array('size'=>20,'maxlength'=>20, 'readonly'=>'true')).'</td>
            <td>'.$form->textFieldRow($model,'CANCELADO_EL', array('readonly'=>'true')).'</td>
                </tr>
                <tr>
            <td>'.$form->textFieldRow($model,'CREADO_POR',array('size'=>20,'maxlength'=>20, 'readonly'=>'true')).'</td>
            <td>'.$form->textFieldRow($model,'CREADO_EL', array('readonly'=>'true')).'</td>
                </tr>
                <tr>
            <td>'.$form->textFieldRow($model,'MODIFICADO_POR',array('size'=>20,'maxlength'=>20, 'readonly'=>'true')).'</td>
            <td>'.$form->textFieldRow($model,'MODIFICADO_EL', array('readonly'=>'true')).'</td>
                </tr>
            </table>'
            ),
        
        
        ),
            ));
        ?>
    
	<div align="center">           
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small', 'url' => array('ingresoCompra/admin'), 'icon' => 'remove'));  ?>
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
                        'header'=>'Codigo Proveedor',
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
                'dataProvider'=>$dataProviderOrdenes,
                'filter'=>$ordenLinea,
                'columns'=>array(
                    array('class'=>'CCheckBoxColumn'),
                    array('name'=>'ORDEN_COMPRA_LINEA',
                            'header'=>'Codigo Orden de compra'),
                    array('name' => 'ARTICULO', 'value'=>'$data->aRTICULO->NOMBRE'),
                        'FECHA_REQUERIDA',
                ),
            ));
             ?>
	</div>
        <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cargar Lineas',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal', 'onclick' => 'cargaSolicitud()'),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
    
    <?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'actualizarLinea')); ?>
    
    	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Nueva Linea</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
    
        <div id="form-lineas">
                <?php  $this->renderPartial('_form_lineas', 
                        array(
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    ); ?>
	</div>

    <?php $this->endWidget(); ?>
    
</div><!-- form -->