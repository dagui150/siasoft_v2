<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'tipo-tarjeta-pdf',
    'fileName'  => 'Tipos de Tarjeta',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
		'DESCRIPCION',
                        
                   
    ),
    'config'    => array(
        'title'     => 'Tipos de Tarjeta',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
