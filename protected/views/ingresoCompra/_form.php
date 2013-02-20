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
       $.fn.yiiGridView.update('lineas-grid', {data : '0=' + $(this).val()});
       $.getJSON(
            '<?php echo $this->createUrl('ingresoCompra/CargarProveedor'); ?>&buscar='+$(this).attr('value'),
            function(data)
            {
                $('#ProvNombre2').val(data.NOMBRE);
            }
       )
        $('#advertenciaLineas').css('display','none');
        $('#cargarLineasBoton').css('display','block');
    });
});

function cargaProveedorGrilla (grid_id){    
    var buscar = $.fn.yiiGridView.getSelection(grid_id);
    $.fn.yiiGridView.update('lineas-grid', {data:buscar});
    $.getJSON(
        '<?php echo $this->createUrl('ingresoCompra/CargarProveedor'); ?>&buscar='+buscar,
        function(data)
        {
            $('#IngresoCompra_PROVEEDOR').val(data.ID);
            $('#ProvNombre2').val(data.NOMBRE);
        }
    )
    $('#advertenciaLineas').css('display','none');
    $('#cargarLineasBoton').css('display','block');
}
</script>

<?php $prov_boton = $this->darBotonBuscar('#proveedor',true,array('data-toggle'=>'modal')); ?>
<div class="form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'ingreso-compra-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


<?php
            //Campos de fecha
            $fecha = $this->darCalendario($model, 'FECHA_INGRESO', null);
    ?>
    
    
    <?php 
        // Validacion de Rubros en la configuracion        
         if($config->USAR_RUBROS == "S") {
                    $rubros = '';
                    if($config->RUBRO1_EMBNOM != ''){
                        $rubros .= '<div class="row"><label>'.$config->RUBRO1_EMBNOM.'</label>'
                        .$form->textField($model,'RUBRO1',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO1')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO2_EMBNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO2_EMBNOM.'</label>'
                        .$form->textField($model,'RUBRO2',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO2')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO3_EMBNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO3_EMBNOM.'</label>'
                        .$form->textField($model,'RUBRO3',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO3')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO4_EMBNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO4_EMBNOM.'</label>'
                        .$form->textField($model,'RUBRO4',array('size'=>50,'maxlength'=>50))
                        .$form->error($model,'RUBRO4')
                        .'</div>';                        
                    }
                    
                    if($config->RUBRO5_EMBNOM != ''){                    
                        $rubros .= '<div class="row">'
                        .'<label>'.$config->RUBRO5_EMBNOM.'</label>'
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
        <?php $this->widget('bootstrap.widgets.TbTabs', array(
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
        array('label'=>'Campos adicionales', 'content'=>
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
            <?php $this->darBotonEnviar($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(); ?>
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
                'dataProvider'=>$dataProviderOrdenes,
                'filter'=>$ordenLinea,
                'columns'=>array(
                    array('class'=>'CCheckBoxColumn'),
                    array('name'=>'ORDEN_COMPRA_LINEA',
                            'header'=>'Código Orden de compra'),
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
    
    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'actualizarLinea')); ?>
    
    	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Nueva Línea</h3>
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