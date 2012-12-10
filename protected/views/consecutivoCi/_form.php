<?php
            $cs=Yii::app()->clientScript;
            $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
            $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
            $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
            $cs->registerScriptFile(XHtml::jsUrl('jquery.maskedinput.js'), CClientScript::POS_HEAD);
?>

<script>
    $(document).ready(inicio);
    
    function inicio(){
        
        $('#ConsecutivoCi_MASCARA').mask('aaa-9999?99999999999');
        $('#ConsecutivoCi_MASCARA').blur(function(){
            var mascara = $(this).val();
            var cantidad = mascara.split('-');
            var valor_final='';
            
            for(var i=1; i < cantidad[1].length ; i++){
                valor_final= valor_final+0
            }
            valor_final = valor_final+1
            $('#ConsecutivoCi_SIGUIENTE_VALOR').val(cantidad[0]+'-'+valor_final);
        });
    }

</script>
<div class="form">
    <div class="modal-body">
        <?php
            $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'consecutivo-ci-form',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
                'type'=>'horizontal',
            )); 
        ?>
        <?php echo $form->errorSummary($model2); ?>
        <table>
                <tr>
                    <td >
                        <div align="left" style="width: 120px;">
                            <?php echo $form->textFieldRow($model2,'ID',array('size'=>6,'maxlength'=>10,'disabled'=>$model2->isNewRecord ? false : true));?>
                        </div>
                    </td>
                    <td>
                        <div align="left" style="width: 228px;">
                            <?php echo $form->textFieldRow($model2,'DESCRIPCION',array('maxlength'=>48)); ?>
                        </div>
                    </td>
                </tr>

            </table>   
            <?php
                $this->widget('bootstrap.widgets.BootTabbable', array(
                            'type'=>'tabs',
                            'tabs'=>array(
                                array(
                                    'label'=>'General',
                                    'content'=>
                                        '<span class="hint" style="margin-left: 160px;">aaa - 9999?9999999999</span>'
                                        .$form->textFieldRow($model2,'MASCARA',array('size'=>20,'maxlength'=>20,'disabled'=>$model2->isNewRecord ? false : true))
                                        .$form->textFieldRow($model2,'SIGUIENTE_VALOR',array('size'=>20,'maxlength'=>20,'readonly'=>true))
                                        .$form->dropDownListRow($model2,'FORMATO_IMPRESION',CHtml::listData(FormatoImpresion::model()->findAllByAttributes(array('MODULO'=>'COIN','SUBMODULO'=>'CONS')), 'ID', 'NOMBRE'),array('empty'=>'Seleccione'))
                                    ,   
                                    'active'=>true
                                ),
                                array(
                                    'label'=>'Transacciónes Configurables',
                                    'content'=>$this->renderPartial('tipos',array('form'=>$form,'model2'=>$model2,'tipos'=>$model2->isNewRecord ? '' :$tipos),true)
                               ),
                                array(
                                    'label'=>'Usuarios',
                                    'content'=>$this->renderPartial('usuarios',array('form'=>$form,'model2'=>$model2,'usuarios'=>$model2->isNewRecord ? '' :$usuarios),true)
                               ),
                            ),
                ));
            ?>

            <?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
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
              <?php
                    if($model2->isNewRecord){
                         $this->widget('bootstrap.widgets.BootButton', array(
                                   'label'=>'Cancelar',
                                   'buttonType'=>'reset',
                                   'type'=>'action',
                                   'icon'=>'remove ', 
                                   'htmlOptions'=>array('data-dismiss'=>'modal'),
                                )
                        );
                    }
                    else{
                         $this->widget('bootstrap.widgets.BootButton', array(
                                   'label'=>'Cancelar',
                                   'type'=>'action',
                                   'icon'=>'remove ', 
                                   'url'=>array('admin'),
                                )
                        );
                    }
             ?>
      </div>

<?php $this->endWidget(); ?>

</div><!-- form -->