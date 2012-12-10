<?php
$this->breadcrumbs=array(
	'Tipo Cuentas'=>array('index'),
	$model->TIPO_CUENTA=>array('view','id'=>$model->TIPO_CUENTA),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar TipoCuenta', 'url'=>array('index')),
	array('label'=>'Crear TipoCuenta', 'url'=>array('create')),
	array('label'=>'Ver TipoCuenta', 'url'=>array('view', 'id'=>$model->TIPO_CUENTA)),
	array('label'=>'Administrar TipoCuenta', 'url'=>array('admin')),
);
?>

<h1>Actualizar TipoCuenta <?php echo $model->TIPO_CUENTA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>