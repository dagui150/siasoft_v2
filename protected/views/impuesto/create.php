<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Impuestos";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Impuestos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Impuesto', 'url'=>array('index')),
	array('label'=>'Administrar Impuesto', 'url'=>array('admin')),
);
?>

<h1>Crear Impuesto</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>