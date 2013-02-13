<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'zona-pdf',
    'fileName'  => 'Zonas',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
         array(
            'name'=>'PAIS',
            'value'=>'$data->PAIS = "COL" ? "Colombia" : $data->PAIS'
        ),
        'NOMBRE',
        
        'ACTIVO',
    ),
    'config'    => array(
        'title'     => 'Zonas',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
