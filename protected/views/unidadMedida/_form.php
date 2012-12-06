<script>
    $(document).ready(inicio);
    
    function inicio(){
        
        $('#UnidadMedida_TIPO').change(function(){
            
            $.getJSON('<?php echo $this->createUrl('cargarbase')?>&tipo='+$(this).val(),
                function(data){
                    
                     $('select[id$=UnidadMedida_UNIDAD_BASE ] > option').remove();
                      $('#UnidadMedida_UNIDAD_BASE').append("<option value=''>Seleccione</option>");
                    
                    $.each(data, function(value, name) {
                              $('#UnidadMedida_UNIDAD_BASE').append("<option value='"+value+"'>"+name+"</option>");
                        });
                });
        });
    }

</script>
<div class="form ">
    <div class="modal-body">
        <?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'unidad-medida-form',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                                'validateOnSubmit'=>true,
                ),
                'type'=>'horizontal',
        )); ?>

                        <?php echo $form->errorSummary($model2); ?>

                <div class="row">
                        <?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>

                        <?php echo $form->textFieldRow($model2,'ABREVIATURA',array('size'=>5,'maxlength'=>5)); ?>

                        <?php echo $form->dropDownListRow($model2,'TIPO',array(''=>'Seleccione','U'=>'Unidad','L'=>'Longitud','V'=>'Volumen','P'=>'Peso')); ?>

                        <?php echo $form->dropDownListRow($model2,'UNIDAD_BASE',array(),array('empty'=>'Seleccione')); ?>

                        <?php echo $form->textFieldRow($model2,'EQUIVALENCIA'); ?>

                        <div class="row">
                                <?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
                                <?php echo $form->error($model2,'ACTIVO'); ?>
                        </div>
                </div>
        
    </div>
    
    <?php if($model2->isNewRecord): ?>
    <div class="modal-footer" align="center">
    <?php endif ?>
        
    <?php if(!$model2->isNewRecord): ?>
    <div class="row-buttons" align="center">
    <?php endif ?>
              <?php
                  $this->widget('bootstrap.widgets.BootButton', array(
                                  'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar',
                                   'buttonType'=>'submit',
                                   'type'=>'primary',
                                   'icon'=>'ok-circle white', 
                      )
                  );
              ?>
        
              <?php $this->widget('bootstrap.widgets.BootButton', array(
			'label'=>'Cancelar',
			'url'=>$model2->isNewRecord ? '#' : array('admin'),
			'icon'=>'remove',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
		)); ?>
   </div>
        
    <?php $this->endWidget(); ?>

</div><!-- form -->