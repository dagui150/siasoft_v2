<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Orden Compras";?>
<?php
$this->breadcrumbs=array(
	'Orden Compras'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar OrdenCompra', 'url'=>array('index')),
	array('label'=>'Administrar OrdenCompra', 'url'=>array('admin')),
);
?>

<h1>Crear OrdenCompra</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'config'=>$config, 'proveedor'=>$proveedor, 'linea'=>$linea, 'articulo' => $articulo, 'solicitudLinea'=>$solicitudLinea,)); ?>