<?php 
$this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'dataProvider' => $model2->search3($model->FACTURA),
    'columns' => array(
        'ARTICULO',
        array(
            'name' => 'ARTICULO',
            'header' => 'Descripcion',
            'value' => '$data->aRTICULO->NOMBRE'
        ),
        array(
            'name' => 'UNIDAD',
            'header' => 'Unidad',
            'value' => '$data->uNIDAD->NOMBRE'
        ),
        array(
            'name' => 'CANTIDAD',
            'header' => 'Cant.'
        ),
        array(
            'name' => 'TIPO_PRECIO',
            'header' => 'Tipo Precio',
            'value' => '$data->tIPOPRECIO->nIVELPRECIO->DESCRIPCION'
        ),
        'PRECIO_UNITARIO',
        array(
            'name' => 'PORC_DESCUENTO',
            'header' => '% Desc.'
        ),
        array(
            'name' => 'PORC_IMPUESTO',
            'header' => '% Iva.'
        ),
        'VALOR_IMPUESTO',
        'TOTAL'
    ),
));
?>