<?php
$this->breadcrumbs=array(
	'Clasific Adi Artículos'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar ClasificAdiArticulo', 'url'=>array('index')),
	array('label'=>'Crear ClasificAdiArticulo', 'url'=>array('create')),
	array('label'=>'Ver ClasificAdiArticulo', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Administrar ClasificAdiArticulo', 'url'=>array('admin')),
);
?>

<h1>Actualizar ClasificAdiArticulo <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>