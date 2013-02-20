<?php $this->pageTitle=Yii::app()->name." - Datos Empresa";?>
<?php
$this->breadcrumbs=array(
	'Sistema'=>array('create'),
	'Datos Empresa',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' Compania', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' Compania', 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app','CREATE').' '.Yii::t('app','COMPANY'); ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>