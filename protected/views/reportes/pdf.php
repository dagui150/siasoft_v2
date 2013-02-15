<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'template' => '{items}',
    'dataProvider' => $model,
    
    'columns' => array(
		array(
                        'header'=> 'Factura',
                        'name'=>'FACTURA',                        
                    ),
                    array(
                        'header'=> 'Bodega',
                        'name'=>'BODEGA',
                    ),
                    array(
                        'header'=> 'Cliente',
                        'name'=>'CLIENTE',
                    ),
                    array(
                        'header'=> 'Fecha',
                        'name'=>'FECHA_FACTURA',                        
                    ),                    
                    array(
                        'header'=> 'Nivel de precio',
                        'name'=>'NIVEL_PRECIO',   
                    ),
                    
                    array(
                        'header'=> 'Total factura',
                        'name'=>'TOTAL_A_FACTURAR',                        
                    ),
    ),
));
?>