<?php
$this->breadcrumbs=array(
	'Tipo Documento'=>array('admin'),
	'Crear',
);

$this->menu=array(
	array('label'=>'List TipoDocumento', 'url'=>array('index')),
	array('label'=>'Manage TipoDocumento', 'url'=>array('admin')),
);
?>

<h1>Crear Tipo Documento</h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>