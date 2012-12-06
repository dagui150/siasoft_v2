<?php
$this->breadcrumbs=array(
	'Articulo Ensambles'=>array('admin'),	
);
?>

<h1>Articulo Ensamble</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'articulo'=>$articulo, 'guardadas'=>$guardadas)); ?>