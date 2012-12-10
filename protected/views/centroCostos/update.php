<?php
$this->breadcrumbs=array(
        'Sistema'=>array('update', 'id'=>$model2->ID),
	"Centro de costos");
?>

<h1>Actualizar Centro de Costos <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2, 'config'=>$config,)); ?>