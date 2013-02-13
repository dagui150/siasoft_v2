<script>
$(document).ready(function () {
   $("#Nit_TIIPO_DOCUMENTO").change(function(){
                var op = $("#Nit_TIIPO_DOCUMENTO option:selected").val();
                $.getJSON(
                    '<?php echo $this->createUrl('nit/Mascara'); ?>&id='+op,
                    function(data)
                    {
                        $("#Nit_ID").mask(data.MASCARA);
                    }
                )
        });
});

$(document).ready(function () {
   $("#Nit_ID").focus(function(){
                var op = $("#Nit_TIIPO_DOCUMENTO option:selected").val();
                $.getJSON(
                    '<?php echo $this->createUrl('nit/Mascara'); ?>&id='+op,
                    function(data)
                    {
                        $("#Nit_ID").mask(data.MASCARA);
                    }
                )
        });
});
</script>
<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.maskedinput.js'), CClientScript::POS_HEAD);
?>
<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'nit-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <?php echo $form->errorSummary($model2); ?>
    
		<?php echo $form->dropDownListRow($model2,'TIIPO_DOCUMENTO', CHtml::listData(TipoDocumento::model()->findAll(),'ID','DESCRIPCION'), array('empty'=>'Seleccione...')); ?>        
		<?php echo $form->textFieldRow($model2,'ID',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->textFieldRow($model2,'RAZON_SOCIAL',array('maxlength'=>128)); ?>
		<?php echo $form->textFieldRow($model2,'ALIAS',array('maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model2,'OBSERVACIONES'); ?>
	<div class="row">
		<?php
			echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S'));
			echo $form->error($model2,'ACTIVO'); 
		?>
	</div>

	
        <?php if(!$model2->isNewRecord): ?>
        <div class="row-buttons" align="center">
        <?php endif ?>
            <?php $this->darBotonEnviar($model2->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(array('data-dismiss'=>'modal'), array('/nit/admin')); ?>
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->