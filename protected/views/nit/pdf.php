<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'nit-pdf',
    'fileName'  => 'Nits',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
        'ID',
		'TIIPO_DOCUMENTO',
		'RAZON_SOCIAL',
		'ALIAS',
		'OBSERVACIONES',
    ),
    'config'    => array(
        'title'     => 'Nits',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
