<?php
    $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>$id,
            'pager' => array('class'=>'BootPager','maxButtonCount' => 6),
            'template'=>'{items}{pager}',
        // Estaban con $articulo->searchModal()
            'dataProvider'=>$data,
            'selectionChanged'=>$funcion,
            'filter'=>$articulo,
            'columns'=>array(
                    array(
                        'class'=> 'CCheckBoxColumn',
                        'visible'=>$check
                    ),
                    array(  'name'=>'ARTICULO',
                        'header'=>'Codigo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ARTICULO,"#")'
                    ),
                    'NOMBRE',
                    array(
                        'name'=>'TIPO_ARTICULO',
                        'header'=>'Tipo de Artículo',
                        'value'=>'$data->tIPOARTICULO->NOMBRE',
                        'filter'=>CHtml::ListData(TipoArticulo::model()->findAll(),'ID','NOMBRE'),
                    ),
                    'EXISTENCIA_MINIMA',
                    'EXISTENCIA_MAXIMA',
            ),
    ));
?>
