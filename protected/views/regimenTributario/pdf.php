<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'regimen-pdf',
    'fileName'  => 'Regimen Tributario',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
               'REGIMEN',
		'DESCRIPCION',
    ),
    'config'    => array(
        'title'     => 'Regimen Tributario',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
