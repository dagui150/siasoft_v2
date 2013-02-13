<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'pais-pdf',
    'fileName'  => 'Paises',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
        'ID',
        'NOMBRE',
        'CODIGO_ISO',
        
    ),
    'config'    => array(
        'title'     => 'Paises',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
