<?php
 $dataprovider = $regimen->search();
 $dataprovider->pagination = array('pageSize'=>5);
$this->widget('bootstrap.widgets.TbGridView', array(
                         'type'=>'striped bordered condensed',
                         'id'=>$id,
                         'template'=>"{items}{pager}",
                         'dataProvider'=>$dataprovider,
                         'filter'=>$regimen,                       
                         'selectionChanged'=>$funcion,
                         'columns'=>array(
                               array(
                                   'type'=>'raw',
                                   'name'=>'REGIMEN',
                                   'header'=>'Código Regimen',
                                   'value'=>'CHtml::link($data->REGIMEN,"#")',
                                   'htmlOptions'=>array('data-dismiss'=>'modal'),
                               ),
                               'DESCRIPCION',
                         ),
              )); 
?>