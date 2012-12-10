<?php
$this->breadcrumbs=array(
	'Facturación'=>array('admin'),
	'Clientes'=>array('admin'),
);
?>

<h1>Clientes</h1>
<br>
<div align="right">

    <?php 

        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Nuevo',
            'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini', // '', 'large', 'small' or 'mini'
            'icon' => 'plus white',
            'url'=>array('create'),
        )); 

    ?>
</div>

<?php $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'cliente-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                    'name'=>'CLIENTE',
                    'value'=>'$data->CLIENTE." - ".$data->NOMBRE'
                ),
                array(
                    'name'=>'REGIMEN',
                    'value'=>'isset($data->rEGIMEN->DESCRIPCION) ? $data->rEGIMEN->DESCRIPCION : ""'
                ),
		'CATEGORIA',
                array(
                    'name'=>'IMPUESTO',
                    'value'=>'isset($data->iMPUESTO->NOMBRE) ? $data->iMPUESTO->NOMBRE : ""'
                ),
		'NIT',
                array(
                    'name'=>'TIPO_PRECIO',
                    'value'=>'isset($data->tIPOPRECIO->DESCRIPCION) ? $data->tIPOPRECIO->DESCRIPCION : ""'
                ),
		 array(
                      'class'=>'bootstrap.widgets.BootButtonColumn',
                 ),
	),
)); ?>
