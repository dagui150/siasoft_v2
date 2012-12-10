<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Configuración de Compras";?>
<?php
$this->breadcrumbs=array(
	'Configuración de Compras'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST').' ConfCo', 'url'=>array('index')),
	array('label'=>Yii::t('app','MANAGE').' ConfCo', 'url'=>array('admin')),
);
?>

<h1>Configuración de compras</h1>
<br />

<?php Yii::app()->user->setFlash('warning', '<h3 align="center">Realice su configuración antes de continuar...</h3>');
            
    $this->widget('bootstrap.widgets.BootAlert'); 

    $bus= ConfCo::model()->find();
    
    if($bus)
        $this->redirect(array('update','id'=>$bus->ID));
    else
        $this->renderPartial('_form', array('model'=>$model)); ?>