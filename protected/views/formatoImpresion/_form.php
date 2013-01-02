<?php
/* @var $this FormatoImpresionController */
/* @var $model FormatoImpresion */
/* @var $form CActiveForm */
?>

<script>
    $(document).ready(function(){
        inicio();
    });
    //$(document).ready(inicio);
    
    function inicio(){
        
        $('#FormatoImpresion_MODULO').change(function(){
            
            $.getJSON('<?php echo $this->createUrl('Submodulo')?>&modulo='+$(this).val(),
                function(data){
                    
                     $('select[id$=FormatoImpresion_SUBMODULO] > option').remove();
                      $('#FormatoImpresion_SUBMODULO').append("<option value=''>Seleccione</option>");
                      
                      $('select[id$=FormatoImpresion_RUTA] > option').remove();
                      $('#FormatoImpresion_RUTA').append("<option value=''>Seleccione</option>");
                    
                    $.each(data, function(value, name) {
                              $('#FormatoImpresion_SUBMODULO').append("<option value='"+value+"'>"+name+"</option>");
                        });
                });
        });
        
        $('#FormatoImpresion_SUBMODULO').change(function(){
            
            $.getJSON('<?php echo $this->createUrl('Formato')?>&submodulo='+$(this).val(),
                function(data){
                    
                     $('select[id$=FormatoImpresion_RUTA] > option').remove();
                      $('#FormatoImpresion_RUTA').append("<option value=''>Seleccione</option>");
                    
                    $.each(data, function(value, name) {
                              $('#FormatoImpresion_RUTA').append("<option value='"+value+"'>"+name+"</option>");
                        });
                });
        });
    }

</script>

<div class="form">

<div class="modal-body">

    <?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id'=>'formato-impresion-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>

	<?php echo $form->errorSummary($model2); ?>

		<?php echo $form->textFieldRow($model2,'NOMBRE'); ?>
		<?php echo $form->textFieldRow($model2,'OBSERVACION'); ?>
		<?php echo $form->dropDownListRow($model2,'MODULO', CHtml::listData(Modulo::model()->findAll('ACTIVO="S"'),'ID','NOMBRE'), array('empty' => 'Seleccione')); ?>        
		<?php echo $form->dropDownListRow($model2,'SUBMODULO',array(), array('empty' => 'Seleccione')); ?>
		<?php echo $form->dropDownListRow($model2,'RUTA',array(), array('empty' => 'Seleccione')); ?>
		<?php echo $form->textFieldRow($model2,'TIPO'); ?>

<?php echo CHtml::activeHiddenField($model2, 'ACTIVO', array('value' => 'S')); ?>

 </div>
 
 <?php if ($model2->isNewRecord): ?>
           <div class="modal-footer" align="center">
            <?php endif ?>
            <?php if (!$model2->isNewRecord): ?>
 

	<div class="row-buttons" align="center">
	<?php endif ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok-circle white', 'size' => 'small', 'label' => $model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Cancelar', 'size' => 'small', 'url' => array('/formatoImpresion/admin'), 'icon' => 'remove', 'htmlOptions' => array('data-dismiss' => 'modal'))); ?>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->