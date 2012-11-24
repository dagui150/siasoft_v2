<?php

$this->widget('ext.PdfGrid.EPDFGrid', array(
    'id'        => 'nivel-precios-pdf',
    'fileName'  => 'Nivel de Precios',//Nombre del archivo generado sin la extension pdf (.pdf)
    'dataProvider'  => $dataProvider->searchPdf(), //puede ser $model->search()
    'columns'   => array(
                'ID',
		'DESCRIPCION',
		
                array(
                        'name'=>'ESQUEMA_TRABAJO',
                        'header'=>'Esquema de trabajo',
                        'value'=>'NivelPrecio::tipo($data->ESQUEMA_TRABAJO)',
                        
                    ),
                array(
                        'name'=>'CONDICION_PAGO',
                        'header'=>'Condicion de pago',
                        'value'=>'$data->cONDICIONPAGO->DESCRIPCION',
                        'type'=>'text',
                        
                    ),
    ),
    'config'    => array(
        'title'     => 'Nivel de Precios',
        
        //'colWidths' => array(40, 90, 40),
    ),
));


?>
