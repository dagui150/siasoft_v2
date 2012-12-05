<?php
$this->widget('bootstrap.widgets.BootGridView', array(
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'dataProvider' => $model2->search2($model->ORDEN_COMPRA),
    
    'columns' => array(
		array(
            'name'=>'ARTICULO',
            'value'=>'$data->aRTICULO->NOMBRE'
            ),
		'DESCRIPCION',
                array(
                    'name'=>'UNIDAD_COMPRA',
                    'value'=>'$data->uNIDADCOMPRA->NOMBRE',
                ),
		'CANTIDAD_ORDENADA',
		'PRECIO_UNITARIO',
                array(
                    'name'=>'BODEGA',
                    'value'=>'$data->bODEGA->DESCRIPCION',
                ),
    ),
));
?>