<script>
    $(document).ready(function(){
        inicio();
        rubros();
    });
    
    function rubros(){
        if($("#ConfFa_USAR_RUBROS").is(':checked')){
            $('#ConfFa_RUBRO1_NOMBRE').attr('disabled', false);
            $('#ConfFa_RUBRO2_NOMBRE').attr('disabled', false);
            $('#ConfFa_RUBRO3_NOMBRE').attr('disabled', false);
            $('#ConfFa_RUBRO4_NOMBRE').attr('disabled', false);
            $('#ConfFa_RUBRO5_NOMBRE').attr('disabled', false);
            
        } else {

            $('#ConfFa_RUBRO1_NOMBRE').attr('disabled', true);
            $('#ConfFa_RUBRO2_NOMBRE').attr('disabled', true);
            $('#ConfFa_RUBRO3_NOMBRE').attr('disabled', true);
            $('#ConfFa_RUBRO4_NOMBRE').attr('disabled', true);
            $('#ConfFa_RUBRO5_NOMBRE').attr('disabled', true);
            
            $('#ConfFa_RUBRO1_NOMBRE').val('');
            $('#ConfFa_RUBRO2_NOMBRE').val('');
            $('#ConfFa_RUBRO3_NOMBRE').val('');
            $('#ConfFa_RUBRO4_NOMBRE').val('');
            $('#ConfFa_RUBRO5_NOMBRE').val('');
        }
    }
    
    //DAR VALORES A CAMPOS CON SELECCION DE GRILLA
    function updateCampos(id_grilla){
        var id = $.fn.yiiGridView.getSelection(id_grilla);
        var url;
        var campo;
        var campo_nombre;
        
        if(id_grilla == 'bodega-grid'){
            
            url = '<?php echo $this->createUrl('agregarlinea');?>&idBodega='+id;
            campo = '#ConfFa_BODEGA_DEFECTO';
            campo_nombre = '#Bodega2';
            
        }else if(id_grilla == 'categoria-grid'){
            
            url = '<?php echo $this->createUrl('agregarlinea');?>&idCategoria='+id;
            campo = '#ConfFa_CATEGORIA_CLIENTE';
            campo_nombre = '#Categoria2';
            
        }else if(id_grilla == 'condicion-grid'){
            
            url = '<?php echo $this->createUrl('agregarlinea');?>&idCondicion='+id;
            campo = '#ConfFa_COND_PAGO_CONTADO';
            campo_nombre = '#Condicion2';
            
        }
        
        $.getJSON(url,function(data){
                $(campo).val(id);
                $(campo_nombre).val(data.NOMBRE);
            });
        
    }
    
    function inicio(){
                
        $( ".escritoCond" ).autocomplete({
        change: function(e) { 
            $.getJSON(
                '<?php echo $this->createUrl('CargarCond'); ?>&buscar='+$(this).attr('value'),
                function(data)
                {
                    $('#ConfFa_COND_PAGO_CONTADO').val(data.ID);
                    $('#Condicion2').val(data.NOMBRE);
                }
            )
            }
        });
        
        $( ".escritoBod" ).autocomplete({
        change: function(e) { 
            $.getJSON(
                '<?php echo $this->createUrl('CargarBod'); ?>&buscar='+$(this).attr('value'),
                function(data)
                {
                    $('#ConfFa_BODEGA_DEFECTO').val(data.ID);
                    $('#Bodega2').val(data.NOMBRE);
                }
            )
            }
        });
        
        $( ".escritoCat" ).autocomplete({
        change: function(e) { 
            $.getJSON(
                '<?php echo $this->createUrl('CargarCat'); ?>&buscar='+$(this).attr('value'),
                function(data)
                {
                    $('#ConfFa_CATEGORIA_CLIENTE').val(data.ID);
                    $('#Categoria2').val(data.NOMBRE);
                }
            )
            }
        });
    }
</script>
<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'conf-fa-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <?php
    $autocompletarCond = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model,
        'attribute'=>'COND_PAGO_CONTADO',
        'source'=>$this->createUrl('autocompletar', array('parametro'=>'CON')),
        'htmlOptions'=>array(
            'size'=>'12',
            'class'=>'escritoCond'
        ),
    ), true);
    ?>
    
    <?php
    $autocompletarBod = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model,
        'attribute'=>'BODEGA_DEFECTO',
        'source'=>$this->createUrl('autocompletar', array('parametro'=>'BOD')),
        'htmlOptions'=>array(
            'size'=>'12',
            'class'=>'escritoBod'
        ),
    ), true);
    ?>
    
    <?php
    $autocompletarCat = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model,
        'attribute'=>'CATEGORIA_CLIENTE',
        'source'=>$this->createUrl('autocompletar', array('parametro'=>'CAT')),
        'htmlOptions'=>array(
            'size'=>'12',
            'class'=>'escritoCat'
        ),
    ), true);
    ?>
    
    <?php $modalCond = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#condicion',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true); ?>
    
    <?php $modalBod = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#bodega',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true); ?>
    
	<?php echo $form->errorSummary($model); ?>
    
    <?php $modalCat = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#categoria',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true); ?>
    
	<?php echo $form->errorSummary($model); ?>
    
        <?php $this->widget('bootstrap.widgets.BootTabbable', array(
        'type'=>'tabs', // 'tabs' or 'pills'
        'tabs'=>array(

            array('label'=>'General', 'content'=>'<table><tr><td width="30%">
                <div class="control-group "><label for="ConfFa_COND_PAGO_CONTADO" class="control-label">Condicion de pago por defecto</label><div class="controls">'.$autocompletarCond.'</div></div>'      
                .'</td><td width="10px;">'
                .$modalCond
                .'</td><td>'
                .CHtml::textField('Condicion2','', array('readonly' => true, 'size'=>40))
                .'</td></tr>
                <tr><td width="30%">
                <div class="control-group "><label for="ConfFa_BODEGA_DEFECTO" class="control-label">Bodega por defecto</label><div class="controls">'.$autocompletarBod.'</div></div>'      
                .'</td><td width="10px;">'
                .$modalBod
                .'</td><td>'
                .CHtml::textField('Bodega2','', array('readonly' => true, 'size'=>40))
                .'</td></tr>
                <tr><td width="30%">
                <div class="control-group "><label for="ConfFa_CATEGORIA_CLIENTE" class="control-label">Categoria cliente proveedor por defecto</label><div class="controls">'.$autocompletarCat.'</div></div>'      
                .'</td><td width="10px;">'
                .$modalCat
                .'</td><td>'
                .CHtml::textField('Categoria2','', array('readonly' => true, 'size'=>40))
                .'</td></tr></table>'
                .$form->dropDownListRow($model,'NIVEL_PRECIO', CHtml::listData(NivelPrecio::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'),array('empty'=>'Seleccione...'))
                .$form->textFieldRow($model,'DECIMALES_PRECIO')
                .$form->radioButtonListInlineRow($model, 'DESCUENTO_PRECIO', array('U' =>'Precio unitario', 'L' => 'Total de la linea'))
                .$form->radioButtonListInlineRow($model,'DESCUENTO_AFECTA_IMP',array('L' => 'Líneas', 'A' => 'Ambos', 'T' => 'Total', 'N' => 'Ninguno')), 'active'=>true),

            array('label'=>'Impresión', 'content'=>
                 $form->dropDownListRow($model,'FORMATO_PEDIDO', CHtml::listData(FormatoImpresion::model()->findAll('ACTIVO = "S" AND SUBMODULO = "PEDI"'), 'ID', 'NOMBRE'),array('empty'=>'Seleccione...'))
                .$form->dropDownListRow($model,'FORMATO_FACTURA', CHtml::listData(FormatoImpresion::model()->findAll('ACTIVO = "S" AND SUBMODULO = "FACT"'), 'ID', 'NOMBRE'),array('empty'=>'Seleccione...'))
                .$form->dropDownListRow($model,'FORMATO_REMISION', CHtml::listData(FormatoImpresion::model()->findAll('ACTIVO = "S" AND SUBMODULO = "REMI"'), 'ID', 'NOMBRE'),array('empty'=>'Seleccione...'))),


            array('label'=>'Textos', 'content'=>
                 $form->checkboxRow($model,'USAR_RUBROS', array('onclick'=>'rubros()'))
                .$form->textFieldRow($model,'RUBRO1_NOMBRE',array('size'=>15,'maxlength'=>15))
                .$form->textFieldRow($model,'RUBRO2_NOMBRE',array('size'=>15,'maxlength'=>15))
                .$form->textFieldRow($model,'RUBRO3_NOMBRE',array('size'=>15,'maxlength'=>15))
                .$form->textFieldRow($model,'RUBRO4_NOMBRE',array('size'=>15,'maxlength'=>15))
                .$form->textFieldRow($model,'RUBRO5_NOMBRE',array('size'=>15,'maxlength'=>15))
                .$form->textAreaRow($model,'OBSERVACIONES',array('rows'=>6, 'cols'=>50))                
                ),
        ),
    )); ?>

	<div align="center">
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('confCo/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); 

    
$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'condicion')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateCondicion';
                    $id = 'condicion-grid';
                    $this->widget('bootstrap.widgets.BootGridView', array(
                        'type'=>'striped bordered condensed',
                        'id'=>'condicion-grid',
                        'template'=>'{items}{pager}',
                        'dataProvider'=>$condicion->searchMod(),
                        'selectionChanged'=>'updateCampos',
                        'filter'=>$condicion,
                        'columns'=>array(
                                array(
                                    'name'=>'ID',
                                    'header'=>'Código',
                                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                                    'type'=>'raw',
                                    'value'=>'CHtml::link($data->ID,"#")'
                                ),
                                'DESCRIPCION',
                                'DIAS_NETO',                                
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
 
<?php
    $this->endWidget();
    
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'bodega')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateBodega';
                    $id = 'bodega-grid';
                    $this->widget('bootstrap.widgets.BootGridView', array(
                    'type'=>'striped bordered condensed',
                    'id'=>'bodega-grid',                    
                    'template'=>'{items}{pager}',
                    'dataProvider'=>$bodega->searchModal(),
                    'selectionChanged'=>'updateCampos',
                    'filter'=>$bodega,
                    'columns'=>array(
                            array(
                                'name'=>'ID',
                                'header'=>'Código',
                                'htmlOptions'=>array('data-dismiss'=>'modal'),
                                'type'=>'raw',
                                'value'=>'CHtml::link($data->ID,"#")'
                            ),
                            'DESCRIPCION',
                            'TELEFONO',                            
                            'DIRECCION',
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
 
<?php
    $this->endWidget();
    
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'categoria')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateCategoria';
                    $id = 'categoria-grid';
                    $this->widget('bootstrap.widgets.BootGridView', array(
                    'type'=>'striped bordered condensed',
                    'id'=>'categoria-grid',
                    'template'=>'{items}{pager}',
                    'dataProvider'=>$categoria->searchModal(),
                    'selectionChanged'=>'updateCampos',
                    'filter'=>$categoria,
                    'columns'=>array(
                            array(
                                'name'=>'ID',
                                'header'=>'Código',
                                'htmlOptions'=>array('data-dismiss'=>'modal'),
                                'type'=>'raw',
                                'value'=>'CHtml::link($data->ID,"#")'
                            ),
                            'DESCRIPCION',
                            'TIPO',
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
 
<?php
    $this->endWidget(); ?>
    
</div><!-- form -->