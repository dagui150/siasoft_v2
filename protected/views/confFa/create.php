<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Configuración";?>
<?php
/* @var $this ConfFaController */
/* @var $model ConfFa */

$this->breadcrumbs=array(
	'Facturación'=>array('create'),
	'Configuración',
);
?>

<h1>Configuración de Facturación</h1>

<?php
    Yii::app()->user->setFlash('warning', '<h3 align="center">Realize su configuración antes de continuar...</h3>');            
    $this->widget('bootstrap.widgets.BootAlert');
    $bus=ConfFa::model()->find();
    
    if(ConfFa::darConf())
        $this->redirect(array('update','id'=>$bus->ID));
    else
        $this->renderPartial('_form', array('model'=>$model, 'condicion'=>$condicion, 'categoria'=>$categoria, 'bodega'=>$bodega));    
?>