<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'retencion-pdf',
    'fileName'  => 'Retenciones',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
               'ID',
		'NOMBRE',
		'PORCENTAJE',
		'MONTO_MINIMO',
    ),
    'config'    => array(
        'title'     => 'Retenciones',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
