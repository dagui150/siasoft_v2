<script>
$(document).ready(function(){
    
        var nombreClase = '<?php echo get_class($linea); ?>';
        var nombreClase2 = '<?php echo get_class($linea2); ?>';
        var nombreDescripcion;
        var nombreUnidad;
        var nombreDescripcion2;
        var nombreUnidad2;
        var contador;
        var linea =  $('#linea').get(0).value;
        var nombreFecha;
        //var nombreLinea;
        var nombreFecha2;
        var nombreLinea2;
        
       $("body").delegate("input", "click", function(e){
           // $(".fecha").live("click", function (e) {
                contador = $(this).attr('id').split('_')[1];
                nombreFecha = nombreClase + '_' + contador + '_' + 'FECHA_REQUERIDA';
                //nombreLinea = nombreClase + '_' + contador + '_' + 'LINEA_NUM';
                nombreFecha2 = nombreClase2 + '_' + contador + '_' + 'FECHA_REQUERIDA';
                nombreLinea2 = nombreClase2 + '_' + contador + '_' + 'LINEA_NUM';
                linea = parseInt(contador, 10) + parseInt(linea, 10) + 1;
                
                $(function() {
                    $( "#" + nombreFecha ).datepicker({dateFormat: 'yy-mm-dd'});
                    //$( "#" + nombreFecha ).datepicker($.datepicker.regional['es']);
                    //$("#" + nombreLinea ).val(linea);
                    $( "#" + nombreFecha2 ).datepicker({dateFormat: 'yy-mm-dd'});
                    $.datepicker.setDefaults($.datepicker.regional['es']);
                    //$( "#" + nombreFecha ).datepicker($.datepicker.regional['es']);
                    $("#" + nombreLinea2 ).val(linea);
                    linea = $('#linea').get(0).value;
                })
            }   
        )
        
	$(".tonces").live("change", function (e) {

            //Obtenemos el numero del campo
            contador = $(this).attr('id').split('_')[1];
            nombreDescripcion = nombreClase + '_' + contador + '_' + 'DESCRIPCION';
            nombreUnidad = nombreClase + '_' + contador + '_' + 'UNIDAD';
            
            $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+$(this).attr('value'),
            
		  function(data)
                  {
                        $('select[id$=' + nombreUnidad + '] > option').remove();
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);

                 $('#' + nombreUnidad).append(option);
             });
             }
             else{
                  $('select[id$=' + nombreUnidad + '] > option').remove();
             }
		  });
            
    });
}) 
</script>
<script>
    $(document).ready(function(){

        var nombreClase2 = '<?php echo get_class($linea2); ?>';
        var nombreDescripcion2;
        var nombreUnidad2;
        var contador;
        var nombreFecha2;
        var nombreLinea2;
              
	$(".tonces2").live("change", function (e) {

            //Obtenemos el numero del campo
            contador = $(this).attr('id').split('_')[1];
            nombreDescripcion2 = nombreClase2 + '_' + contador + '_' + 'DESCRIPCION';
            nombreUnidad2 = nombreClase2 + '_' + contador + '_' + 'UNIDAD';
            
            $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+$(this).attr('value'),
            
		  function(data)
                  {
                        $('select[id$=' + nombreUnidad2 + '] > option').remove();
                        $('#' + nombreDescripcion2).val(data.DESCRIPCION);
                        
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);

                 $('#' + nombreUnidad2).append(option);
             });
             }
             else{
                  $('select[id$=' + nombreUnidad2 + '] > option').remove();
             }
		  });
            
    });
}) 
</script>
<script>
$(document).ready(function(){
    
        var contador;
        var numLinea;
        
	$(".emergente").live("click", function (e) {

            //Obtenemos el numero del campo
            contador = $(this).attr('name');
            $('#oculto').val(contador);
	});
        
        $(".numLinea").live("click", function(a) {
            contador = $(this).attr('name');
            $('#linea').val(contador);
        });
        
}) 
</script>
<script>
function cargaArticuloGrilla (grid_id){
       
       var contador = $('#oculto').get(0).value;
       var buscar = $.fn.yiiGridView.getSelection(grid_id);
       var nombreClase = '<?php echo get_class($linea); ?>';
       var nombreDescripcion;
       var nombreUnidad;
       var nombreArticulo;
        
        nombreDescripcion = nombreClase + '_' + contador + '_' + 'DESCRIPCION';
        nombreUnidad = nombreClase + '_' + contador + '_' + 'UNIDAD';
        nombreArticulo = nombreClase + '_' + contador + '_' + 'ARTICULO';
        $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+buscar,
            function(data)
                  {
                        $('select[id$=' + nombreUnidad + '] > option').remove();
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + nombreArticulo).val(data.ID);
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);

                 $('#' + nombreUnidad).append(option);
             });
             }
             else{
                  $('select[id$=' + nombreUnidad + '] > option').remove();
             }
		  })
        
    }

function cargaArticuloGrilla2 (grid_id){
       
       var contador = $('#oculto').get(0).value;
       var buscar = $.fn.yiiGridView.getSelection(grid_id);
       var nombreClase = '<?php echo get_class($linea2); ?>';
       var nombreDescripcion;
       var nombreUnidad;
       var nombreArticulo;
        
        nombreDescripcion = nombreClase + '_' + contador + '_' + 'DESCRIPCION';
        nombreUnidad = nombreClase + '_' + contador + '_' + 'UNIDAD';
        nombreArticulo = nombreClase + '_' + contador + '_' + 'ARTICULO';
        $.getJSON(
            '<?php echo $this->createUrl('solicitudOc/CargarArticulo'); ?>&buscar='+buscar,
            function(data)
                  {
                        $('select[id$=' + nombreUnidad + '] > option').remove();
                        $('#' + nombreDescripcion).val(data.DESCRIPCION);
                        $('#' + nombreArticulo).val(data.ID);
                        if(data.UNIDAD){
             $(data.UNIDAD).each(function()
             {
                 var option = $('<option />');
                 option.attr('value', this.ID).text(this.NOMBRE);

                 $('#' + nombreUnidad).append(option);
             });
             }
             else{
                  $('select[id$=' + nombreUnidad + '] > option').remove();
             }
		  })
        
    }
</script>

<script>
function Eliminar (id){
    var eliminar = $('#eliminar').get(0).value;
    var cuentaLineas;
    
    eliminar = eliminar + id + ",";
    $('#eliminar').val(eliminar);
    cuentaLineas = $('#contador').val();
    
    if (cuentaLineas <= '0'){
        $('#remover').removeClass('remove');
    }
    else{
        cuentaLineas = parseInt(cuentaLineas, 10) - 1;
        $('#contador').val(cuentaLineas);
    }
}

function add(){
    var cuentaLineas;
    cuentaLineas = $('#contador').val();
    
    if (cuentaLineas < '0'){
        $('#contador').val(1);
        $('#remover').addClass('remove');
    }
    else{
        cuentaLineas = parseInt(cuentaLineas, 10) + 1;
        $('#contador').val(cuentaLineas);
    }
}
</script>
<?php

    // lineas para playground
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>


 <div style="overflow-x: scroll; width: 850px; margin-bottom: 10px;">
     
         <!-- Inicio tabla playground -->
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid" cellspacing="0">
                            <thead class="templateHead">
                                <tr>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ARTICULO');?>
                                    </td>
                                    <td>&nbsp;
                                       
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'DESCRIPCION');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'UNIDAD');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'ESTADO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'CANTIDAD');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'FECHA_REQUERIDA');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'COMENTARIO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'SALDO');?>
                                    </td>
                                    <td>
                                        <?php echo $form->labelEx($linea,'LINEA_NUM');?>
                                    </td>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][ARTICULO]','',array('class' => 'tonces')); ?>
                                                </td>
                                                <td>
                                                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => '{0}'),
                                                        )); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][DESCRIPCION]','',array('class' => 'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('SolicitudOcLinea[{0}][UNIDAD]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][ESTADO]','',array('readonly'=>true, 'size'=>'1')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][CANTIDAD]','',array('size'=>'5', 'class' => 'cantidad')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][FECHA_REQUERIDA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][COMENTARIO]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][SALDO]','0',array('readonly'=>true, 'size'=>'5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea[{0}][LINEA_NUM]','0',array('readonly'=>true, 'size'=>'5')); ?>
                                                    <?php echo CHtml::hiddenField('SolicitudOcLinea[{0}][SOLICITUD_OC_LINEA]','0',array()); ?>
                                                </td>                                                
                                                <td>
                                                    <div id="remover" class="remove">
                                                        <?php 
                                                            $this->widget('bootstrap.widgets.BootButton', array(
                                                                    'buttonType'=>'button',
                                                                    'type'=>'danger',
                                                                    'label'=>'',
                                                                    'icon'=>'minus white',
                                                                    'size' => 'normal', 
                                                                    'htmlOptions' => array('id'=>'SolicitudOcLinea{0}', 'onClick'=>'Eliminar(id)'),
                                                              ));
                                                         ?>
                                                    </div>
                                                    <input type="hidden" class="rowIndex" value="{0}" />
                                                </td>
                                            </tr>
                                        </textarea>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody class="templateTarget">
                                <?php 
                                    $persons = array();
                                    foreach($items as $i=>$item):
                                ?>
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($item,"[$i]ARTICULO", array('class'=>'tonces')); ?>
                            		</td>
                                    <td>
                                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => "$i"),
                                                        )); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]DESCRIPCION",array('class'=>'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($item,"[$i]UNIDAD", $linea->getCombo($item->ARTICULO), array('prompt'=>'Seleccione articulo')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]ESTADO",array('readonly'=>true, 'size'=>'1')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]CANTIDAD",array('size'=>'5', 'class' => 'cantidad')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]FECHA_REQUERIDA",array('class' => 'fecha', 'size'=>'10')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]COMENTARIO",array()); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]SALDO",array('readonly'=>true, 'size'=>'5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]LINEA_NUM",array('readonly'=>true, 'size'=>'2')); ?>
                            <?php echo $form->hiddenField($item,"[$i]SOLICITUD_OC_LINEA",array()); ?>
                        </td>
                                    <td>
                                        <div id="remover" class="remove">
                                              <?php 
                                                
                                                 $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'label'=>'',
                                                             'icon'=>'minus white',
                                                             'htmlOptions' => array('id'=>$item["SOLICITUD_OC_LINEA"], 'onClick'=>'Eliminar(id)'),
                                                  ));

                                             ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!--panel-->
                </div><!--complex-->
                
                 <!-- Fin tabla playground -->
     
    

    <!-- Inicio tabla playground -->
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid" cellspacing="0">
                            <thead class="templateHead">
                                
                            </thead>
                            <tfoot>
                                <tr>
                                    <td>
                                        <div id="add" class="add">
                                            <?php 
                                                
                                                $this->widget('bootstrap.widgets.BootButton', array(
                                                        'buttonType'=>'button',
                                                        'type'=>'success',
                                                        'label'=>'Nuevo',
                                                        'icon'=>'plus white',
                                                        'htmlOptions' => array('onClick' => 'add()'),
                                                  ));
                                          
                                            ?>
                                        </div>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][ARTICULO]','',array('class' => 'tonces2')); ?>
                                                </td>
                                                <td>
                                                    <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo2',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => '{0}'),
                                                        )); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][DESCRIPCION]','',array('class' => 'required')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('SolicitudOcLinea2[{0}][UNIDAD]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][ESTADO]','P',array('readonly'=>true, 'size'=>'1')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][CANTIDAD]','',array('size'=>'5', 'class' => 'cantidad')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][FECHA_REQUERIDA]','',array('class' => 'fecha', 'size'=>'10')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][COMENTARIO]','',array()); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][SALDO]','0',array('readonly'=>true, 'size'=>'5')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('SolicitudOcLinea2[{0}][LINEA_NUM]','0',array('readonly'=>true, 'size'=>'2')); ?>
                                                </td>
                                                <td>
                                                    <div id="remover" class="remove">
                                                        <?php 
                                                
                                                            $this->widget('bootstrap.widgets.BootButton', array(
                                                                    'buttonType'=>'button',
                                                                    'type'=>'danger',
                                                                    'label'=>'',
                                                                    'icon'=>'minus white',
                                                                    'size' => 'normal',
                                                                    'htmlOptions' => array('id'=>'-1', 'onClick'=>'Eliminar(id)'),
                                                              ));
                                                         ?>
                                                    </div>
                                                    <input type="hidden" class="rowIndex" value="{0}" />
                                                </td>
                                            </tr>
                                        </textarea>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody class="templateTarget">
                                <?php 
                                    $persons = array();
                                    foreach($persons as $i=>$person):
                                ?>
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($person,"[$i]ARTICULO",array('style'=>'width:100px')); ?>
                                        <?php $this->widget('bootstrap.widgets.BootButton', array(
                                                            'type'=>'info',
                                                            'size'=>'mini',
                                                            'url'=>'#articulo2',
                                                            'icon'=>'search',
                                                            'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => "[$i]"),
                                                        )); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]DESCRIPCION",array('class' => 'required')); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($person,"[$i]UNIDAD",array('prompt'=>'Seleccione articulo')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]ESTADO",array('value'=>'P', 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]CANTIDAD",array('size'=>'5', 'class' => 'cantidad')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]FECHA_REQUERIDA",array('class' => 'fecha')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]COMENTARIO",array()); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]SALDO",array('readonly'=>true, 'size'=>'5')); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($person,"[$i]LINEA_NUM",array('readonly'=>true, 'size'=>'2')); ?>
                        </td>
                                    <td>
                                        <div id="remover" class="remove">
                                              <?php 
                                                
                                                 $this->widget('bootstrap.widgets.BootButton', array(
                                                             'buttonType'=>'button',
                                                             'type'=>'danger',
                                                             'label'=>'Eliminar',
                                                             'icon'=>'minus white',
                                                             'htmlOptions' => array('id'=>'-1', 'onClick'=>'Eliminar(id)'),
                                                  ));

                                             ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div><!--panel-->
                </div><!--complex-->
                
                 <!-- Fin tabla playground -->
                
                <?php echo CHtml::HiddenField('oculto',''); ?>
                <?php echo CHtml::HiddenField('linea', $item->LINEA_NUM); ?>
                <?php echo CHtml::HiddenField('contador', $i); ?>
                <?php echo CHtml::hiddenField('eliminar',''); ?>
 </div>  