<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','IPDATE')." Estados de Empleado";?>
<?php
/* @var $this EstadoEmpleadoController */
/* @var $model EstadoEmpleado */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Estados de Empleado'=>array('admin'),
	$model2->ESTADO_EMPLEADO=>array('view','id'=>$model2->ESTADO_EMPLEADO),
	'Actualizar',
);

?>

<h1>Actualizar Estado de empleado <?php echo $model2->ESTADO_EMPLEADO; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>