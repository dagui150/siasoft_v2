<script>
    $(document).ready(inicio);
    
    function inicio(){
        
        <?php if(!$model->isNewRecord){ ?>
                    var pais = $('#Cliente_PAIS').val();
                    if(pais == 'COL'){
                        $('#ciudad').slideUp('slow');
                        $('#ubicaciones').slideDown('slow');
                    }
                    else{
                        $('#ubicaciones').slideUp('slow');
                        $('#ciudad').slideDown('slow');
                    }

                    /*$.getJSON(
                        '<?php echo $this->createUrl('proveedor/CargarNit'); ?>&buscar='+$('#Cliente_NIT').val(),
                        function(data)
                        {
                            $('#Cliente_NIT').val(data.ID);
                            $('#Nit2').val(data.NOMBRE);
                        }
                   )*/
        <?php } ?>

        $('#Cliente_PAIS').change(function(){
            var pais = $(this).val();
            if(pais == 'COL'){
                $('#ciudad').slideUp('slow');
                $('#ubicaciones').slideDown('slow');
            }
            else{
                $('#ubicaciones').slideUp('slow');
                $('#ciudad').slideDown('slow');
            }
            $.getJSON('<?php echo $this->createUrl('/zona/cargarzonas')?>&pais='+pais,
                    function(data){

                         $('select[id$=Cliente_ZONA ] > option').remove();
                          $('#Cliente_ZONA').append("<option value=''>Seleccione</option>");

                        $.each(data, function(value, name) {
                                  $('#Cliente_ZONA').append("<option value='"+value+"'>"+name+"</option>");
                            });
             });
        });

        $('#Cliente_UBICACION_GEOGRAFICA1').change(function(){

                $.getJSON('<?php echo $this->createUrl('/proveedor/cargarubicacion')?>&ubicacion='+$(this).val(),
                    function(data){

                         $('select[id$=Cliente_UBICACION_GEOGRAFICA2 ] > option').remove();
                          $('#Cliente_UBICACION_GEOGRAFICA2').append("<option value=''>Seleccione</option>");

                        $.each(data, function(value, name) {
                                  $('#Cliente_UBICACION_GEOGRAFICA2').append("<option value='"+value+"'>"+name+"</option>");
                            });
                    });
        });
               
        $( ".escritoNit" ).autocomplete({
            change: function() {
                if($(this).attr('value') == ''){
                    $('#Nit2').val('Ninguno');
                }else{
                     $.getJSON('<?php echo $this->createUrl('proveedor/CargarNit'); ?>&buscar='+$(this).attr('value'),
                        function(data)
                        {
                            $('#Nit2').val(data.NOMBRE);
                        }
                   );
                }
            }
        });
        $( ".escritoImpuesto" ).autocomplete({
            change: function() { 
                if($(this).attr('value') == ''){
                    $('#IMPUESTO').val('Ninguno');
                }else{
                    $.getJSON(
                        '<?php echo $this->createUrl('impuesto/cargarimpuesto'); ?>&id='+$(this).attr('value'),
                        function(data)
                        {
                            $('#IMPUESTO').val(data.NOMBRE);
                        }
                   );
                }
                
            }
        });
        $( ".escritoRegimen" ).autocomplete({
            change: function() {
                if($(this).attr('value') == ''){
                    $('#REGIMEN').val('Ninguno');
                }else{
                    $.getJSON(
                        '<?php echo $this->createUrl('regimenTributario/Cargarregimen'); ?>&id='+$(this).attr('value'),
                        function(data)
                        {
                            $('#REGIMEN').val(data.DESCRIPCION);
                        }
                   );
                }
            }
        });
    }
    
    function updateImpuesto(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('impuesto/cargarimpuesto'); ?>&id='+id,
            function(data){
                $('#Cliente_IMPUESTO').val(data.ID);
                $('#IMPUESTO').val(data.NOMBRE);

            }
        );
    }
    
    function updateRegimen(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('regimenTributario/cargarregimen'); ?>&id='+id,
            function(data){
                $('#Cliente_REGIMEN').val(data.REGIMEN);
                $('#REGIMEN').val(data.DESCRIPCION);

            }
        );
    }
    
    function cargaNitGrilla(grid_id){
    var buscar = $.fn.yiiGridView.getSelection(grid_id);
    
    $.getJSON(
        '<?php echo $this->createUrl('proveedor/CargarNit'); ?>&buscar='+buscar,
        function(data)
        {
            $('#Cliente_NIT').val(data.ID);
            $('#Nit2').val(data.NOMBRE);
        }
    )
}
</script>
<div class="form">

<?php  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'cliente-form',
	'enableAjaxValidation'=>true,
        'clientOptions'=>array(
              'validateOnSubmit'=>true,
        ),
        'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

        <table>
                <tr>
                    <td >
                        <div align="left" style="width: 120px;">
                            <?php echo $form->textFieldRow($model,'CLIENTE',array('maxlength'=>20,'disabled'=>$model->isNewRecord ? false : true));?>
                        </div>
                    </td>
                    <td>
                        <div align="left" style="width: 228px;">
                            <?php echo $form->textFieldRow($model,'NOMBRE',array('maxlength'=>60)); ?>
                        </div>
                    </td>
                </tr>

       </table>  

        <?php
                $this->conf = ConfFa::model()->find();
                $calendario = $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                              'model'=>$model,
                              'attribute'=>'FECHA_INGRESO',
                              'language'=>'es',
                              'options'=>array(
                                     'changeMonth'=>true,
                                     'changeYear'=>true,
                                     'dateFormat'=>'yy-mm-dd',
                                     'constrainInput'=>'false',
                                     'showAnim'=>'fadeIn',
                                     'showOn'=>'button',
                                     'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
                                     'buttonImageOnly'=>true,
                              ),
                              'htmlOptions'=>array('style'=>'width:80px;vertical-align:top'),
                ),true);
                
                $autocompletarNit = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model'=>$model,
                    'attribute'=>'NIT',
                    'source'=>$this->createUrl('proveedor/autocompletar'),
                    'htmlOptions'=>array(
                        'size'=>'12',
                        'class'=>'escritoNit'
                    ),
                ), true);
                $autocompletarImpuesto = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model'=>$model,
                    'attribute'=>'IMPUESTO',
                    'source'=>$this->createUrl('autocompletar',array('impuesto'=>1)),
                    'htmlOptions'=>array(
                        'size'=>12,
                        'class'=>'escritoImpuesto',
                        'maxlength'=>4
                    ),
                ), true);
                $autocompletarRegimen = $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'model'=>$model,
                    'attribute'=>'REGIMEN',
                    'source'=>$this->createUrl('autocompletar',array('regimen'=>1)),
                    'htmlOptions'=>array(
                        'size'=>12,
                        'class'=>'escritoRegimen',
                        'maxlength'=>12
                    ),
                ), true);
                
                $botonNit = $this->widget('bootstrap.widgets.TbButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#nit',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true);
                $botonImpuesto = $this->widget('bootstrap.widgets.TbButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#impuesto',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true);
                $botonRegimen = $this->widget('bootstrap.widgets.TbButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#regimen',
                          'icon'=>'search',
                          'htmlOptions'=>array('data-toggle'=>'modal'),
                    ), true);
                
                $this->widget('bootstrap.widgets.TbTabs', array(
                            'type'=>'tabs',
                            'tabs'=>array(
                                array(
                                    'label'=>'General',
                                    'content'=>'
                                            <table>
                                                <tr>
                                                    <td>'
                                                        .$form->labelEx($model,'FECHA_INGRESO',array('class'=>'control-label'))
                                                        .'<div class="controls">'
                                                            .$calendario
                                                            .'<br>'
                                                            .$form->error($model,'FECHA_INGRESO')
                                                        .'</div>'
                                                        .$form->textFieldRow($model,'ALIAS',array('maxlength'=>64))
                                                        .$form->textFieldRow($model,'CONTACTO',array('maxlength'=>64))
                                                        .$form->textFieldRow($model,'CARGO',array('maxlength'=>32))
                                                        .'
                                                        <table>
                                                            <tr>
                                                                <td width="50px;">'.$form->textFieldRow($model,'TELEFONO1', array('maxlength'=>16)).'</td>      
                                                                <td>'.$form->textField($model,'TELEFONO2', array('maxlength'=>16)).'</td>
                                                           </tr>
                                                        </table>'
                                                            .$form->textFieldRow($model,'FAX',array('maxlength'=>16))
                                                        .'<table>
                                                            <tr>
                                                                <td width="50px;">'
                                                                    .$form->labelEx($model,'NIT',array('class'=>'control-label'))
                                                                   .' <div class="controls">'.$autocompletarNit.'</div>
                                                                </td>      
                                                                <td>'.CHtml::textField('Nit2',!$model->isNewRecord ? isset($model->nIT->RAZON_SOCIAL) : '', array('readonly' => true, 'size'=>25)).'</td>'
                                                                .'<td width="10px;">'
                                                                    .$botonNit
                                                               .'</td>
                                                           </tr>
                                                      </table>
                                                      <table>
                                                                <tr>
                                                                    <td width="50px;">'
                                                                        .$form->labelEx($model,'IMPUESTO',array('class'=>'control-label'))
                                                                       .' <div class="controls">'.$autocompletarImpuesto.'</div>
                                                                    </td>      
                                                                    <td>'.CHtml::textField('IMPUESTO',!$model->isNewRecord ? isset($model->iMPUESTO->NOMBRE) : '', array('readonly' => true, 'size'=>25)).'</td>'
                                                                    .'<td width="10px;">'
                                                                        .$botonImpuesto
                                                                   .'</td>
                                                               </tr>
                                                       </table>
                                                       <table>
                                                                <tr>
                                                                    <td width="50px;">'
                                                                        .$form->labelEx($model,'REGIMEN',array('class'=>'control-label'))
                                                                       .' <div class="controls">'.$autocompletarRegimen.'</div>
                                                                    </td>      
                                                                    <td>'.CHtml::textField('REGIMEN',!$model->isNewRecord ? isset($model->rEGIMEN->DESCRIPCION) : '', array('readonly' => true, 'size'=>25)).'</td>'
                                                                    .'<td width="10px;">'
                                                                        .$botonRegimen
                                                                   .'</td>
                                                               </tr>
                                                     </table>
                                                  </td>
                                                  <td>
                                                      <fieldset >
                                                            <legend ><font face="arial" size=3 >Propiedades</font></legend>'
                                                            .$form->dropDownListRow($model,'CATEGORIA',CHtml::listData(Categoria::model()->findAllByAttributes(array('TIPO'=>'C','ACTIVO'=>'S')),'ID','DESCRIPCION'),array('empty'=>'Seleccione','options'=>$model->isNewRecord ? array($this->conf->CATEGORIA_CLIENTE=>array('selected'=>'selected')): array()))
                                                            .$form->dropDownListRow($model,'CONDICION_PAGO',CHtml::listData(CodicionPago::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','DESCRIPCION'),array('empty'=>'Seleccione','options'=>$model->isNewRecord ? array($this->conf->COND_PAGO_CONTADO=>array('selected'=>'selected')): array()))
                                                            .$form->dropDownListRow($model,'TIPO_PRECIO',CHtml::listData(NivelPrecio::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','DESCRIPCION'),array('empty'=>'Seleccione','options'=>$model->isNewRecord ? array($this->conf->NIVEL_PRECIO=>array('selected'=>'selected')): array()))
                                                       .'<br><br></fieldset>
                                                    </td>
                                                </tr>
                                            </table>
                                        ',
                                        'active'=>true
                                    ,   
                                    
                                ),
                                array(
                                    'label'=>'Condiciones',
                                    'content'=>
                                        $form->textFieldRow($model,'INTERES_CORRIENTE',array('size'=>6,'maxlength'=>28,'append'=>'%','class'=>'decimal'))
                                        .$form->textFieldRow($model,'INTERES_MORA',array('size'=>6,'maxlength'=>28,'append'=>'%','class'=>'decimal'))
                                        .$form->textFieldRow($model,'DESCUENTO',array('size'=>6,'maxlength'=>28,'append'=>'%','class'=>'decimal'))
                                        .$form->textFieldRow($model,'LIMITE_CREDITO',array('size'=>14,'maxlength'=>28,'prepend'=>'$','class'=>'decimal'))
                                    ,
                               ),
                               array(
                                    'label'=>'Otros',
                                    'content'=>
                                        '<table>
                                            <tr>
                                                <td>'
                                                    .$form->textFieldRow($model,'EMAIL',array('maxlength'=>128,'prepend'=>'<i class="icon-envelope"></i>'))
                                                    .$form->textFieldRow($model,'SITIO_WEB',array('maxlength'=>128))
                                                    .$form->textFieldRow($model,'DIRECCION_COBRO',array('maxlength'=>128,'size'=>50))
                                                    .$form->textFieldRow($model,'DIRECCION_EMBARQUE',array('maxlength'=>128,'size'=>50))
                                                .'</td>
                                                <td>'
                                                    .$form->dropDownListRow($model,'PAIS',CHtml::listData(Pais::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','NOMBRE'),array('empty'=>'Seleccione'))
                                                    .'<span id="ubicaciones" style="display: none">'
                                                        .$form->dropDownListRow($model,'UBICACION_GEOGRAFICA1',CHtml::listData(UbicacionGeografica1::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','NOMBRE'),array('empty'=>'Seleccione'))
                                                        .$form->dropDownListRow($model,'UBICACION_GEOGRAFICA2',$model->isNewRecord ? array() : CHtml::listData(UbicacionGeografica2::model()->findAllByAttributes(array('ACTIVO'=>'S','UBICACION_GEOGRAFICA1'=>$model->UBICACION_GEOGRAFICA1)),'ID','NOMBRE'),array('empty'=>'Seleccione'))
                                                    .'</span>'
                                                    .'<span id="ciudad" style="display: none">'
                                                        .$form->textFieldRow($model,'CIUDAD',array('maxlength'=>64))
                                                    .'</span>'
                                                    .$form->dropDownListRow($model,'ZONA',$model->isNewRecord ? array() : CHtml::listData(Zona::model()->findAllByAttributes(array('ACTIVO'=>'S','PAIS'=>$model->PAIS)),'ID','NOMBRE'),array('empty'=>'Seleccione'))
                                                .'</td>
                                            </tr>
                                        </table>'
                                    ,
                               ),
                               /*array(
                                    'label'=>'Rubros Valores FA',
                                    'content'=>
                                        '<fieldset >
                                               <legend ><font face="arial" size=3 >Rubros Valores</font></legend>'
                                               .$form->textFieldRow($model,'RUBRO1_FA',array('maxlength'=>64, 'disabled'=>$this->conf->USAR_RUBROS && $this->conf->RUBRO1_NOMBRE != '' ? false : true))
                                               .$form->textFieldRow($model,'RUBRO2_FA',array('maxlength'=>64, 'disabled'=>$this->conf->USAR_RUBROS && $this->conf->RUBRO2_NOMBRE != '' ? false : true))
                                               .$form->textFieldRow($model,'RUBRO3_FA',array('maxlength'=>64, 'disabled'=>$this->conf->USAR_RUBROS && $this->conf->RUBRO3_NOMBRE != '' ? false : true))
                                               .$form->textFieldRow($model,'RUBRO4_FA',array('maxlength'=>64, 'disabled'=>$this->conf->USAR_RUBROS && $this->conf->RUBRO4_NOMBRE != '' ? false : true))
                                               .$form->textFieldRow($model,'RUBRO5_FA',array('maxlength'=>64, 'disabled'=>$this->conf->USAR_RUBROS && $this->conf->RUBRO5_NOMBRE != '' ? false : true))
                                        .'<br><br></fieldset>'
                                    ,
                               ),*/
                            ),
                ));
            ?>
	</div>  
	<?php echo $form->hiddenField($model,'ACTIVO',array('value'=>'S')); ?>

	<div class="row">
		<?php /*echo $form->labelEx($model,'RUBRO1_CC'); ?>
		<?php echo $form->textField($model,'RUBRO1_CC',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'RUBRO1_CC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RUBRO2_CC'); ?>
		<?php echo $form->textField($model,'RUBRO2_CC',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'RUBRO2_CC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RUBRO3_CC'); ?>
		<?php echo $form->textField($model,'RUBRO3_CC',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'RUBRO3_CC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RUBRO4_CC'); ?>
		<?php echo $form->textField($model,'RUBRO4_CC',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'RUBRO4_CC'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'RUBRO5_CC'); ?>
		<?php echo $form->textField($model,'RUBRO5_CC',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'RUBRO5_CC'); */?>
	</div>


	<div class="row buttons" align="center">
		<?php
                     $this->widget('bootstrap.widgets.TbButton', array(
                               'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
                               'buttonType'=>'submit',
                               'type'=>'primary',
                               'icon'=>'ok-circle white', 
                            )
                    );
             ?>
              <?php
                    $this->widget('bootstrap.widgets.TbButton', array(
                                   'label'=>'Cancelar',
                                   'type'=>'action',
                                   'icon'=>'remove ', 
                                   'url'=>array('admin'),
                                )
                   );
             ?>
	</div>

<?php $this->endWidget(); ?>

<?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'nit')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $dataprovider = $nit->search();
            $dataprovider->pagination = array('pageSize'=>5);
            
            $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'articulo-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$dataprovider,
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
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'template'=>'',
                    ),
            ),
    ));
      ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php 
    $this->endWidget(); 

    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'regimen')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateRegimen';
                    $id = 'regimen-grid';
                    echo $this->renderPartial('/regimenTributario/regimen', array('regimen'=>$regimen,'funcion'=>$funcion,'id'=>$id));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php
    $this->endWidget(); 
    
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'impuesto')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateImpuesto';
                    $id = 'impuesto-grid';
                    $data=$impuesto->search(); 
                    echo $this->renderPartial('/articulo/impuesto', array('impuesto'=>$impuesto,'funcion'=>$funcion,'id'=>$id,'data'=>$data));
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