<?php $this->pageTitle=Yii::app()->name." - Metodos de Valuación";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Metodos de Valuación'
);
?>
<h1>Metodos de Valuación</h1>
<?php 
	$this->widget('bootstrap.widgets.TbGridView', array(
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
