<script>
    $(document).ready(function(){
        $(".espacio").keypress(function(event){
            if ( event.which == 32 ) {
                return false;
            }
        });
    })
</script>

<div class="form">
    <div class="modal-body">
        <?php
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id' => 'estado-empleado-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                ));
        ?>

        <?php echo $form->errorSummary($model2); ?>   
        <?php echo $form->textFieldRow($model2, 'ESTADO_EMPLEADO', array('size' => 4, 'maxlength' => 4, 'class' => 'espacio', 'disabled' => $model2->isNewRecord ? false : true)); ?>            
        <?php echo $form->textAreaRow($model2, 'DESCRIPCION', array('rows' => 2, 'cols' => 32, 'maxlength' => 64)); ?>
        <?php echo $form->dropDownListRow($model2, 'PAGO', array('S' => 'SI', 'N' => 'No'), array('empty' => 'Seleccione')); ?>        
        <?php echo $form->dropDownListRow($model2, 'TEMPORAL', array('S' => 'SI', 'N' => 'No'), array('empty' => 'Seleccione')); ?> 
        <?php echo CHtml::activeHiddenField($model2, 'ACTIVO', array('value' => 'S')); ?>   
    </div>
    
    
        <?php if ($model2->isNewRecord): ?>
        <div class="modal-footer" align="center">
            <?php endif ?>
            <?php if (!$model2->isNewRecord): ?>
            <div class="row-buttons" align="center">
                <?php endif ?>
                <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok-circle white', 'size' => 'small', 'label' => $model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
                <?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Cancelar', 'size' => 'small', 'url' => array('/estadoEmpleado/admin'), 'icon' => 'remove', 'htmlOptions' => array('data-dismiss' => 'modal'))); ?>	        
            </div>
        
        
    <?php $this->endWidget(); ?>

</div><!-- form -->