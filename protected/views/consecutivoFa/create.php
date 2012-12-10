<?php
$this->breadcrumbs=array(
	 'Facturación'=>array('admin'),
	 'Consecutivos'=>array('admin'),
	'Crear',
);
?>

<h1>Crear Consecutivo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>