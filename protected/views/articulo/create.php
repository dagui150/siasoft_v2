<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Artículos";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Artículos'=>array('admin'),
	'Crear',
);

?>

<h1>Crear Artículo</h1>

<?php 
        echo $this->renderPartial('_form',
                                array(
                                      'model'=>$model,
                                      'tipo'=>$tipo,
                                      'conf'=>$conf,
                                      'bodega'=>$bodega,
                                      'impuesto'=>$impuesto,
                                      'retencion'=>$retencion,
                                     )
        );
        
?>