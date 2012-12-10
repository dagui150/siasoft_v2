<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Metodos de Valuación'
);
?>
<h1>Metodos de Valuación</h1>
<br>
<?php 
	$this->widget('bootstrap.widgets.BootGridView', array(
                'type'=>'striped bordered condensed',
		'id'=>'metodo-valuacion-inv-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'ID',
			'DESCRIPCION',
		),
	));
?>
