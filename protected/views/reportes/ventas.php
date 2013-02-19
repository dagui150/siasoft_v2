<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_SALES');?>
<?php
$this->breadcrumbs=array(
	'Reportes'=>array('ventas'),
	Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_SALES'),
);

?>

<h1><?php echo Yii::t('app','GENERATE')." ".Yii::t('app','REPORTS_SALES');?></h1>

<?php
    $array = array();
    
    foreach($provider->getData() as $data){
            
        $array[]=array(
                'FACTURA'=>$data->FACTURA,
                'BODEGA'=>$data->bODEGA->DESCRIPCION,
                'CLIENTE'=>$data->cLIENTE->NOMBRE,
                'TOTAL_A_FACTURAR'=>$data->TOTAL_A_FACTURAR,
                'FECHA_FACTURA'=>$data->FECHA_FACTURA,
                'NIVEL_PRECIO'=>$data->nIVELPRECIO->DESCRIPCION,
        );
    }

?>
<?php $tipo_form='ventas'; ?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'tipo'=>$tipo_form, 'provider'=>$provider, 'array'=>$array)); ?>