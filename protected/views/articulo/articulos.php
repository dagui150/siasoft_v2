<?php
    $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>$id,
            'pager' => array('class'=>'BootPager','maxButtonCount' => 6),
            'template'=>'{items}{pager}',
            'dataProvider'=>$articulo->searchModal(),
            'selectionChanged'=>$funcion,
            'filter'=>$articulo,
            'columns'=>array(
                    array(
                        'class'=> 'CCheckBoxColumn',
                        'visible'=>$check
                    ),
                    'ARTICULO',
                    'NOMBRE',
                    array(
                        'name'=>'TIPO_ARTICULO',
                        'header'=>'Tipo de Articulo',
                        'value'=>'$data->tIPOARTICULO->NOMBRE',
                        'filter'=>CHtml::ListData(TipoArticulo::model()->findAll(),'ID','NOMBRE'),
                    ),
                    'EXISTENCIA_MINIMA',
                    'EXISTENCIA_MAXIMA',
            ),
    ));
?>
