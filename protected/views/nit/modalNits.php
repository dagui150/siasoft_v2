<?php
    $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>$id,
            'pager' => array('class'=>'TbPager','maxButtonCount' => 6),
            'template'=>'{items}{pager}',
            'dataProvider'=>$nit->searchModal(),
            'selectionChanged'=>$funcion,
            'filter'=>$nit,
            'columns'=>array(
                    array(
                        'class'=> 'CCheckBoxColumn',
                        'visible'=>$check
                    ),
                    'ID',
                    'RAZON_SOCIAL',
            ),
    ));
?>
