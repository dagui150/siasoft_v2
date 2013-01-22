<div class="form">
    <div class="modal-body ">
        <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id'=>'tipo-transaccion-form',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
            ),
            'type'=>'horizontal',
    )); ?>
        <br>
            <?php
            // Esta es la linea que causaba conflicto
            $sentencia__='TRANSACCION_FIJA = "S"';
                
                $cs=Yii::app()->clientScript;
                $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
                $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
                $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
                echo $form->errorSummary($model2);
                if(!$model2->isNewRecord)
                    echo $form->hiddenField($model2,'TRANSACCION_BASE'); 
                $this->widget('bootstrap.widgets.TbTabs', array(
                            'type'=>'tabs',
                            'tabs'=>array(
                                array(
                                    'label'=>'Tipo de Transacción',
                                    'content'=>
                                        '<table style="width: 400px;">
                                            <tr>
                                                <td>
                                                '.$form->textFieldRow($model2,"TIPO_TRANSACCION",array("size"=>4,"maxlength"=>4,"disabled"=>$model2->isNewRecord ? false : true)).'
                                                </td>
                                                <td>'./*$this->botonAyuda("CODIGO")*/''.'</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                '.$form->textFieldRow($model2,"NOMBRE",array("size"=>16,"maxlength"=>16,"disabled"=>$model2->TRANSACCION_FIJA == "S" ? true : false)).'
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                '.$form->dropDownListRow($model2,"TRANSACCION_BASE",CHtml::listData(TipoTransaccion::model()->findAll('TRANSACCION_FIJA = "S"'), "TIPO_TRANSACCION", "NOMBRE"),array("empty"=>"Seleccione","disabled"=>$model2->isNewRecord ? false : true)).'
                                                </td>
                                                <td></td>
                                            </tr>
                                                '.$form->hiddenField($model2,"TRANSACCION_FIJA",array("value"=>"N")).'
                                            <tr>
                                                <td>
                                                '.$form->dropDownListRow($model2,"NATURALEZA",array("S"=>"Salida","E"=>"Entrada","A"=>"Ambas","N"=>"Ninguna"),array("empty"=>"Seleccione","disabled"=>($model2->TRANSACCION_FIJA == "S" && $model2->NATURALEZA != "") ? true : false)).'
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>'
                                    ,     
                                    'active'=>true
                                ),
                                array(
                                    'label'=>'Subtipos de Transacción',
                                    'content'=>$this->renderPartial('/subtipoTransaccion/_form', array('form'=>$form,'subTipo'=>$subTipo,'model2'=>$model2),true)
                               ),
                                array(
                                    'label'=>'Cantidad Afectada',
                                    'content'=>$this->renderPartial('cantidad', array('form'=>$form,'cantidad'=>$model2->isNewRecord ? '' : $cantidad,'model2'=>$model2),true)
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
        <?php $this->darBotonEnviar($model2->isNewRecord ? 'Crear' : 'Guardar'); ?>
              <?php
                    if($model2->isNewRecord){
                         $this->darBotonCancelar(array('data-dismiss'=>'modal'), '');
                    }
                    else{
                         $this->darBotonCancelar(false, array('admin'));
                    }
             ?>
      </div>

<?php $this->endWidget(); ?>

</div><!-- form -->