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
    <div>
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id'=>'regimen-tributario-form',
                'type'=>'horizontal',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),	
        )); ?>

                <?php echo $form->errorSummary($model2); ?>

                        <?php echo $form->textFieldRow($model2,'REGIMEN',array('size'=>12,'maxlength'=>12, 'class'=>'espacio')); ?>
                        <?php echo $form->textAreaRow($model2,'DESCRIPCION',array()); ?>
                        <?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
    </div>
        <?php if($model2->isNewRecord): ?>
        <div class="modal-footer" align="center">
        <?php endif ?>

        <?php if(!$model2->isNewRecord): ?>
        <div class="row-buttons" align="center">
        <?php endif ?>
            <?php $this->darBotonEnviar($model2->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(array('data-dismiss'=>'modal')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->