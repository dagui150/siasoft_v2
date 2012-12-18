<?php

    $this->widget('bootstrap.widgets.BootGridView', array(
           'type'=>'striped bordered condensed',
           'id'=>$id,
           'pager' => array('class'=>'BootPager','maxButtonCount' => 6),
           'template'=>"{items}{pager}",
        //Para los que se esten editando y den error, esta estaba con $bodega->searchModal()
           'dataProvider'=>$data,
           'filter'=>$bodega,
           'selectionChanged'=>$funcion,
           'selectableRows'=>1,
           'columns'=>array(
                  array(
                      'class'=> 'CCheckBoxColumn',
                      'visible'=>$check,
                  ),
                  array(
                     'type'=>'raw',
                     'name'=>'ID',
                     'header'=>'Código Bodega',
                     'value'=>'CHtml::link($data->ID,"#")',
                     'htmlOptions'=>array('data-dismiss'=>'modal'),
                  ),
                  'DESCRIPCION',
                  'TIPO',
                  'TELEFONO',
                  'DIRECCION',
            ),
        
     ));
    
?>
