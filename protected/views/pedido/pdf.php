<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'dataProvider' => $model2->search3($model->PEDIDO),
    'columns' => array(
        
        array(
            'name' => 'ARTICULO',
                'header' => 'Codigo'
        ),
        
        array(
            'name' => 'ARTICULO',
            'header' => 'Descripcion',
            'value' => '$data->aRTICULO->NOMBRE'
        ),
        
        array(
            'name' => 'CANTIDAD',
            'header' => 'Cant.'
        ),
        
        array(
            'name' => 'PRECIO_UNITARIO',
                'header' => 'V. Unitario'
        ),
        
        array(
            'name' => 'MONTO_DESCUENTO',
            'header' => 'Descuento'
        ),
        'TOTAL'
    ),
));
?>