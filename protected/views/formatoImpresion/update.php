<?php
$this->breadcrumbs=array(
	'Formato Impresions'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar FormatoImpresion', 'url'=>array('index')),
	array('label'=>'Crear FormatoImpresion', 'url'=>array('create')),
	array('label'=>'Ver FormatoImpresion', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Administrar FormatoImpresion', 'url'=>array('admin')),
);
?>

<h1>Actualizar FormatoImpresion <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>