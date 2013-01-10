<?php

$this->widget('bootstrap.widgets.TbGridView', array(
                         'type'=>'striped bordered condensed',
                         'id'=>$id,
                         'pager' => array('class'=>'TbPager','maxButtonCount' => 6),
                         'template'=>"{items}{pager}",
                         'dataProvider'=>$data,
                         'filter'=>$impuesto,                       
                         'selectionChanged'=>$funcion,
                         'columns'=>array(
                               array(
                                   'type'=>'raw',
                                   'name'=>'ID',
                                   'header'=>'Código Impuesto',
                                   'value'=>'CHtml::link($data->ID,"#")',
                                   'htmlOptions'=>array('data-dismiss'=>'modal'),
                               ),
                               'NOMBRE',
                               'PROCENTAJE',
                         ),
              )); 
?>