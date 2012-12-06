<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'departamento-pdf',
    'fileName'  => 'Dependencias',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
        'ID',
		'DESCRIPCION',
    ),
    'config'    => array(
        'title'     => 'Dependencias',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
