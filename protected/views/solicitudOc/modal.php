<?php 
    $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>$id,
            'template'=>"{items} {pager}",
            'dataProvider'=>$articulo->search(),
            'selectionChanged'=>$funcion,
            'filter'=>$articulo,
            'columns'=>array(
                array(  'name'=>'ARTICULO',
                        'header'=>'Código Artículo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ARTICULO,"#")'
                    ),
                    'NOMBRE',
                    'TIPO_ARTICULO',
            ),
    ));
             ?>