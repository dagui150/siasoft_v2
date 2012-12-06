<div class="form">
    <div class="modal-body">
        <?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id'=>'tipo-transaccion-form',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                    'validateOnSubmit'=>true,
            ),
            'type'=>'horizontal',
    )); ?>
        <br>
            <?php
                $cs=Yii::app()->clientScript;
                $cs->registerScriptFile(XHtml::jsUrl('jquery.calculation.min.js'), CClientScript::POS_HEAD);
                $cs->registerScriptFile(XHtml::jsUrl('jquery.format.js'), CClientScript::POS_HEAD);
                $cs->registerScriptFile(XHtml::jsUrl('template.js'), CClientScript::POS_HEAD);
                echo $form->errorSummary($model2);
                if(!$model2->isNewRecord)
                    echo $form->hiddenField($model2,'TRANSACCION_BASE'); 
                $this->widget('bootstrap.widgets.BootTabbable', array(
                            'type'=>'tabs',
                            'tabs'=>array(
                                array(
                                    'label'=>'Tipo de Transacción',
                                    'content'=>
                                        $form->textFieldRow($model2,'TIPO_TRANSACCION',array('size'=>4,'maxlength'=>4,'disabled'=>$model2->isNewRecord ? false : true))
                                        .$form->textFieldRow($model2,'NOMBRE',array('size'=>16,'maxlength'=>16,'disabled'=>$model2->TRANSACCION_FIJA == 'S' ? true : false))
                                        .$form->dropDownListRow($model2,'TRANSACCION_BASE',CHtml::listData(TipoTransaccion::model()->findAll('TRANSACCION_FIJA = "S"'), 'TIPO_TRANSACCION', 'NOMBRE'),array('empty'=>'Seleccione','disabled'=>$model2->isNewRecord ? false : true))
                                        .$form->hiddenField($model2,'TRANSACCION_FIJA',array('value'=>'N'))
                                        .$form->dropDownListRow($model2,'NATURALEZA',array('S'=>'Salida','E'=>'Entrada','A'=>'Ambas','N'=>'Ninguna'),array('empty'=>'Seleccione','disabled'=>($model2->TRANSACCION_FIJA == 'S' && $model2->NATURALEZA != '') ? true : false))
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