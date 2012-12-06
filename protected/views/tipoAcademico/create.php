<?php
/* @var $this TipoAcademicoController */
/* @var $model TipoAcademico */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Academicos'=>array('admin'),
	'Nuevo',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoAcademico', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' TipoAcademico', 'url'=>array('admin')),
);
?>

<h1>Create TipoAcademico</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>