

<h1>lines</h1>

<?php 
    $elementsPreCopy = array(
                'ARTICULO'=>array(
                    'type'=>'textField',
                    'htmlOptions'=>array()
                ),
                'Articulo_desc'=>array(
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
                'Articulo_desc'=>array(
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
            'editInline'=>true,
            'elementsPreCopy'=>$elementsPreCopy,
            'elementsCopy'=>$elementsCopy,
            'htmlAddOptions'=>array('label'=>'Nuevo','id'=>'add','style'=>'margin-top: 5px;')
    ));

?>