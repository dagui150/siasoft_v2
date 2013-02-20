<?php 
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'template' => '{items}',
    //'enableSorting' => false,
    'dataProvider' => $model2->search3($model->FACTURA),
    'columns' => array(
        array(
            'name' => 'ARTICULO',
            'header' => 'Código',
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
            'header' => 'V. Unitario',
        ),
        array(
            'name' => 'MONTO_DESCUENTO',
            'header' => 'Descuento'
        ),
        'TOTAL'
    ),
));
?>