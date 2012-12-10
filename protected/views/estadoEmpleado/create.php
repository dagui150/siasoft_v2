<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Estados de Empleado";?>
<?php
/* @var $this EstadoEmpleadoController */
/* @var $model EstadoEmpleado */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Estados de Empleado'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>'Listar Estados de Empleado', 'url'=>array('index')),
	array('label'=>'Administrar Estados de Empleado', 'url'=>array('admin')),
);
?>

<h1>Crear Estado de empleado</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>