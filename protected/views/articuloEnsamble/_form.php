<script>
    $(document).ready(function(){
        inicio();
    });
    
    function inicio(){
        $('#articulo-ensamble-form').validate();
        $(".boton").mouseenter(function() { 
            var enter = $(this).attr('name');
            $('#enter').val($('#ArticuloEnsamble_' + enter + '_ARTICULO_HIJO').val());
        });
        
        $(".emergente").live("click", function (e) {
            //Obtenemos el numero del campo
            contador = $(this).attr('name');
            $('#oculto').val(contador);
	}); 
        
        var id = '<?php echo $_GET['id']; ?>';
        $('#ARTICULO_PADRE').val(id);        
        $.getJSON('<?php echo $this->createUrl('iniciar')?>&id='+id,
            function(data){
                $('#Articulo').val(data.DESCRIPCION);                
        });
                
        var nombreDescripcion;
        var nombreUnidad;
        var contador;
        var nombreClase;
        var nombreCantidad;
        
        $(".tonces").live("change", function (e) {            
            //Obtenemos el numero del campo
            nombreClase = $(this).attr('id').split('_')[0];
            if(nombreClase != 'Nuevo'){
                var nombreClase2 = 'Campo';
            }
            else{
                var nombreClase2 = 'Nuevo';
            }
            contador = $(this).attr('id').split('_')[1];
            nombreDescripcion = nombreClase2 + '_' + contador + '_' + 'DESCRIPCION';
            nombreUnidad = nombreClase2 + '_' + contador + '_' + 'UNIDAD';
            nombreCantidad = nombreClase2 + '_' + contador + '_' + 'CANTIDAD';
            var retorna = verificar($(this).attr('value'), nombreCantidad);
            
            if(retorna == false){
                $.getJSON(
                '<?php echo $this->createUrl('CargaArticulo'); ?>&id='+$(this).attr('value'),

                      function(data)
                      {                        
                            if(data.DESCRIPCION == 'Ninguno'){                            
                                error(nombreCantidad);
                            }
                            else{                            
                                $('select[id$=' + nombreUnidad).remove();                    
                            $.each(data.UNIDADES, function(value, name) {
                                    if(value == data.UNIDAD)
                                      $('#'+ nombreUnidad).append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                    else
                                       $('#' + nombreUnidad).append("<option value='"+value+"'>"+name+"</option>");
                                });
                                $('#' + nombreDescripcion).val(data.DESCRIPCION);
                                exito(nombreCantidad);
                            }
                      });
            }
            });
        }
        
        function verificar(id, nombreCantidad){
        
            var completo = $('#repetir').val().split(',');
            var retorna = false;
            for(var i=0; i<completo.length;i++){
                if(completo[i] == id){
                    error(nombreCantidad);
                    retorna = true;
                }
            }
            return retorna;
        }
              
        function error(nombreCantidad){
            $("#error").addClass("alert alert-error");
            $("#error").text("Debe ingresar un articulo valido o no repetido antes de continuar");   
            $("#error").fadeIn(1000);    
            $("#botones").fadeOut(1000);
            $('#' + nombreCantidad).attr('readonly', true);
            $('#' + nombreCantidad).val('');
        }
        
        function exito(nombreCantidad){
            $("#error").fadeOut(1000);
            $("#botones").fadeIn(1000);
            $('#' + nombreCantidad).attr('readonly', false);
        }
        
        function add(){
            var cuentaLineas;
            cuentaLineas = $('#contador').val();
            
            if(cuentaLineas == ''){
                    cuentaLineas = 0;
                    $('#contador').val(cuentaLineas);
            }
            else if (cuentaLineas < '0'){
                $('#contador').val(1);
                $('#remover').addClass('remove');
            }
            else{                
                cuentaLineas = parseInt(cuentaLineas, 10) + 1;
                $('#contador').val(cuentaLineas);
            }
        }
        
        function Eliminar(id){
            enter();
            var cuentaLineas;
            var eliminar = $('#eliminar').get(0).value;
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
        
        function enter(){
            var completo = $('#repetir').val().split(',');
            var unico = $('#enter').val();            
            
            for(var i=0; i<completo.length;i++){
                if(completo[i] == unico){
                    completo[i] = -1;                    
                }
            }
            completo.join(',');            
            $('#repetir').val(completo);           
        }
        
        function cargaArticuloGrilla (grid_id){
       
           var contador = $('#oculto').get(0).value;
           var id = $.fn.yiiGridView.getSelection(grid_id);
           var nombreClase = 'Nuevo';          
           var nombreDescripcion;
           var nombreUnidad;
           var nombreCantidad;
           
           nombreCantidad = nombreClase + '_' + contador + '_' + 'CANTIDAD';
           nombreDescripcion = nombreClase + '_' + contador + '_' + 'DESCRIPCION';
           nombreUnidad = nombreClase + '_' + contador + '_' + 'UNIDAD';           

            $.getJSON(
                '<?php echo $this->createUrl('CargaArticulo'); ?>&id='+id,
                function(data)
                  {
                        if(data.DESCRIPCION == 'Ninguno'){                            
                            error(nombreCantidad);
                        }
                        else{
                            $('#' + nombreUnidad).val(data.UNIDAD);
                            $('select[id$='+nombreUnidad+']>option').remove();                    
                            $.each(data.UNIDADES, function(value, name) {
                                    if(value == data.UNIDAD)
                                      $('#'+ nombreUnidad).append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                    else
                                       $('#' + nombreUnidad).append("<option value='"+value+"'>"+name+"</option>");
                                });
                            $('#' + nombreDescripcion).val(data.DESCRIPCION);
                            $('#' + nombreClase + '_' + contador + '_' + 'ARTICULO_HIJO').val(id);  
                            exito(nombreCantidad);
                        }
		  })

            }
            
        function cargaArticuloActualiza (grid_id){
       
           var contador = $('#oculto').get(0).value;
           var id = $.fn.yiiGridView.getSelection(grid_id);
           var nombreClase = 'ArticuloEnsamble';
           var nombreClase2 = 'Campo';
           var nombreDescripcion;
           var nombreUnidad;
           var nombreCantidad;
           
           nombreCantidad = nombreClase + '_' + contador + '_' + 'CANTIDAD';
           nombreDescripcion = nombreClase2 + '_' + contador + '_' + 'DESCRIPCION';
           nombreUnidad = nombreClase2 + '_' + contador + '_' + 'UNIDAD';

            $.getJSON(
                '<?php echo $this->createUrl('CargaArticulo'); ?>&id='+id,
                function(data)
                  {
                        if(data.DESCRIPCION == 'Ninguno'){                            
                            error(nombreCantidad);
                        }
                        else{
                            $('select[id$='+nombreUnidad+']>option').remove();                     
                            $.each(data.UNIDADES, function(value, name) {
                                    if(value == data.UNIDAD)
                                      $('#'+ nombreUnidad).append("<option selected='selected' value='"+value+"'>"+name+"</option>");
                                    else
                                       $('#' + nombreUnidad).append("<option value='"+value+"'>"+name+"</option>");
                                });
                            $('#' + nombreDescripcion).val(data.DESCRIPCION);
                            $('#' + nombreClase + '_' + contador + '_' + 'ARTICULO_HIJO').val(id);  
                            exito(nombreCantidad);
                        }
		  })

            }
    
</script>
<?php

    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
?>
<div class="form">
<?php 
    $i = ''; 
    $repetir = '';
?>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'articulo-ensamble-form',
	'type'=>'horizontal',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
)); ?>
        <div id="error"></div>
	<?php echo $form->errorSummary($model); ?>
    
                <table>
                    <tr>
                        <td>
                            <label>Articulo Padre</label>
                        </td>
                        <td width="20%">
                            <?php echo CHtml::textField('ARTICULO_PADRE', $_GET['id'],array('size'=>20,'maxlength'=>20, 'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField('Articulo', '', array('size'=>50, 'readonly'=>true)); ?>
                        </td>
                    </tr>
                </table> 
    
    
                    <div class="complex">
                    <div class="panel">
                        <table class="templateFrame grid table table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <td>
                                        <label>Articulo</label>
                                    </td>
                                    <td>
                                       &nbsp;
                                    </td>
                                    <td>
                                        <label>Descripción</label>
                                    </td>
                                    <td>
                                        <label>Cantidad</label>
                                    </td>
                                    <td>
                                        <label>Unidad Almacén</label>
                                    </td>                                    
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div id="add" class="add">
                                            <?php $this->darBotonAddLinea('Nuevo',array('onClick' => 'add()')); ?>
                                        </div>
                                        <textarea class="template" rows="0" cols="0" style="display: none;" >
                                            <tr class="templateContent">
                                                <td>                                                    
                                                    <?php echo CHtml::textField('Nuevo[{0}][ARTICULO_HIJO]','',array('class' => 'tonces')); ?>
                                                </td>
                                                <td>
                                                    <?php $this->darBotonBuscar('#articulo',false,array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => '{0}', 'id' =>'Nuevo','style'=>'margin-top: 5px;')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][DESCRIPCION]','',array('readonly' => true)); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::textField('Nuevo[{0}][CANTIDAD]','',array('class' => 'decimal')); ?>
                                                </td>
                                                <td>
                                                    <?php echo CHtml::dropDownList('Nuevo[{0}][UNIDAD]','', array(), array('empty'=>'Seleccione')); ?>
                                                </td>                                                
                                                <td>
                                                    <div id="remover" class="remove">
                                                        <?php $this->darBotonDeleteLinea('',array('id'=>'-1', 'onClick'=>'Eliminar(id)')); ?>
                                                    </div>
                                                    <input type="hidden" class="rowIndex" value="{0}" />
                                                </td>
                                            </tr>
                                        </textarea>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody class="templateTarget">
                                    <?php foreach($guardadas as $i=>$item): ?>
                                
                                <tr class="templateContent">
                                    <td>
                            <?php echo $form->textField($item,"[$i]ARTICULO_HIJO", array('class'=>'tonces')); ?>
                            <?php echo $form->hiddenField($item,"[$i]ID"); ?>
                            		</td>
                                    <td>
                                        <?php $this->darBotonBuscar('#actualiza',false,array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => "$i", 'id'=>'ArticuloEnsamble','style'=>'margin-top: 5px;')); ?>
                        </td>
                        <td>
                            <?php echo CHtml::textField("Campo[$i]_DESCRIPCION",$item->aRTICULOHIJO->NOMBRE,array('readonly' => true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textField($item,"[$i]CANTIDAD", array('class'=>'decimal')); ?>
                        </td>
                        <td>
                            <?php echo $form->dropDownList($item,"[$i]UNIDAD", CHtml::listData(UnidadMedida::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>$item->uNIDADALMACEN->TIPO)),'ID','NOMBRE'), array('empty'=>'Seleccione')); ?>
                        </td>
                        <td>
                            <div id="remover" class="remove">
                                <?php $this->darBotonDeleteLinea('',array('onClick'=>'Eliminar(id)', 'id'=>$item["ID"], 'name'=>$i, 'class'=>'boton')); ?>
                            </div>
                         </td>
                      </tr>
                      <?php $repetir .= $item->ARTICULO_HIJO.',';?>
                      <?php endforeach; ?>                      
                </tbody>
             </table>
         </div><!--panel-->
      </div><!--complex-->
      <?php echo CHtml::HiddenField('oculto',''); ?>
	<div align="center" id="botones">
            <?php $this->darBotonEnviar($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(); ?>
	</div>
        
        <?php echo CHtml::hiddenField('enter', ''); ?>
        <?php echo CHtml::hiddenField('eliminar',''); ?>
        <?php echo CHtml::HiddenField('contador', $i); ?>
        <?php echo CHtml::HiddenField('repetir', $repetir); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'articulo')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'articulo-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$articulo->searchKit($_GET['id']),
            'selectionChanged'=>'cargaArticuloGrilla',
            'filter'=>$articulo,
            'columns'=>array(
                array(  'name'=>'ARTICULO',
                        'header'=>'Codigo Articulo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ARTICULO,"#")'
                    ),
                    'NOMBRE',
                    'TIPO_ARTICULO',
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
 
<?php $this->endWidget(); ?>

<?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'actualiza')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'actualiza-grid',
            'template'=>"{items} {pager}",
            'dataProvider'=>$articulo->searchKit($_GET['id']),
            'selectionChanged'=>'cargaArticuloActualiza',
            'filter'=>$articulo,
            'columns'=>array(
                array(  'name'=>'ARTICULO',
                        'header'=>'Codigo Articulo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ARTICULO,"#")'
                    ),
                    'NOMBRE',
                    'TIPO_ARTICULO',
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
 
<?php $this->endWidget(); ?>