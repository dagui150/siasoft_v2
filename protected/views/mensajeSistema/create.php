<?php
$this->breadcrumbs=array(
        'Mensaje Sistemas'=>array('admin'),
	'Mensaje Sistemas'=>array('admin'),
	 Yii::t('app','CREATE'),
);

$this->menu=array(
        array('label'=>Yii::t('app','LIST').' MensajeSistema', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' MensajeSistema', 'url'=>array('admin')),
);
?>

<h1>Create MensajeSistema</h1>

<?php echo $this2->renderPartial('_form', array('model'=>$model2)); ?>