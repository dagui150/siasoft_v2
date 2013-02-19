<?php

switch ($tipo){
    case 'ventas':
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
        break;
    case 'inventario':
        echo 'aqui';
        $this->widget('bootstrap.widgets.TbGridView', array(
            'type' => 'striped bordered condensed',
            'template' => '{items}',
            'dataProvider' => $model,

            'columns' => array(
                        array(
                                'header'=>'Articulo',
                                'name'=>'ARTICULO',                        
                            ),
                            array(
                                'header'=>'Nombre',
                                'name'=>'NOMBRE',
                            ),
                            array(
                                'header'=>'Exis. Minima',
                                'name'=>'EXISTENCIA_MINIMA',
                            ),
                            array(
                                'header'=>'Exis. Maxima',
                                'name'=>'EXISTENCIA_MAXIMA',      
                            ),                    
                            array(
                                'header'=>'Bodega',
                                'name'=>'BODEGA', 
                            ),                    
                            array(
                                'header'=>'Unid. Almacenaje',
                                'name'=>'UNIDAD_ALMACEN', 
                            ),                    
                            array(
                                'header'=>'Cant. Disponible',
                                'name'=>'CANT_DISPONIBLE',      
                            ), 
            ),
        ));
        break;
}
?>