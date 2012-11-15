<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Entidad Financiera";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Entidad Financiera'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' EntidadFinanciera', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' EntidadFinanciera', 'url'=>array('admin')),
);
?>

<h1>Crear Entidad Financiera</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2,  'nit'=>$nit,)); ?>