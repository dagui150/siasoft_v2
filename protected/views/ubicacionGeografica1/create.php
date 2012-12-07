<?php
$this->breadcrumbs=array(
	'Ubicacion Geografica 1'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' UbicacionGeografica1', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' UbicacionGeografica1', 'url'=>array('admin')),
);
?>

<h1>Crear Ubicacion Geografica 1</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>