<?php
$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Tipos de Documento'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoDocumento', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo Documento</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>