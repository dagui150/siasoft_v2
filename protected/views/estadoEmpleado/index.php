<?php
/* @var $this EstadoEmpleadoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Estado Empleados',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' EstadoEmpleado', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' EstadoEmpleado', 'url'=>array('admin')),
);
?>

<h1>Estado Empleados</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
