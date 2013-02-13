<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Días Feriados";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Días Feriados'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' DiaFeriado', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' DiaFeriado', 'url'=>array('admin')),
);
?>

<h1>Crear Dia Feriado</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>