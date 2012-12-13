<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Configuración";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('create'),
	'Configuración'
);

?>

<h1>Configuración de Inventario</h1>
<br />
<?php 
    
    Yii::app()->user->setFlash('warning', '<h3 align="center">Realice su configuración antes de continuar...</h3>');
            
    $this->widget('bootstrap.widgets.BootAlert');
    
    $bus=ConfCi::model()->find();
    
    if($bus)
        $this->redirect(array('update','id'=>$bus->ID));
    else
        $this->renderPartial('_form', array('model'=>$model));
       
?>