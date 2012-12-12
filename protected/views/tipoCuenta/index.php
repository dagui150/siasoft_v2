<?php
$this->breadcrumbs=array(
	'Tipo Cuentas',
);

$this->menu=array(
	array('label'=>'Crear TipoCuenta', 'url'=>array('create')),
	array('label'=>'Administrar TipoCuenta', 'url'=>array('admin')),
);
?>

<h1>Tipo Cuentas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
