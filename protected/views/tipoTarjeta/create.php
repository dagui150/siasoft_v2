<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Tipo de Tarjeta'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoTarjeta', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' TipoTarjeta', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo Tarjeta</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>