<script>
$(document).ready(function(){
    inicio();
});

function inicio(){
    var id = '<?php echo $_GET['id']; ?>';
    $.getJSON('<?php echo $this->createUrl('iniciar')?>&id='+id,
            function(data){
                $('#Descripcion').val(data.DESCRIPCION); 
                $('#Costo').val(data.COSTO_ESTANDAR);
    });
    
    $(".calculosGen").live("change", function (e){
        var ciclos = $('#ciclos').val();  
        var base = $('#Precio_base').val();
        for(var i=0;i<=ciclos;i++){
            var margMul = $('#NivelPrecio3_' + i + '_MARGEN_MULTIPLICADOR').val();
            switch($('#NivelPrecio2_' + i +'_ESQUEMA_TRABAJO').val()){
                case 'NORM':
                    $('#NivelPrecio4_' + i + '_PRECIO').val(base);
                break;
                case 'MULT':
                    if(margMul != ''){
                        margMul = base * margMul / 100;
                        $('#NivelPrecio4_' + i + '_PRECIO').val(margMul);
                    }
                break;
                case 'MARG':
                    if($('#Costo').val() != 0){
                        margMul = $('#Costo').val() / (1 - (margMul/100));
                        $('#NivelPrecio4_' + i + '_PRECIO').val(margMul.toFixed(0));
                    }
                break;
            }
            
        }
    });
}
</script>
<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'articulo-precio-form',
	'type'=>'horizontal',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <table>
        <tr>
            <td><?php echo $form->textFieldRow($model,'ARTICULO',array('size'=>20,'maxlength'=>20, 'value'=>$articulo->ARTICULO, 'readonly'=>true)); ?></td>
            <td><label class="control-label">Descripción:</label> <div class="controls"><?php echo CHtml::textField('Descripcion','', array('readonly'=>true)); ?></div></td>
        </tr>
        <tr>
            <td><label class="control-label">Costo:</label>  <div class="controls"><?php echo CHtml::textField('Costo', '', array('readonly'=>true)); ?></div></td>
            <td><label class="control-label">Precio Base:</label> <div class="controls"><?php echo CHtml::textField('Precio_base', $articulo->PRECIO_BASE, array('class'=>'calculosGen')); ?></div></td>
        </tr>
        <tr>
            <td colspan="2"><?php $this->renderPartial('lineas', array('precios'=>$precios, 'model'=>$model, 'articulo'=>$articulo, 'cargar'=>$cargar)); ?></td>
        </tr>
    </table>
		<?php echo $form->hiddenField($model,'ACTIVO',array('value'=>'S')); ?>

	<div align="center" id="botones">
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small', 'url' => array('articuloPrecio/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->