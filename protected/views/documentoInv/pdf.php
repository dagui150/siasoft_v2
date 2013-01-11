<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'dataProvider' => $model2->search($model->DOCUMENTO_INV),
    
    'columns' => array(
        
        array(
            'name' => 'LINEA_NUM',
            'header'=> 'Linea',
            'value' => '$data->LINEA_NUM ',
        ),
        'ARTICULO',
        array(
            'name' => 'ARTICULO',
            'header' => 'Descripción',
            'value' => 'Articulo::darNombre($data->ARTICULO)',
        ),
        array(
            'name' => 'BODEGA',
            'value' => '$data->BODEGA." - ".Bodega::darDescripcion($data->BODEGA)',
        ),
        
        array(
            'name' => 'BODEGA_DESTINO',
            'value' => '$data->BODEGA_DESTINO." - ".$data->bODEGADESTINO->DESCRIPCION',
        ),
        'CANTIDAD',
        array(
            'name' => 'TIPO_TRANSACCION',
            'value' => '$data->tIPOTRANSACCION->NOMBRE',
        ),
    ),
));
?>
