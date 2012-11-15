<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Centro de Costos";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Centro de Costos'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' CentroCostos', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' CentroCostos', 'url'=>array('admin')),
);
?>

<h1>Crear Centro de Costos</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2, 'config'=>$config,)); ?>