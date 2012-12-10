<?php
/* @var $this TipoAccidenteController */
/* @var $model TipoAccidente */

$this->breadcrumbs=array(
	'Recursos Humanos' => array('admin'),
	'Tipos de Accidentes'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoAccidente', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' TipoAccidente', 'url'=>array('admin')),
);
?>

<h1>Create TipoAccidente</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>