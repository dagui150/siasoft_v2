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
<<<<<<< HEAD
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'nit-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    
    <?php echo $form->errorSummary($model2); ?>
                <table style="width: 400px;">
                    <tr>
                        <td>
                            <?php echo $form->dropDownListRow($model2,'TIIPO_DOCUMENTO', CHtml::listData(TipoDocumento::model()->findAll('ACTIVO = "S"'),'ID','DESCRIPCION'), array('empty'=>'Seleccione...')); ?>        
                        </td>
                        <td>
                            <?php $this->widget('bootstrap.widgets.BootButton', array(
                                //'label'=>'Ayuda',
                                'type'=>'succes',
                                'icon'=>'info-sign',
                                'size'=>'mini',
                                'htmlOptions'=>array('data-title'=>'Ayuda', 'data-content'=>'En esta opción se selecciona un tipo de documento previamente creado en el submenú "Tipo de documento".', 'rel'=>'popover'),
                            )); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'ID',array('size'=>12,'maxlength'=>12)); ?>
                        </td>
                        <td>
                            <?php $this->widget('bootstrap.widgets.BootButton', array(
                                //'label'=>'Ayuda',
                                'type'=>'succes',
                                'icon'=>'info-sign',
                                'size'=>'mini',
                                'htmlOptions'=>array('data-title'=>'Ayuda', 'data-content'=>'En este campo, se debe escribir el número del documento según la máscara definida para el tipo de documento seleccionado.', 'rel'=>'popover'),
                            )); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'RAZON_SOCIAL',array('maxlength'=>128)); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model2,'ALIAS',array('maxlength'=>128)); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textAreaRow($model2,'OBSERVACIONES'); ?>
                        </td>
                        <td>
                        </td>
                    </tr>
                </table>
=======
>>>>>>> ff8edc1f2287478707a6deb5631d76ace17ca520

    <?php
        $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
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
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok-circle white', 'size' => 'small', 'label' => $model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Cancelar', 'size' => 'small', 'url' => array('/nit/admin'), 'icon' => 'remove', 'htmlOptions' => array('data-dismiss' => 'modal'))); ?>
    </div>



    <?php $this->endWidget(); ?>

</div><!-- form -->