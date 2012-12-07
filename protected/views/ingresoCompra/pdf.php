<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'dataProvider' => $model2->search2($model->INGRESO_COMPRA),
    'columns' => array(
        'ARTICULO',
        array(
            'name' => 'ARTICULO',
            'header' => 'Nombre Articulo',
            'value' => '$data->aRTICULO->NOMBRE'
        ),
        array(
            'name' => 'UNIDAD_ORDENADA',
            'value' => '$data->uNIDADORDENADA->NOMBRE',
        ),
        'CANTIDAD_ORDENADA',
        'PRECIO_UNITARIO',
        array(
            'name' => 'BODEGA',
            'value' => '$data->bODEGA->DESCRIPCION',
        ),
    ),
));
?>