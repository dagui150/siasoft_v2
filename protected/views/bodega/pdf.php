<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'bodega-pdf',
    'fileName'  => 'Bodegas',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
        'ID',
        'DESCRIPCION',
        array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>'Bodega::tipo($data->TIPO)',
                        'filter'=>array('C'=>'Consumo','V'=>'Ventas','N'=>'No Disponible'),
                    ),
        'TELEFONO',
        'DIRECCION',

        
        
    ),
    'config'    => array(
        'title'     => 'Bodegas',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
