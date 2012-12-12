<?php
$this->breadcrumbs=array(
	'Tipo Cuentas'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar TipoCuenta', 'url'=>array('index')),
	array('label'=>'Administrar TipoCuenta', 'url'=>array('admin')),
);
?>

<h1>Crear TipoCuenta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>