<h1>lines</h1>

<?php 
$form=$this->beginWidget('CActiveForm', array(
                'id'=>'lineas-form',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                      'validateOnSubmit'=>true,
                 ),	
        ));   
?>
<div class="form">  
    <?php
        $elementsPreCopy = array(
                    'ARTICULO'=>array(
                        'type'=>'textField',
                        'htmlOptions'=>array()
                    ),
                    'DESCRIPCION'=>array(
                        'isModel'=>false,
                        'type'=>'textField',
                        'htmlOptions'=>array('disabled'=>true)
                    ),
                    'CANTIDAD'=>array(
                        'type'=>'textField',
                        'htmlOptions'=>array('size'=>6)
                    ),
                    'UNIDAD'=>array(
                        'type'=>'dropDownList',
                        'items'=>array('1'=>'uno','2'=>'dos'),
                    ),
                );
        $elementsCopy = array(
                    'ARTICULO'=>array(
                        'type'=>'textField',
                        'htmlOptions'=>array()
                    ),
                    'DESCRIPCION'=>array(
                        'isModel'=>false,
                        'label'=>'Descripción',
                        'type'=>'textField',
                        'htmlOptions'=>array('disabled'=>true)
                    ),
                    'CANTIDAD'=>array(
                        'type'=>'textField',
                        'htmlOptions'=>array('size'=>6)
                    ),
                    'UNIDAD'=>array(
                        'type'=>'dropDownList',
                        'items'=>array('1'=>'uno','2'=>'dos'),
                    ),
        );
        $this->widget('ext.JLinesForm.JLinesForm',array(
                'model'=>$linea,
                'form'=>$form,
                'editInline'=>false,
                'elementsPreCopy'=>$elementsPreCopy,
                'elementsPost'=>$elementsPost,
                'elementsCopy'=>$elementsCopy,
                'htmlAddOptions'=>array('label'=>'Nuevo','id'=>'add','style'=>'margin-top: 5px;')
        ));
        
        $this->widget('bootstrap.widgets.TbButton', array(
                   'buttonType'=>'submit',
                   'type'=>'primary',
                   'label'=>'Aceptar',
                   'icon'=>'ok white',
       ));
    $this->endWidget(); 
?>  
</div><!-- form -->