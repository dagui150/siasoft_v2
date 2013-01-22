<script>
    $(document).ready(inicio);
    
    function inicio(){
        var mascara,i;
        $("#consecutivo-fa-form").validate();
        $('#ConsecutivoFa_TIPO_1').attr('checked',true);
        
        $('#ConsecutivoFa_NUMERO_COPIAS').blur(function(){
            
            for(i=0;i<=5;i++)
                $('#ConsecutivoFa_COPIA'+i).attr('disabled',true);
            
            for(i=0;i<=$(this).val();i++){
                $('#ConsecutivoFa_COPIA'+i).attr('disabled',false);
            }
        });
        
        $('#ConsecutivoFa_MASCARA').blur(function(){
            mascara = $(this).val();
            $('#ConsecutivoFa_VALOR_CONSECUTIVO').unmask();
            $('#ConsecutivoFa_VALOR_CONSECUTIVO').mask(mascara);
             $('#ConsecutivoFa_VALOR_MAXIMO').unmask();
            $('#ConsecutivoFa_VALOR_MAXIMO').mask(mascara);
        });
        
        $('#ConsecutivoFa_LONGITUD').blur(function(){
            $('#ConsecutivoFa_MASCARA').attr('maxlength',$(this).val());
        });
        $('#ConsecutivoFa_TIPO_0').click(function(){
            $('#ConsecutivoFa_MASCARA').addClass('number');
        });
        $('#ConsecutivoFa_TIPO_1').click(function(){
            $('#ConsecutivoFa_MASCARA').removeClass('number')
        });
    }
</script>

<div class="form">

<?php
    $cs=Yii::app()->clientScript;
    $cs->registerScriptFile(XHtml::jsUrl('jquery.maskedinput.js'), CClientScript::POS_HEAD);
    $cs->registerScriptFile(XHtml::jsUrl('jquery.validate.js'), CClientScript::POS_HEAD);
    
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'consecutivo-fa-form',
            'enableAjaxValidation'=>true,
                   'clientOptions'=>array(
                          'validateOnSubmit'=>true,
            ),
           'type'=>'horizontal',
    ));
?>

       <?php echo $form->errorSummary($model); ?>

        <table>
                <tr>
                    <td >
                        <div align="left" style="width: 120px;">
                            <?php echo $form->textFieldRow($model,'CODIGO_CONSECUTIVO',array('size'=>6,'maxlength'=>10,'disabled'=>$model->isNewRecord ? false : true));?>
                        </div>
                    </td>
                    <td>
                        <div align="left" style="width: 228px;">
                            <?php echo $form->textFieldRow($model,'DESCRIPCION',array('maxlength'=>48)); ?>
                        </div>
                    </td>
                </tr>

       </table>  

        <?php
                $this->widget('bootstrap.widgets.TbTabs', array(
                            'type'=>'tabs',
                            'tabs'=>array(
                                array(
                                    'label'=>'Consecutivo',
                                    'content'=>'
                                            <table>
                                                <tr>
                                                    <td>'
                                                        .$form->textFieldRow($model,'LONGITUD',array('maxlength'=>2,'size'=>4))
                                                        .$form->radioButtonListRow($model,'TIPO',array('N'=>'Numérico','A'=>'Alfanumérico'))
                                                        .$form->textFieldRow($model,'MASCARA')
                                                        .$form->textFieldRow($model,'VALOR_CONSECUTIVO',array('disabled'=>$model->isNewRecord ? false : true))
                                                        .$form->textFieldRow($model,'VALOR_MAXIMO',array('disabled'=>$model->isNewRecord ? false : true))
                                                        .$form->dropDownListRow($model,'CLASIFICACION',array('P'=>'Pedido','R'=>'Remisión','F'=>'Factura'),array('empty'=>'Seleccione'))
                                                        .$form->dropDownListRow($model,'FORMATO_IMPRESION',CHtml::listData(FormatoImpresion::model()->findAllByAttributes(array('MODULO'=>'FACT')), 'ID', 'NOMBRE'),array('empty'=>'Seleccione'))
                                                    .'</td>
                                                    <td>'
                                                        /*<fieldset style="width: 315px; height: 140px; ">
                                                            <legend ><font face="arial" size=3 >Propiedades</font></legend>'
                                                            .$form->checkBoxRow($model,'USA_ESQUEMA_CAJAS')
                                                            .$form->checkBoxRow($model,'USA_DESPACHOS')
                                                        .'<br><br></fieldset>'*/
                                                        .$form->textFieldRow($model,'RESOLUCION',array('maxlength'=>64))
                                                    .'</td>
                                                </tr>
                                            </table>
                                        '
                                    ,   
                                    'active'=>true
                                ),
                                array(
                                    'label'=>'Impresión',
                                    'content'=>
                                        $form->textFieldRow($model,'NUMERO_COPIAS',array('maxlength'=>1,'size'=>4))
                                        .$form->textFieldRow($model,'ORIGINAL')
                                        .$form->textFieldRow($model,'COPIA1',array('disabled'=>!$model->isNewRecord && $model->NUMERO_COPIAS >= 1 ? false : true))
                                        .$form->textFieldRow($model,'COPIA2',array('disabled'=>!$model->isNewRecord && $model->NUMERO_COPIAS >= 2 ? false : true))
                                        .$form->textFieldRow($model,'COPIA3',array('disabled'=>!$model->isNewRecord && $model->NUMERO_COPIAS >= 3 ? false : true))
                                        .$form->textFieldRow($model,'COPIA4',array('disabled'=>!$model->isNewRecord && $model->NUMERO_COPIAS >= 4 ? false : true))
                                        .$form->textFieldRow($model,'COPIA5',array('disabled'=>!$model->isNewRecord && $model->NUMERO_COPIAS >= 5 ? false : true))
                                    ,
                               ),
                            ),
                ));
            ?>
	</div>    
	<?php echo $form->hiddenField($model,'ACTIVO',array('value'=>'S')); ?>

	<div class="row buttons" align="center">
            <?php $this->darBotonEnviar($model->isNewRecord ? 'Crear' : 'Guardar'); ?>
            <?php $this->darBotonCancelar(); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
