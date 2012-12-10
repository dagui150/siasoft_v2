<script>
$(document).ready(function(){
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

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'proveedor-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),	
)); ?>
    
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
    
                <?php $grilla = $this->widget('bootstrap.widgets.BootGridView', array(
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
                    'class'=>'bootstrap.widgets.BootButtonColumn',
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
    <?php $modal = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#nit',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true); ?>
    
    <?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs', // 'tabs' or 'pills'
    'tabs'=>array(
        
        array('label'=>'General', 'content'=>
            '<fieldset><table widht="100%"><tr><td colspan="2"><div class="row"><table><tr><td width="50px;">'
            .'<div class="control-group "><label for="Proveedor_NIT" class="control-label required">NIT <span class="required">*</span></label><div class="controls">'.$autocompletar.'</div></div></div>'      
            .'</td><td width="10px;">'
            .$modal
            .'</td><td>'
            .CHtml::textField('Nit2','', array('readonly' => true, 'size'=>40))
            .'</td></tr></table></div></td></tr><tr><td>'
            .$form->textFieldRow($model,'ALIAS',array('size'=>30,'maxlength'=>80))
            .$form->textFieldRow($model,'CONTACTO',array('size'=>30,'maxlength'=>30))
            .$form->textFieldRow($model,'CARGO',array('size'=>30,'maxlength'=>30))
            .'<div class="row">'
            .'<div class="control-group "><label for="Proveedor_CARGO" class="control-label required">Fecha de Ingreso<span class="required"> *</span></label><div class="controls">'
            .$tab
            .'</span></div></div>'
            .'</div></td><td>'
            .$form->textFieldRow($model,'TELEFONO1', array('size'=>20,'maxlength'=>20))
            .$form->textFieldRow($model,'TELEFONO2', array('size'=>20,'maxlength'=>20))
            .$form->textFieldRow($model,'FAX',array('size'=>20,'maxlength'=>20))
            .$form->dropDownListRow($model,'CATEGORIA', CHtml::listData(Categoria::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
            .'</td></tr></table></fieldset>', 'active'=>true),
        
        array('label'=>'Otros', 'content'=>
            '<fieldset><legend>Condiciones</legend>'
            .$form->dropDownListRow($model,'CONDICION_PAGO', CHtml::listData(CodicionPago::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
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
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('proveedor/admin'), 'icon' => 'remove'));  ?>
	</div>


<?php $this->endWidget(); ?>
    
    <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'nit')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'articulo-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$nit->search(),
            'selectionChanged'=>'cargaNitGrilla',
            'filter'=>$nit,
            'columns'=>array(
                array(  'name'=>'ID',
                        'header'=>'Nit',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ID,"#")'
                    ),
                    'TIIPO_DOCUMENTO',
                    'RAZON_SOCIAL',
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
    

</div><!-- form -->