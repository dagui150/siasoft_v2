<?php
        $this->widget('bootstrap.widgets.BootGridView', array(
                            'type'=>'striped bordered condensed',
                            'id'=>$id,
                            'template'=>"{items}{pager}",
                            'dataProvider'=>$retencion->search(),
                            'filter'=>$retencion,
                            'selectionChanged'=>$funcion,
                            'columns'=>array(
                                    array(
                                        'type'=>'raw',
                                        'name'=>'ID',
                                        'header'=>'Código Retención',
                                        'value'=>'CHtml::link($data->ID,"#")',
                                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                                    ),
                                    'NOMBRE',
                                    'PORCENTAJE',
                                    'MONTO_MINIMO',
                                    'TIPO',
                                    'APLICA_MONTO',
                                    /*
                                    'APLICA_SUBTOTAL',
                                    'APLICA_SUB_DESC',
                                    'APLICA_IMPUESTO1',
                                    'APLICA_RUBRO1',
                                    'APLICA_RUBRO2',
                                    'ACTIVO',
                                    'CREADO_POR',
                                    'CREADO_EL',
                                    'ACTUALIZADO_POR',
                                    'ACTUALIZADO_EL',
                                    */
                            ),
                ));
?>
