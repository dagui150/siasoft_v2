<?php 
    $this->widget('bootstrap.widgets.TbDetailView', array(
        'type'=>'striped bordered condensed',
            'data'=>$model,
            'attributes'=>array(
                    'DESCRIPCION',
		array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>Categoria::tipo($data->TIPO),
                        'filter'=>array('C'=>'Cliente','P'=>'Proveedor'),
                    ),
                    /*'ACTIVO',
                    'CREADO_POR',
                    'CREADO_EL',
                    'ACTUALIZADO_POR',
                    'ACTUALIZADO_EL',*/
            ),
    ));
?>