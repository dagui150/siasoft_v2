<script>
    $(document).ready(function () {
   
    
        $(".tipos").live('change',function(){
            var value = $(this).val();
            var cont = $(this).attr('id').split('_')[1]
            $.getJSON(
            '<?php echo $this->createUrl('nit/Mascara'); ?>&id='+value,
            function(data)
            {
                $("#LineaNueva_"+cont+"_ID").unmask();
                $("#LineaNueva_"+cont+"_ID").mask(data.MASCARA);
            }
        )
        });
        
        $("#Nit_0_TIIPO_DOCUMENTO").live('change',function(){
            var value = $(this).val();
            var cont = $(this).attr('id').split('_')[1]
            $.getJSON(
            '<?php echo $this->createUrl('nit/Mascara'); ?>&id='+value,
            function(data)
            {
                $("#Nit_"+cont+"_ID").unmask();
                $("#Nit_"+cont+"_ID").mask(data.MASCARA);
            }
        )
        });
        
        
        
    });
</script>
<?php
    $cs = Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.maskedinput.js'), CClientScript::POS_HEAD);

    Yii::import('ext.chosen.Chosen');
?>
<div class="form">

    <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'nit-form',
            'type' => 'horizontal',
            'enableAjaxValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                ));
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php $this->renderPartial('lineas', array('model' => $model, 'tablaNits' => $model->isNewRecord ? '' : $tablaNits)) ?>


    <div class="row-buttons" align="center">
        <?php $this->darBotonEnviar($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
        <?php $this->darBotonCancelar(array('data-dismiss' => 'modal'), array('/nit/admin')); ?>
    </div>



    <?php $this->endWidget(); ?>

</div><!-- form -->