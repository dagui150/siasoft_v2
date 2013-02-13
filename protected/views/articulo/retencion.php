<?php
        $this->widget('bootstrap.widgets.TbGridView', array(
                            'type'=>'striped bordered condensed',
                            'id'=>$id,
                            'pager' => array('class'=>'TbPager','maxButtonCount' => 6),
                            'template'=>"{items}{pager}",
                            'dataProvider'=>$data,
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
