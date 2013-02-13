<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'tipo-documento-pdf',
    'fileName'  => 'Tipos de Documento',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
                'ID',
		'DESCRIPCION',
		'MASCARA',
    ),
    'config'    => array(
        'title'     => 'Tipos de Documento',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
