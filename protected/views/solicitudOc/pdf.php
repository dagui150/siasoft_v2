<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'dataProvider' => $model2->search3($model->SOLICITUD_OC),
    
    'columns' => array(
        array(
            'name'=>'ARTICULO',
            'value'=>'$data->aRTICULO->NOMBRE'
            ),
        'DESCRIPCION',
        'CANTIDAD',
        array(
            'name'=>'UNIDAD',
            'value'=>'$data->uNIDAD->NOMBRE'
            ),	
    ),
));
?>