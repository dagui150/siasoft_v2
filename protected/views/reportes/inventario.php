<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_INVENTORY');?>
<?php
$this->breadcrumbs=array(
	'Reportes'=>array('inventario'),
	Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_INVENTORY'),
);

?>

<h1><?php echo Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_INVENTORY');?></h1>

<?php
    $array = array();
    
    foreach($provider->getData() as $data){
            
        $array[]=array(
                'ARTICULO'=>$data->ARTICULO,
                'NOMBRE'=>$data->NOMBRE,
                'EXISTENCIA_MINIMA'=>$data->EXISTENCIA_MINIMA,
                'EXISTENCIA_MAXIMA'=>$data->EXISTENCIA_MAXIMA,
                'BODEGA'=>$data->BODEGA,
                'UNIDAD_ALMACEN'=>$data->UNIDAD_ALMACEN,
                'CANT_DISPONIBLE'=>$data->CANT_DISPONIBLE
        );
    }

?>

<?php $tipo_form='inventario'; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'tipo'=>$tipo_form, 'provider'=>$provider, 'array'=>$array)); ?>