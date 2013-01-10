<?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>$id,
            'template'=>"{items}",
            'dataProvider'=>$proveedor->search(),
            'selectionChanged'=>$funcion,
            'filter'=>$proveedor,
            'columns'=>array(
                array(  'name'=>'PROVEEDOR',
                        'header'=>'Código Proveedor',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->PROVEEDOR,"#")'
                    ),
                    'NOMBRE',
                    'CATEGORIA',
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'template'=>'',
                    ),
            ),
    ));
             ?>