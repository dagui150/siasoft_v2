<script> 
    var x=$(document).ready(inicializar);
    function inicializar(){
        sinEspacios();
        hora();
        validarHora();
    }
    function sinEspacios(){
        $(".espacio").keypress(function(event){
            if ( event.which == 32 ) {
                return false;
            }
        });
    }
    function hora(){
        $.mask.definitions['h']='[012]';
        $.mask.definitions['m']='[0-5]';
    }
    function prueba(){
        
        valor=$(this).val();
        if(valor.indexOf("_") == -1)
        {
            var hora = valor.split(":")[0];
            if(parseInt(hora) > 23 )
            {
                $(this).val("");
            }
        }
    }
    function validarHora(){
        
        $('.add').click(function(){
            var cont = $('body').find('.rowIndex').max();
            
            $('#ConceptoNuevo_'+cont+'_INICIO').blur(prueba);
            $('#ConceptoNuevo_'+cont+'_FIN').blur(prueba);
            
            $('#ConceptoNuevo_'+cont+'_INICIO').mask('h9:m9');
            $('#ConceptoNuevo_'+cont+'_FIN').mask('h9:m9');
            
        });
        
        
        var cont1 = $('body').find('.horarioIndex').max();
        
        
        for (var i=0; i<=cont1; i++)
        {
            $('#HorarioConcepto_'+i+'_HORA_INICIO').mask('h9:m9?:m9');
            $('#HorarioConcepto_'+i+'_HORA_INICIO').blur(prueba);
            
            
            $('#HorarioConcepto_'+i+'_HORA_FIN').mask('h9:m9?:m9');
            $('#HorarioConcepto_'+i+'_HORA_FIN').blur(prueba);
        }
    }
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
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
        'id' => 'horario-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>

    <?php
    echo $form->errorSummary($model);
    ?>
    
    <table >
        <tr>
            <td><?php echo $form->textFieldRow($model, 'HORARIO', array('class' => 'espacio', 'disabled' => $model->isNewRecord ? false : true)) ?>
            </td>
            <td><?php echo $form->textFieldRow($model, 'DESCRIPCION') ?>
            </td>
        </tr>
    </table>

    <?php
    $this->widget('bootstrap.widgets.BootTabbable', array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'tabs' => array(
            array('label' => 'General', 'content' =>
                '<table >
                    <tr>
                        <td>'
                            . '<fieldset  style="height:200px;alignment-adjust: center" ><legend>Tolerancia</legend>'
                            . $form->textFieldRow($model, 'TOLERA_ENTRADA')
                            . $form->textFieldRow($model, 'TOLERA_SALIDA')
                            . '</fieldset>' .
                        '</td>
                        <td>'
                            . '<fieldset  style="height:200px;alignment-adjust: center" ><legend>Redondeo</legend>'
                            . $form->textFieldRow($model, 'REDONDEO_ENTRADA')
                            . $form->textFieldRow($model, 'REDONDEO_SALIDA')
                            . '</fieldset>' . ' 
                        </td>
                    </tr>
                </table>'
                . CHtml::activeHiddenField($model, 'ACTIVO', array('value' => 'S'))
                , 'active' => true
            ),
            array('label' => 'Configuración', 'content' =>
                $this->renderPartial('/horario/concepto', array('model' => $model, 'tablaConceptos' => $model->isNewRecord ? '' : $tablaConceptos), true)
            ),
            )));
    ?>

    <div class="row-buttons" align="center">
        <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType' => 'submit', 'type' => 'primary', 'icon' => 'ok-circle white', 'size' => 'small', 'label' => $model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label' => 'Cancelar', 'size' => 'small', 'url' => array('/horario/admin'), 'icon' => 'remove', 'htmlOptions' => array('data-dismiss' => 'modal'))); ?>
    </div>
    <?php $this->endWidget(); ?>

</div><!-- form -->