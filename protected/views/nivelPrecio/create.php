<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Nivel de Precios";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Nivel de Precios'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' NivelPrecio', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' NivelPrecio', 'url'=>array('admin')),
);
?>

<h1>Crear Nivel Precio</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>