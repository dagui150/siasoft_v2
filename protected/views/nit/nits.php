<?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>$id,
            'pager' => array('class'=>'BootPager','maxButtonCount' => 6),
            'template'=>"{items} {pager}",
            'dataProvider'=>$data,
            'selectionChanged'=>$funcion,
            'filter'=>$nit,
            'columns'=>array(
                array(  'name'=>'ID',
                        'header'=>'Nit',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ID,"#")'
                    ),
                    'TIIPO_DOCUMENTO',
                    'RAZON_SOCIAL',
                    array(
                            'class'=>'bootstrap.widgets.BootButtonColumn',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'template'=>'',
                    ),
            ),
    ));
      ?>