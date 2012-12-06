<?php 
    $this->widget('bootstrap.widgets.bootDetailView', array(
        'type'=>'striped bordered condensed',
            'data'=>$model,
            'attributes'=>array(
                    'ID',
                    'DESCRIPCION',
                    array(
                            'name'=>'TIPO',
                            'header'=>'Tipo',
                            'value'=>Bodega::tipo($model->TIPO),
                        ),
                    'TELEFONO',
                    'DIRECCION',
                    /*'ACTIVO',
                    'CREADO_POR',
                    'CREADO_EL',
                    'ACTUALIZADO_POR',
                    'ACTUALIZADO_EL',*/
            ),
    ));
?>