<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Solicitudes";?>
<?php
$this->breadcrumbs=array(
	'Solicitud Compra'=>array('admin'),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOc', 'url'=>array('index')),
	array('label'=>'Crear SolicitudOc', 'url'=>array('create')),
	array('label'=>'Ver SolicitudOc', 'url'=>array('view', 'id'=>$model->SOLICITUD_OC)),
	array('label'=>'Administrar SolicitudOc', 'url'=>array('admin')),
);
?>

<h1>Actualizar Solicitud de Compra</h1>

<?php  echo $this->renderPartial('_form', array('model'=>$model, 'linea'=>$linea, 'articulo'=>$articulo, 'config'=>$config, 'items'=>$items, 'ruta2'=>$ruta2)); ?>

