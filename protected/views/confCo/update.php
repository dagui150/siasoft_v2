<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Configuración de Compras";?>
<?php
$this->breadcrumbs=array(
	'Configuración de Compras'=>array('update','id'=>$model->ID),
        'Actualizar'
    
);


?> 	

<h1>Configuración de compras</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>