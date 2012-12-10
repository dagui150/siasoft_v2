<?php
 $dataprovider = $impuesto->search();
 $dataprovider->pagination = array('pageSize'=>5);
$this->widget('bootstrap.widgets.BootGridView', array(
                         'type'=>'striped bordered condensed',
                         'id'=>$id,
                         'template'=>"{items}{pager}",
                         'dataProvider'=>$dataprovider,
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