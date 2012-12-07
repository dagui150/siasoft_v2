<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Artículos";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Artículos'=>array('admin'),
	$model->NOMBRE=>array('view','id'=>$model->ARTICULO),
	'Actualizar',
);

?>

<h1>Actualizar Artículo "<?php echo $model->NOMBRE; ?>"</h1>

<?php echo $this->renderPartial('_form2', 
            array(
                'model'=>$model,
                'conf'=>$conf,
                'lineas'=>$lineas,
                'tipo'=>$tipo,
                'bodega'=>$bodega,
                'impuesto'=>$impuesto,
                'retencion'=>$retencion,
             )
      ); ?>