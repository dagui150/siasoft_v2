<script>
    $(document).ready(function(){
        $(".espacio").keypress(function(event){
            if ( event.which == 32 ) {
                return false;
            }
        });
    }
    
    
    
    )
    
    
</script>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id' => 'cargo-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>

    <br><br>
    <?php echo $form->errorSummary($model); ?>
    <table>
        <tr>
            <td WIDTH="40%">
                <fieldset  style="height:450px;alignment-adjust: center" ><legend>General</legend>
                    <?php echo $form->textFieldRow($model, 'CARGO', array('maxlength' => 8, "class" => "espacio", 'disabled' => $model->isNewRecord ? false : true)); ?>
                    <?php echo $form->textFieldRow($model, 'DESCRIPCION', array('maxlength' => 64)); ?>
                    <?php echo $form->textAreaRow($model, 'FUNCIONES', array('rows' => 4, 'cols' => 30)); ?>
                    <?php echo $form->textAreaRow($model, 'NOTAS', array('rows' => 4, 'cols' => 30)); ?>
                </fieldset>
            </td>
            <td WIDTH="60%" >
                <fieldset style="height:450px"><legend>Salarios</legend>
                    <?php echo $form->textFieldRow($model, 'SALARIO_MINIMO', array('maxlength' => 28, 'prepend' => '$')); ?>
                    <?php echo $form->textFieldRow($model, 'SALARIO_INTERMEDIO1', array('maxlength' => 28, 'prepend' => '$')); ?>
                    <?php echo $form->textFieldRow($model, 'SALARIO_INTERMEDIO2', array('maxlength' => 28, 'prepend' => '$')); ?>
                    <?php echo $form->textFieldRow($model, 'SALARIO_MAXIMO', array('maxlength' => 28, 'prepend' => '$')); ?>
                    <?php echo $form->textFieldRow($model, 'SALARIO_ACTUAL', array('maxlength' => 28, 'prepend' => '$')); ?>
                </fieldset>
            </td>
        </tr>
    </table>
    
    <?php echo CHtml::activeHiddenField($model, 'ACTIVO', array('value' => 'S')); ?>

    <div class="row-buttons" align="center">
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok-circle white', 'size' => 'small', 'label' => $model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Cancelar', 'size' => 'small', 'url' => array('/cargo/admin'), 'icon' => 'remove', 'htmlOptions' => array('data-dismiss' => 'modal'))); ?>
    </div>
    
    <?php $this->endWidget(); ?>
    
</div><!-- form -->