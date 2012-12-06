<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Tipos de Academicos";?>
<?php
/* @var $this TipoAcademicoController */
/* @var $model2 TipoAcademico */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Academicos'=>array('admin'),
	$model2->TIPO_ACADEMICO=>array('view','id'=>$model2->TIPO_ACADEMICO),
	'Actualizar',
);




$this->menu=array(
	array('label'=>Yii::t('app','LIST').' TipoAcademico', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' TipoAcademico', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' TipoAcademico', 'url'=>array('view', 'id'=>$model2->TIPO_ACADEMICO)),
	array('label'=>Yii::t('app','MANAGE').' TipoAcademico', 'url'=>array('admin')),
);
?>

<h1>Actualizar Tipo de Academico <?php echo $model2->TIPO_ACADEMICO; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>