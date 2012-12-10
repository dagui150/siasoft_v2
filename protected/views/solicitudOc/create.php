<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Solicitud";?>
<?php
$this->breadcrumbs=array(
	'Solicitudes'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar SolicitudOc', 'url'=>array('index')),
	array('label'=>'Administrar SolicitudOc', 'url'=>array('admin')),
);
?>

<h1>Crear Solicitud</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'linea'=>$linea, 'articulo'=>$articulo, 'config'=>$config)); ?>