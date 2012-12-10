<?php
$this->widget('bootstrap.widgets.BootGridView', array(
                         'type'=>'striped bordered condensed',
                         'id'=>$id,
                         'template'=>"{items}{pager}",
                         'dataProvider'=>$impuesto->search(),
                         'filter'=>$impuesto,                       
                         'selectionChanged'=>$funcion,
                         'columns'=>array(
                               array(
                                   'type'=>'raw',
                                   'name'=>'ID',
                                   'header'=>'Codigo Impuesto',
                                   'value'=>'CHtml::link($data->ID,"#")',
                                   'htmlOptions'=>array('data-dismiss'=>'modal'),
                               ),
                               'NOMBRE',
                               'PROCENTAJE',
                         ),
              )); 
?>