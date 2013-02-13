<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','UPDATE').' Nit';?>
<?php
/* @var $this NitController */
/* @var $model Nit */




$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Nits'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST'). 'Nit', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE'). 'Nit', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW'). 'Nit', 'url'=>array('view', 'id'=>$model2->ID)),
	array('label'=>Yii::t('app','MANAGE'). 'Nit', 'url'=>array('admin')),
);
?>

<h1>Actualizar Nit <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_formUpdate', array('model2'=>$model2)); ?>