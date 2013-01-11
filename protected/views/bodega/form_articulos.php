<script>
    $(document).ready(inicio);
    
    function inicio(){
        
            
            $('.edit').live('click',function(){
                $('#SPAN').val('');
                $('#NAME').val($(this).attr('name'));
                actualiza();
            });
            $('.editU').live('click',function(){
                $('#SPAN').val('U');
                $('#NAME').val($(this).attr('name'));
                actualiza();
            });
            $('#Pedido_UNIDAD').live('change',function(){
                var nombre = $('#Pedido_UNIDAD option:selected').html()
                $('#NOMBRE_UNIDAD').val(nombre);
            });
            
            $('#Pedido_ARTICULO').change(function(){
                $.getJSON('<?php echo $this->createUrl('/bodega/dirigir'); ?>&FU=AR&ID='+$(this).val(),
                    function(data){
                        $("#Articulo_desc").val(data.NOMBRE);
                        $('#NOMBRE_UNIDAD').val(data.UNIDAD_NOMBRE);
                        $('#agregar').attr('disabled', false);
                 });     

            });

    }
    
    function cargaGrilla(grid_id){
        var ID = $.fn.yiiGridView.getSelection(grid_id);
        var url;
        var campo;
        var campo_nombre;

        if (grid_id == 'articulo-grid'){
            url = '<?php echo $this->createUrl('/bodega/dirigir'); ?>&FU=AR&ID='+ID;
            campo = '#Articulo_ARTICULO';
            campo_nombre = '#Articulo_desc';
            $('#agregar').attr('disabled', false);
        }
        $.getJSON(url,function(data){
                    $(campo).val(ID);
                    $(campo_nombre).val(data.NOMBRE); 
                });    
    }
    
    function formato(input){
        var num = input.value.replace(/\./g,'');
        if(!/,/.test(num)){
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/,'');
            input.value = num;
        }
    }
</script>
<div class="form">

<?php
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'pedido-form',
            'type'=>'horizontal',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                  'validateOnSubmit'=>true,
             ),	
    )); 
?>
    
<?php
    $renderLineas = $this->renderPartial('lineas', array('linea'=>$linea, 'form'=>$form, 'model'=>$model,'ruta2'=>$ruta2,'modelLinea'=>$modelLinea, 'articulo'=>$articulo),true);
    
?>

	<?php echo $form->errorSummary(array($model)); ?>
            <table  style="width: 250px">
            <!-- <table style="margin-left: -100px;"> -->
                <tr>
                    <td>
                        <?php //echo $form->dropDownListRow($model,'CONSECUTIVO',CHtml::listData(ConsecutivoFa::model()->findAllByAttributes(array('ACTIVO'=>'S','CLASIFICACION'=>'P')),'CODIGO_CONSECUTIVO','DESCRIPCION'),array('empty'=>'Seleccione','style'=>'width: 100px;')); ?>
                        <?php echo $form->textFieldRow($model,'ID',array('size'=>15,'readonly'=>true)); ?>
                    </td>
                    <td>
                        <?php //echo $form->textField($model,'PEDIDO',array('size'=>15,'maxlength'=>50,'readonly'=>true)); ?>
                        <?php echo $form->textFieldRow($model,'DESCRIPCION',array('size'=>30,'readonly'=>true)); ?>
                    </td>
                </tr>
            </table>
        <?php /*$this->widget('bootstrap.widgets.TbTabs', array(
                'type'=>'tabs', // 'tabs' or 'pills'
                'tabs'=>array( 
                    array('label'=>'Líneas', 'content'=>$renderLineas, 'active'=>true),
                )
            )); */
        
        echo $renderLineas;
        ?>

        <div align="center">
            <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.TbButton', array('label'=>'Cancelar', 'size'=>'small', 'url' => array('pedido/admin'), 'icon' => 'remove'));  ?>
	</div>

</div><!-- form -->

<?php $this->endWidget(); ?>
<!--ventanas modales-->

    <?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'articulo')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php
            $funcion = 'cargaGrilla';
            $id = 'articulo-grid';
            $data=$articulo->searchModal();
            $this->renderPartial('/articulo/articulos', array('articulo'=>$articulo,'funcion'=>$funcion,'id'=>$id,'check'=>false,'data'=>$data));
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
    
<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'nuevo')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Línea</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
        <div id="form-lineas">
            <?php  $this->renderPartial('form_lineas', 
                        array(
                            'model'=>$model,
                            'linea'=>$linea,
                            'ruta'=>$ruta,
                        )
                    ); ?>
        </div>
 
<?php $this->endWidget(); ?>

<!--Fin modales-->