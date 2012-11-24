<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'ubicacion-geografica2-pdf',
    'fileName'  => 'Departamentos',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
        'ID',
        array('name'=>'UBICACION_GEOGRAFICA1',
            'value'=>'$data->uBICACIONGEOGRAFICA1->NOMBRE'),
        'NOMBRE',
        
    ),
    'config'    => array(
        'title'     => 'Municipios',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
