<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Bodegas";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Bodegas'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Bodega', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' Bodega', 'url'=>array('admin')),
);
?>

<h1>Crear Bodega</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>