<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Configuración de Compras";?>
<?php
$this->breadcrumbs=array(
	'Configuración de Compras'=>array('admin'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' ConfCo', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE').' ConfCo', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW').' ConfCo', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>Yii::t('app','MANAGE').' ConfCo', 'url'=>array('admin')),
);
?> 	

<h1>Configuración de compras</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>