<script>
$(document).ready(function(){
    
    <?php if(!$model->isNewRecord){ ?>
                var pais = $('#Proveedor_PAIS').val();
                if(pais == 'COL'){
                    $('#ciudad').slideUp('slow');
                    $('#ub1').slideDown('slow');
                    $('#ub2').slideDown('slow');
                }
                else{
                    $('#ub1').slideUp('slow');
                    $('#ub2').slideUp('slow');
                    $('#ciudad').slideDown('slow');
                }
                
                $.getJSON(
                    '<?php echo $this->createUrl('proveedor/CargarNit'); ?>&buscar='+$('#Proveedor_NIT').val(),
                    function(data)
                    {
                        $('#Proveedor_NIT').val(data.ID);
                        $('#Nit2').val(data.NOMBRE);
                    }
               )
    <?php } ?>
    
    $('#Proveedor_PAIS').change(function(){
        var pais = $('#Proveedor_PAIS').val();
        if(pais == 'COL'){
            $('#ciudad').slideUp('slow');
            $('#ub1').slideDown('slow');
            $('#ub2').slideDown('slow');
        }
        else{
            $('#ub1').slideUp('slow');
            $('#ub2').slideUp('slow');
            $('#ciudad').slideDown('slow');
        }
    });
      
    $('#Proveedor_UBICACION_GEOGRAFICA1').change(function(){
            
            $.getJSON('<?php echo $this->createUrl('cargarubicacion')?>&ubicacion='+$(this).val(),
                function(data){
                    
                     $('select[id$=Proveedor_UBICACION_GEOGRAFICA2 ] > option').remove();
                      $('#Proveedor_UBICACION_GEOGRAFICA2').append("<option value=''>Seleccione</option>");
                    
                    $.each(data, function(value, name) {
                              $('#Proveedor_UBICACION_GEOGRAFICA2').append("<option value='"+value+"'>"+name+"</option>");
                        });
                });
    });
    
    $( ".escritoNit" ).autocomplete({
        change: function(e) { 
            $.getJSON(
                '<?php echo $this->createUrl('proveedor/CargarNit'); ?>&buscar='+$(this).attr('value'),
                function(data)
                {
                    $('#Proveedor_NIT').val(data.ID);
                    $('#Nit2').val(data.NOMBRE);
                }
           )
        }
    });
});

function cargaNitGrilla(grid_id){
    var buscar = $.fn.yiiGridView.getSelection(grid_id);
    
    $.getJSON(
        '<?php echo $this->createUrl('proveedor/CargarNit'); ?>&buscar='+buscar,
        function(data)
        {
            $('#Proveedor_NIT').val(data.ID);
            $('#Nit2').val(data.NOMBRE);
        }
    )
}
</script>
<div class="form">
    
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'proveedor-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),	
)); ?>
    
    <?php
    if($model->isNewRecord){
        $ub2 = $form->dropDownListRow($model,'UBICACION_GEOGRAFICA2',array(),array('empty'=>'Seleccione'));
    }
    else{
        $ub2 = $form->dropDownListRow($model,'UBICACION_GEOGRAFICA2',CHtml::listData(UbicacionGeografica2::model()->findAll('ACTIVO = "S" AND UBICACION_GEOGRAFICA1 = "'.$model->UBICACION_GEOGRAFICA1.'"'),'ID','NOMBRE'));
    }
?>
    
    	<?php echo $form->errorSummary($model); ?>
    <table widht="100%">
        <tr>
            <td>
		<?php echo $form->textFieldRow($model,'PROVEEDOR',array('size'=>20,'maxlength'=>20)); ?>
	</td>
            <td>
		<?php echo $form->textFieldRow($model,'NOMBRE',array('size'=>40,'maxlength'=>80)); ?>
            </td>
        </tr>        
    </table>
    
                <?php $grilla = $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'tipo-cuenta-grid',
	'dataProvider'=>$cuenta->search(),
	'filter'=>$cuenta,
	'columns'=>array(
		'TIPO_CUENTA',
		'DESCRIPCION',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		/*
		'ACTUALIZADO_EL',
		*/
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'template'=> '',
		),
	),
), true);  ?>
        
   <?php
		$tab = $this->widget('zii.widgets.jui.CJuiDatePicker', array(
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
    'htmlOptions'=>array(
        'style'=>'width:80px;vertical-align:top'
    ),  
), true); ?>
    
    <?php
    
    $autocompletar = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model,
        'attribute'=>'NIT',
        'source'=>$this->createUrl('proveedor/autocompletar'),
        'htmlOptions'=>array(
            'size'=>'12',
            'class'=>'escritoNit'
        ),
    ), true);
    
    ?>
    <?php $modal = $this->darBotonBuscar('#nit',true); ?>
    
    <?php $this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        
        array('label'=>'General', 'content'=>
            '<table widht="100%">
                <tr>
                    <td colspan="2">
                        <div class="row">
                            <table>
                                <tr>
                                    <td width="50px;">
                                        <div class="control-group">
                                            <label for="Proveedor_NIT" class="control-label required">NIT 
                                                <span class="required">*</span>
                                            </label>
                                            <div class="controls">'.$autocompletar.'</div>
                                        </div>
                                    </td>      
                                    <td width="10px;">'
                                        .$modal
                                   .'</td><td>'
                                        .CHtml::textField('Nit2','', array('readonly' => true, 'size'=>40))
                                    .'</td>
                               </tr>
                            </table>
                       </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table>
                            <tr>
                                <td>'
                                    .$form->dropDownListRow($model,'PAIS', CHtml::listData(Pais::model()->findAll('ACTIVO = "S"'),'ID','NOMBRE'),array('empty'=>'Seleccione...'))
                                .'</td>
                                <td><div id="ciudad" style="display:none;">'
                                    .$form->textFieldRow($model, 'CIUDAD')
                                .'</div></td>
                            </tr><tr>
                                <td><div id="ub1" style="display:none;">'
                                    .$form->dropDownListRow($model,'UBICACION_GEOGRAFICA1', CHtml::listData(UbicacionGeografica1::model()->findAll('ACTIVO = "S"'),'ID','NOMBRE'), array('empty'=>'Seleccione...'))
                                .'</div></td>
                                <td><div id="ub2" style="display:none;">'
                                    .$ub2
                                .'</div></td>
                            </tr>
                        </table>'                        
                    .'</td>'            
            .'</td></tr><tr><td>'
            
            .$form->textFieldRow($model,'ALIAS',array('size'=>30,'maxlength'=>80))
            .$form->textFieldRow($model,'CONTACTO',array('size'=>30,'maxlength'=>30))
            .$form->textFieldRow($model,'CARGO',array('size'=>30,'maxlength'=>30))
            .'<div class="row">'
            .'<div class="control-group "><label for="Proveedor_CARGO" class="control-label required">Fecha de Ingreso<span class="required"> *</span></label><div class="controls">'
            .$tab
            .'</span></div></div>'
            .'</div>'
            .$form->dropDownListRow($model,'REGIMEN',CHtml::listData(RegimenTributario::model()->findAll('ACTIVO = "S"'),'REGIMEN','REGIMEN')).'</td><td>'
            .$form->textFieldRow($model,'TELEFONO1', array('size'=>20,'maxlength'=>20))
            .$form->textFieldRow($model,'TELEFONO2', array('size'=>20,'maxlength'=>20))
            .$form->textFieldRow($model,'FAX',array('size'=>20,'maxlength'=>20))
            .$form->dropDownListRow($model,'CATEGORIA', CHtml::listData(Categoria::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
            .'</td></tr></table>', 'active'=>true),
        
        array('label'=>'Otros', 'content'=>
            '<fieldset><legend>Condiciones</legend>'
            .$form->dropDownListRow($model,'CONDICION_PAGO', CHtml::listData(CodicionPago::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
            .$form->textFieldRow($model,'ORDEN_MINIMA',array('size'=>28,'maxlength'=>28))
            .$form->textFieldRow($model,'DESCUENTO',array('size'=>28,'maxlength'=>28))
            .$form->textFieldRow($model,'TASA_INTERES_MORA',array('size'=>28,'maxlength'=>28))
            ),
         
        
        array('label'=>'Direcciones', 'content'=>
             '<fieldset>'
            .$form->textFieldRow($model,'EMAIL',array('size'=>50,'maxlength'=>128))
            .$form->textAreaRow($model,'DIRECCION',array('rows'=>6, 'cols'=>50))
            ),
        
        
        array('label'=>'Cuentas', 'content'=>$grilla),
        
        array('label'=>'Notas', 'content'=>
            '<fieldset><div class="row">'
            .$form->labelEx($model,'NOTAS')
            .$form->textArea($model,'NOTAS',array('rows'=>6, 'cols'=>50))
            .$form->error($model,'NOTAS')
            .'</div></fieldset>'),
       
        
    ),
)); ?>
     
    <div class="row">
		<?php
			echo CHtml::activeHiddenField($model,'ACTIVO',array('value'=>'S'));
			echo $form->error($model,'ACTIVO'); 
		?>
	</div>

	<div align="center">
            <?php $this->darBotonEnviar($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(); ?>
	</div>


<?php $this->endWidget(); ?>
    
    <?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'nit')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php
                    $funcion = 'cargaNitGrilla';
                    $id = 'articulo-grid';
                    $data=$nit->search();
                    $data->pagination = array('pageSize'=>4);
                    $this->renderPartial('/nit/nits', array('nit'=>$nit,'funcion'=>$funcion,'id'=>$id,'data'=>$data,'check'=>false));
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
    

</div><!-- form -->