<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Tipos de Cuentas";?>
<?php
$this->breadcrumbs=array(
	'Tipos de Cuentas'=>array('admin'),
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

<h1>Actualizar Tipo de Cuenta <?php echo $model->TIPO_CUENTA; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>