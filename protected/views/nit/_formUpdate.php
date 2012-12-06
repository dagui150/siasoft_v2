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
</script>
<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.maskedinput.js'), CClientScript::POS_HEAD);
?>
<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
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
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('/nit/admin'), 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal')));  ?>	        
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->