<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','CREATE').' Nit';?>
<?php
/* @var $this NitController */
/* @var $model Nit */
$this->breadcrumbs=array(
	'Sistema'=>array('admin'),
	'Nits'=>array('admin'),
	'Nuevo',
);

?>

<h1>Crear Nit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>