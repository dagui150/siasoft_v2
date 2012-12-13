<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 2'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' UbicacionGeografica2', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' UbicacionGeografica2', 'url'=>array('admin')),
);
?>

<h1>Crear Ubicacion Geografica 2</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>