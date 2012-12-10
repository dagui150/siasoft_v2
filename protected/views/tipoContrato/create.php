<?php
/* @var $this TipoContratoController */
/* @var $model TipoContrato */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Contratos'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoContrato', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' TipoContrato', 'url'=>array('admin')),
);
?>

<h1>Create TipoContrato</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>