<?php
$this->breadcrumbs=array(
        'Sistema'=>array('update', 'id'=>$model2->ID),
	"Relación de Nits");
?>

<h1>Actualizar Nit <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>