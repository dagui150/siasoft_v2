<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'dia-feriado-pdf',
    'fileName'  => 'Dia Feriado',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
                array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>'DiaFeriado::tipo($data->TIPO)',
                        'filter'=>array('F'=>'Fijo','V'=>'Variable'),
                    ),
		'DIA',
		'MES',
		'ANIO',
		'DESCRIPCION',
    ),
    'config'    => array(
        'title'     => 'Dia Feriado',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
