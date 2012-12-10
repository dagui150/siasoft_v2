<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'condicion-pago-pdf',
    'fileName'  => 'Condicion de Pagos',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
                'ID',
		'DESCRIPCION',
		'DIAS_NETO',
    ),
    'config'    => array(
        'title'     => 'Condicion de Pagos',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
