<?php
$this->breadcrumbs=array(
        'Sistema'=>array('update', 'id'=>$model2->ID),
	"Nivel de precio");
?>

<h1>Actualizar Nivel Precio <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>