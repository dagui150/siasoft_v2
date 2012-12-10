<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Orden Compras";?>
<?php
$this->breadcrumbs=array(
	'Orden Compras'=>array('admin'),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar OrdenCompra', 'url'=>array('index')),
	array('label'=>'Crear OrdenCompra', 'url'=>array('create')),
	array('label'=>'Ver OrdenCompra', 'url'=>array('view', 'id'=>$model->ORDEN_COMPRA)),
	array('label'=>'Administrar OrdenCompra', 'url'=>array('admin')),
);
?>

<h1>Actualizar OrdenCompra <?php echo $model->ORDEN_COMPRA; ?></h1>

<?php if($model->ESTADO != 'C' && $model->ESTADO != 'E'){ ?>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'linea'=>$linea, 'config'=>$config, 'articulo'=>$articulo, 'proveedor'=>$proveedor, 'solicitudLinea'=>$solicitudLinea, 'items'=>$items, 'linea2'=>$linea2,)); ?>
<?php } 
       else{
           echo $this->renderPartial('_formCancelar', array('model'=>$model, 'linea'=>$linea, 'config'=>$config, 'articulo'=>$articulo, 'proveedor'=>$proveedor, 'solicitudLinea'=>$solicitudLinea, 'items'=>$items));
       }
?>